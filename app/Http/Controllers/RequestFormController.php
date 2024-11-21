<?php

namespace App\Http\Controllers;

use Exception;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Jobs\ProcessFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreFormRequest;

use function PHPSTORM_META\type;

class RequestFormController extends Controller
{
    public function index()
    {
        $userData = Auth::user()
            ->load('referralInformation', 'billToInformation',
                    'claimantInformation', 'physicianInformation', 
                    'issuesAndItemsToAddress', 'claimantAttorney', 
                    'defenseAttorney', 'appointmentInformation','attachments'
                );
                
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
            $user->referralInformation()->updateOrCreate(['user_id' => $user->id], $request->referralInfo);

            // Save BillTo Information
            $billInfo =$request->billInfo['same_as_referral'] == true ? $request->referralInfo : $request->billInfo;
            $user->billToInformation()->updateOrCreate(['user_id' => $user->id] ,$billInfo);

            // Save Claimant Information
            $user->claimantInformation()->updateOrCreate(['user_id' => $user->id], $request->claimants);
            
           // Save Physician Information
           $this->savePhysicians($user, $request->physicians);

            // Save Issues and Items to Address
            $user->issuesAndItemsToAddress()->updateOrCreate(['user_id' => $user->id], $request->issue);

            // Save Defense Attorney Information
            $user->attorneyInformation()->updateOrCreate(['user_id' => $user->id ,'type'=>'defense'], $request->defenseAttorney);

            // Save Claimant Attorney Information
            $user->attorneyInformation()->updateOrCreate(['user_id' => $user->id ,'type'=>'claimant'], $request->claimantAttorney);

            // Save Appointment Information
            $user->appointmentInformation()->updateOrCreate(['user_id' => $user->id], $request->appointments);

            DB::commit(); 
            return to_route('request-forms.index')->with(['success' => 'Request form created successfully']);
        } catch (Exception $e) {
            DB::rollBack();
            info( $e->getMessage());
            return to_route('request-forms.create')->with(['error' =>'Something went wrong']);
        }
    }

   
    // Saves the physician information
    private function savePhysicians($user, $physicians)
    {
        foreach ($physicians as $physician) {
            if (!empty($physician['last_name']) && !empty($physician['first_name'])) {
                $user->physicianInformation()->updateOrCreate(
                    [
                        'user_id' => $user->id,
                        'first_name' => $physician['first_name'],
                        'last_name' => $physician['last_name'],
                    ],
                    [
                        'first_name' => $physician['first_name'],
                        'last_name' => $physician['last_name'],
                    ]
                );
            }
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
