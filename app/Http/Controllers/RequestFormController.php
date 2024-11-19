<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\BillToInformation;
use App\Models\AttorneyInformation;
use App\Models\ClaimantInformation;
use App\Models\ReferralInformation;
use App\Models\PhysicianInformation;
use Illuminate\Support\Facades\Auth;
use App\Models\AppointmentInformation;
use App\Models\IssuesAndItemsToAddress;

class RequestFormController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/RequestForm/index');
    }

    public function store(Request $request)
    {
       // Access validated data
    //    $input = $request->all();
    $user = Auth::user(); // Get the authenticated user

        // Save Referral Information
        $user->referralInformation()->create($request->referralInfo);

        // Save BillTo Information
        $user->billToInformation()->create($request->billInfo);

        // Save Claimant Information
        $user->claimantInformation()->create($request->claimants);

        // Save Physician Information
        foreach ($request->physicians as $physician) {
            $user->physicianInformation()->create($physician);
        }

        // Save Issues and Items to Address
        $user->issuesAndItemsToAddress()->create($request->issue);

        // Save Attorney Information
        $user->attorneyInformation()->create($request->defenseAttorney);

        // Save Appointment Information
        $user->appointmentInformation()->create($request->appointments);

       // Debugging the received data (optional)
    //    dd($input);
    //    dd($request->referralInfo);

        // $user=Auth::user();

        // ReferralInformation::create( $request->referralInfo);
        // BillToInformation::create($request->billInfo );
        // ClaimantInformation::create($request->claimants );

        // // Create Claimant Information
        //     foreach ($request->physicians as $physician) {
        //         PhysicianInformation::create($physician);
        //     }

        // IssuesAndItemsToAddress::create($request->issue);

        // AttorneyInformation::create($request->defenseAttorney);
        // AppointmentInformation::create($request->appointments);

dd('ok');
        

        // Create Treating Physicians
        // foreach ($validated['treating_physicians'] as $physician) {
        //     $claimant->treatingPhysicians()->create($physician);
        // }
    
        // Redirect back with a success message (after processing the input)
        return to_route('users.index')->with('success', 'User created successfully');
    }
    
}
