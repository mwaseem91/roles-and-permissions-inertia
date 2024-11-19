<?php

namespace App\Http\Controllers;

use Exception;
use Inertia\Inertia;
use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreFormRequest;
use Illuminate\Support\Facades\Storage;

class RequestFormController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/RequestForm/index');
    }
    public function create()
    {
        return Inertia::render('Admin/RequestForm/form');
    }
    public function store(StoreFormRequest $request)
    {
        
        DB::beginTransaction(); 
        try {
            $user = Auth::user(); 

            // Save Referral Information
            $user->referralInformation()->create($request->referralInfo);

            // Save BillTo Information
            $billInfo =$request->billInfo['same_as_referral'] == true ? $request->referralInfo : $request->billInfo;
            $user->billToInformation()->create($billInfo);

            // Save Claimant Information
            $user->claimantInformation()->create($request->claimants);

            // Save Physician Information
            foreach ($request->physicians as $physician) {
                if ( !empty($physician['last_name']) && !empty($physician['first_name'])) {
                    $user->physicianInformation()->create($physician);
                }
            }

            // Save Issues and Items to Address
            $user->issuesAndItemsToAddress()->create($request->issue);

            // Save Attorney Information
            $user->attorneyInformation()->create($request->defenseAttorney);
            $user->attorneyInformation()->create($request->claimantAttorney);

            // Save Appointment Information
            $user->appointmentInformation()->create($request->appointments);

            DB::commit(); 
            return to_route('request-forms.index')->with('success', 'Request form created successfully');
        } catch (Exception $e) {
            DB::rollBack();
            info( $e->getMessage());
            return to_route('request-forms.index')->with('error', 'Something went wrong');
        }
    }

    public function fileUpload(Request $request)
    {
        $request->validate([
            'file' => 'required|array|max:10',
        ]);

        try {
            $userId = Auth::user()->id;

            if ($request->hasFile('file')) {
                foreach ($request->file('file') as $file) {
                    $uploadedFile = Storage::putFileAs('photos', $file, time() . '_' . $file->getClientOriginalName());
                    Attachment::create([
                        'file_path' => $uploadedFile,
                        'user_id' => $userId,
                        'file_name' => $file->getClientOriginalName(),
                    ]);
                }
            }

            // Return a success response
            return response()->json([ 'message' => 'Files uploaded successfully', ], 200);

        } catch (\Exception $e) {
            return response()->json([ 'error' => $e->getMessage(), ], 500);
        }
    }
}
