<?php

namespace App\Http\Controllers;

use Exception;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Jobs\ProcessFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreFormRequest;

class RequestFormController extends Controller
{
    public function index()
    {
        $userData = Auth::user()->load('referralInformation', 'billToInformation', 'claimantInformation', 'physicianInformation', 'issuesAndItemsToAddress', 'claimantAttorney', 'defenseAttorney', 'appointment');
        return Inertia::render('Admin/RequestForm/index', [
            'userData' => $userData
        ]);
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

            // Save Defense Attorney Information
            $user->attorneyInformation()->create($request->defenseAttorney);

            // Save Claimant Attorney Information
            $user->attorneyInformation()->create($request->claimantAttorney);

            // Save Appointment Information
            $user->appointmentInformation()->create($request->appointments);

            DB::commit(); 
            return to_route('request-forms.create')->with('Request form created successfully');
        } catch (Exception $e) {
            DB::rollBack();
            info( $e->getMessage());
            return to_route('request-forms.create')->with('Something went wrong');
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
                $filePaths = [];
                foreach ($request->file('file') as $file) {
                    // Store the file temporarily
                    $tempPath = $file->store('temp');
                    $filePaths[] = [
                        'path' => $tempPath,
                        'original_name' => $file->getClientOriginalName(),
                    ];
                }

                // Dispatch the job with file paths
                ProcessFileUploads::dispatch($filePaths, $userId);
            }

            return response()->json('Files uploaded successfully');

        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }


    // public function fileUpload(Request $request)
    // {
    //     $request->validate([
    //         'file' => 'required|array|max:10',
    //     ]);

    //     try {
    //         $userId = Auth::user()->id;

    //         if ($request->hasFile('file')) {
    //             foreach ($request->file('file') as $file) {
    //                 $uploadedFile = Storage::putFileAs('photos', $file, time() . '_' . $file->getClientOriginalName());
    //                 Attachment::create([
    //                     'file_path' => $uploadedFile,
    //                     'user_id' => $userId,
    //                     'file_name' => $file->getClientOriginalName(),
    //                 ]);
    //             }
    //         }

    //         // Return a success response
    //         return response()->json([ 'message' => 'Files uploaded successfully', ], 200);

    //     } catch (\Exception $e) {
    //         return response()->json([ 'error' => $e->getMessage(), ], 500);
    //     }
    // }
}
