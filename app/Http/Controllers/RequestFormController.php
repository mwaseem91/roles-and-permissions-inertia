<?php

namespace App\Http\Controllers;

use Exception;
use Inertia\Inertia;
use App\Models\Referral;
use App\Models\ClaimType;
use Illuminate\Http\Request;
use App\Jobs\ProcessFileUploads;
use function PHPSTORM_META\type;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreFormRequest;

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
        $claimTypes= ClaimType::all();
        return Inertia::render('Admin/RequestForm/form',
        [
            'claimTypes' => $claimTypes
        ]);
    }

    public function store(StoreFormRequest $request)
    {
        
        DB::beginTransaction(); 
        try {
          
            // Save Referral Information
            $referral = Referral::create($request->referralInfo);

            // Save BillTo Information
            $billInfo =$request->billInfo['same_as_referral'] == true ? $request->referralInfo : $request->billInfo;
            $referral->billToInformation()->create($billInfo);

            // Save Claimant Information
             $referral->claimantInformation()->create( $request->claimants);
            
            // Save Physician Information
            $this->savePhysicians( $referral, $request->physicians);

            // Save Issues and Items to Address
            $referral->issuesAndItemsToAddress()->create( $request->issue);

            // Save Defense Attorney Information
             $referral->attorneyInformation()->create($request->defenseAttorney);

            // Save Claimant Attorney Information
             $referral->attorneyInformation()->create($request->claimantAttorney);

            // Save Appointment Information
             $referral->appointmentInformation()->create($request->appointments);

            DB::commit(); 
            return back()->with([
                'success' => 'Referral created successfully.',
                'response' => $referral->id
            ]);
           
        } catch (Exception $e) {
            DB::rollBack();
            info( $e->getMessage());
            return to_route('request-forms.create')->with(['error' =>'Something went wrong']);
        }
    }

    // Saves the physician information
    private function savePhysicians($referral, $physicians)
    {
        foreach ($physicians as $physician) {
            if (!empty($physician['last_name']) && !empty($physician['first_name'])) {
                $referral->physicianInformation()->create($physician);
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
