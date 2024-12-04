<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use PragmaRX\Google2FA\Google2FA;
use App\Notifications\Email2FACode;
use App\Http\Controllers\Controller;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Notification;

class AdminAuthController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Auth/login');
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $remember = $request->has('remember'); 

        if (Auth::attempt($request->only('email', 'password'), $remember)) {
           return redirect()->route('admin.dashboard');
            // $this->sendEmail2faCode( $request->email);
            //  return Inertia::location(route('verification.code'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function sendEmail2faCode($mail)
    {
        $code = rand(100000, 999999);
        session(['email_2fa_code' => $code]);
        info($code);
        // Notification::route('mail', $mail)
        //     ->notify(new Email2FACode($code));

       
    }

    public function forgetPassword()
    {
        return Inertia::render('Admin/Auth/forgotPassword');
    }

    public function resetPassword(Request $request)
    {
        return Inertia::render('Admin/Auth/resetPassword', [
            'token' => $request->token,
            'email' => $request->email,
        ]);
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // Send password reset link
        $response = Password::sendResetLink($request->only('email'));

        if ($response == Password::RESET_LINK_SENT) {
            return Inertia::render('Admin/ForgotPassword', [
                'status' => 'If the email is registered, you will receive a reset link shortly.',
            ]);
        }

        return Inertia::render('Admin/Auth/forgotPassword', [
            'errors' => ['email' => 'We couldn\'t find a user with that email address.']
        ]);
    }

    // Handle the password reset
    public function update(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $response = Password::reset(
            $request->only('email', 'password', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                ])->save();
            }
        );

        if ($response == Password::PASSWORD_RESET) {
            return Inertia::render('Admin/Auth/login', [
                'status' => 'Your password has been reset! Please log in with your new password.'
            ]);
        }

        return Inertia::render('Admin/ViewResetPassword', [
            'errors' => ['email' => trans($response)],
            'token' => $request->token,
            'email' => $request->email,
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return Inertia::location(route('admin.login')); 
    }
}
