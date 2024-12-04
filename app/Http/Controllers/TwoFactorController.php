<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use PragmaRX\Google2FA\Google2FA;
use Illuminate\Support\Facades\Notification;

class TwoFactorController extends Controller
{

    public function generate2faSecret(Request $request)
    {
        $user = $request->user();
        $google2fa = new Google2FA();

        $secret = $google2fa->generateSecretKey();
        $user->google2fa_secret = $secret;
        $user->save();

        return response()->json([
            'secret' => $secret,
            'qr_url' => $google2fa->getQRCodeUrl(
                'YourAppName',
                $user->email,
                $secret
            ),
        ]);
    }



    public function verify2fa(Request $request)
    {
        $request->validate(['code' => 'required|numeric']);

        $user = $request->user();
        $google2fa = new Google2FA();

        $isValid = $google2fa->verifyKey($user->google2fa_secret, $request->code);

        if (!$isValid) {
            return response()->json(['error' => 'Invalid 2FA code'], 422);
        }

        $user->two_factor_expires_at = now()->addMinutes(10);
        $user->save();

        return response()->json(['message' => '2FA verified']);
    }


    public function verification()  {
        return Inertia::render('Admin/Auth/authenticator');
    }
    

    public function verifyEmail2faCode(Request $request)
    {
        $request->validate(['code' => 'required|numeric']);
    
        $storedCode = session('email_2fa_code');
    
        if ($storedCode != $request->code) {
            // session()->forget('email_2fa_code'); 
            info('Invalid 2FA code');
            return Inertia::location(route('verification.code'))->with('error', 'Invalid 2FA code');
        }
        info('valid 2FA code');
        // session()->forget('email_2fa_code'); 
        return  redirect()->route('admin.dashboard');
    }
    
    public function verifyTwoFactorAuthentication(Request $request)
    {
        $user = $request->user();
        $google2fa = new Google2FA();

        $valid = $google2fa->verifyKey($user->google2fa_secret, $request->input('code'));

        if ($valid) {
            return response()->json(['message' => '2FA verified successfully.']);
        } else {
            return response()->json(['message' => 'Invalid code.'], 422);
        }
    }

    public function enableTwoFactorAuthentication(Request $request)
    {
        $user = $request->user();
        $google2fa = new Google2FA();
    
        $secretKey = $google2fa->generateSecretKey();
        $user->google2fa_secret = $secretKey;
        $user->save();
    
        $qrCodeUrl = $google2fa->getQRCodeInline(
            config('app.name'),
            $user->email,
            $secretKey
        );
    
        return response()->json(['qrcode' => $qrCodeUrl, 'secret' => $secretKey]);
    }

}
