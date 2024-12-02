<?php

namespace App\Models;

use App\Models\ModelWithAudit;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Referral extends  ModelWithAudit
{
    use SoftDeletes;
    protected $table = 'referrals';

    
    protected $guarded = [];



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

    // Encryption for sensitive data
    // Referring Company
    protected function referringCompany(): Attribute
    {
        return Attribute::make(
            get: fn(?string $value) => $value ? Crypt::decrypt($value) : null,
            set: fn(?string $value) => $value ? Crypt::encrypt($value) : null,
        );
    }

    // Referring Source
    protected function referringSource(): Attribute
    {
        return Attribute::make(
            get: fn(?string $value) => $value ? Crypt::decrypt($value) : null,
            set: fn(?string $value) => $value ? Crypt::encrypt($value) : null,
        );
    }

    // Address1
    protected function address1(): Attribute
    {
        return Attribute::make(
            get: fn(?string $value) => $value ? Crypt::decrypt($value) : null,
            set: fn(?string $value) => $value ? Crypt::encrypt($value) : null,
        );
    }

    // Address2
    protected function address2(): Attribute
    {
        return Attribute::make(
            get: fn(?string $value) => $value ? Crypt::decrypt($value) : null,
            set: fn(?string $value) => $value ? Crypt::encrypt($value) : null,
        );
    }

    // City
    protected function city(): Attribute
    {
        return Attribute::make(
            get: fn(?string $value) => $value ? Crypt::decrypt($value) : null,
            set: fn(?string $value) => $value ? Crypt::encrypt($value) : null,
        );
    }

    // State
    protected function state(): Attribute
    {
        return Attribute::make(
            get: fn(?string $value) => $value ? Crypt::decrypt($value) : null,
            set: fn(?string $value) => $value ? Crypt::encrypt($value) : null,
        );
    }

    // Zip Code
    protected function zipCode(): Attribute
    {
        return Attribute::make(
            get: fn(?string $value) => $value ? Crypt::decrypt($value) : null,
            set: fn(?string $value) => $value ? Crypt::encrypt($value) : null,
        );
    }

    // Phone
    protected function phone(): Attribute
    {
        return Attribute::make(
            get: fn(?string $value) => $value ? Crypt::decrypt($value) : null,
            set: fn(?string $value) => $value ? Crypt::encrypt($value) : null,
        );
    }

    // Fax
    protected function fax(): Attribute
    {
        return Attribute::make(
            get: fn(?string $value) => $value ? Crypt::decrypt($value) : null,
            set: fn(?string $value) => $value ? Crypt::encrypt($value) : null,
        );
    }
}
