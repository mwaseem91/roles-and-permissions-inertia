<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    
    protected $guarded = [];
    protected $table = 'referrals';



    public function billToInformation()
    {
        return $this->hasOne(BillToInformation::class);
    }

    public function claimantInformation()
    {
        return $this->hasOne(ClaimantInformation::class);
    }

    public function physicianInformation()
    {
        return $this->hasMany(PhysicianInformation::class);
    }

    public function issuesAndItemsToAddress()
    {
        return $this->hasOne(IssuesAndItemsToAddress::class);
    }

    public function attorneyInformation()
    {
        return $this->hasOne(AttorneyInformation::class);
    }
    public function defenseattorney()
    {
        return $this->hasOne(AttorneyInformation::class)->where('type', 'defense');
    }
    public function claimantAttorney()
    {
        return $this->hasOne(AttorneyInformation::class)->where('type', 'claimant');
    }

    public function appointmentInformation()
    {
        return $this->hasOne(AppointmentInformation::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }
}
