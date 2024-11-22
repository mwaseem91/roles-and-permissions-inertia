<?php

namespace App\Http\Controllers;

use Exception;
use Inertia\Inertia;
use App\Models\Referral;
use App\Models\ClaimType;
use App\Models\Attachment;
use Illuminate\Http\Request;
use App\Jobs\ProcessFileUploads;
use function PHPSTORM_META\type;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreFormRequest;
use Illuminate\Support\Facades\Storage;

class RequestFormController extends Controller
{
    public function index()
    {
        $userData = Referral::with(
                'referralInformation',
                'billToInformation',
                'claimantInformation',
                'physicianInformation',
                'issuesAndItemsToAddress',
                'claimantAttorney',
                'defenseAttorney',
                'appointmentInformation',
                'attachments'
            );

        return Inertia::render('Admin/RequestForm/index', [
            'userData' => $userData
        ]);
    }
    public function create()
    {
        $claimTypes = ClaimType::all();
        return Inertia::render(
            'Admin/RequestForm/form',
            [
                'claimTypes' => $claimTypes
            ]
        );
    }

    public function store(StoreFormRequest $request)
    {

        DB::beginTransaction();
        try {

            // Save Referral Information
            $referral = Referral::create($request->referralInfo);

            // Save BillTo Information
            $billInfo = $request->billInfo['same_as_referral'] == true ? $request->referralInfo : $request->billInfo;
            $referral->billToInformation()->create($billInfo);

            // Save Claimant Information
            $referral->claimantInformation()->create($request->claimants);

            // Save Physician Information
            $this->savePhysicians($referral, $request->physicians);

            // Save Issues and Items to Address
            $referral->issuesAndItemsToAddress()->create($request->issue);

            // Save Defense Attorney Information
            $referral->attorneyInformation()->create($request->defenseAttorney);

            // Save Claimant Attorney Information
            $referral->attorneyInformation()->create($request->claimantAttorney);

            // Save Appointment Information
            $referral->appointmentInformation()->create($request->appointments);

            // Save Attachments
            if ($request->hasFile('files')) {
                $this->fileUpload($referral->id, $request->file('files'));
            }

            DB::commit();
            return back()->with([
                'success' => 'Referral created successfully.',
               
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            info($e->getMessage());
            return to_route('request-forms.create')->with(['error' => 'Something went wrong']);
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

    public function fileUpload($referralId, $files)
    {
        try {
            foreach ($files as $file) {
                if ($file instanceof \Illuminate\Http\UploadedFile) {
                    $uploadedFile = Storage::disk('public')->putFileAs('files', $file,
                        time() . '_' . $file->getClientOriginalName()
                    );
    
                    Attachment::create([
                        'file_path' => $uploadedFile,
                        'referral_id' => $referralId,
                        'file_name' => $file->getClientOriginalName(),
                    ]);
                }
            }
        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    
}
