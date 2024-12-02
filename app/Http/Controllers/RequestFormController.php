<?php

namespace App\Http\Controllers;

use Exception;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\ReferralsAudit;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreFormRequest; 
use App\Models\{State, Referral , ClaimType, Specialty, Attachment, ServiceType};

class RequestFormController extends Controller
{
    public function index()
    {
        $referrals = Referral::latest()->paginate(10);
        return Inertia::render('Frontend/RequestForm/index', [
            'referrals' => $referrals,
        ]);  
    }

    public function create()
    {
        $claimTypes = ClaimType::all();
        $states = State::all();
        $serviceTypes= ServiceType::all();
        $specialties = Specialty::all();
        return Inertia::render(
            'Admin/RequestForm/form',
            [
                'claimTypes' => $claimTypes,
                'states' => $states,
                'serviceTypes' => $serviceTypes,
                'specialties' => $specialties,
            ]
        );
    }

    public function show($id)  
    {
        $referral = Referral::with([
            'billToInformation',
            'claimantInformation.service',
            'claimantInformation.claim',
            'physicianInformation',
            'issuesAndItemsToAddress',
            'claimantAttorney',
            'defenseAttorney',
            'appointmentInformation.specialty',
            'attachments',
        ])->find($id);

        return Inertia::render('Admin/RequestForm/show', [
            'referral' => $referral
        ]);
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
            if (!empty($request->physicians)) {
                $this->savePhysicians($referral, $request->physicians);
            }

            // Save Issues and Items to Address
            if (!empty($request->issue)) {
                $referral->issuesAndItemsToAddress()->create($request->issue);
            }
       
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

            return Inertia::render('Frontend/RequestForm/response');

        } catch (Exception $e) {
            DB::rollBack();
            info($e->getMessage());
            return to_route('request-forms.create')->with(['error' => 'Something went wrong']);
        }
    }

    public function response()
    {
        return Inertia::render('Frontend/RequestForm/response');
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
                if ($file) {
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

    public function changeStatus(Request $request)
    {
        DB::beginTransaction();

        try {
            $referral = Referral::findOrFail($request->id);
            $referral->status = $request->status;
            $referral->save();

            DB::commit();
            return to_route('request-forms.index')->with('success', 'Status changed successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return to_route('request-forms.index')->with('error', 'Something went wrong');
        }
    }

    public function destroy($id): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $role = Referral::findOrFail($id);
            $role->delete();

            DB::commit();
            return to_route('request-forms.index')->with('success', 'Referral deleted successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return to_route('request-forms.index')->with('error', 'Something went wrong');
        }
    }

    public function viewAudit()
    {
        
        try {
            $auditlogs = ReferralsAudit::with('user')->latest()->paginate(10);
            
            return Inertia::render('Admin/RequestForm/audit', [
                'auditlogs' => $auditlogs
            ]);
        } catch (Exception $e) {
            return to_route('modules.index')->with('error', 'Failed to load modules');
        }
    }
    
}
