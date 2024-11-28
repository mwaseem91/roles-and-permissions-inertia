<?php

namespace App\Models;

use App\Models\ClaimType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ClaimantInformation extends Model
{
    protected $guarded = [];
    protected $table = 'claimant_informations';

    public function service()
    {
        return $this->belongsTo(ServiceType::class , 'service_type', 'id');
    }
    public function claim()
    {
        return $this->belongsTo(ClaimType::class , 'claim_type', 'id');
    }
    
    // Encrypt and Decrypt for String Fields
    protected function encryptableField(): callable
    {
        return fn (?string $value) => $value ? Crypt::decrypt($value) : null;
    }

    protected function decryptableField(): callable
    {
        return fn (?string $value) => $value ? Crypt::encrypt($value) : null;
    }

    // Define accessors and mutators for all string and text fields
    protected function lastName(): Attribute { return Attribute::make(get: $this->encryptableField(), set: $this->decryptableField()); }
    protected function firstName(): Attribute { return Attribute::make(get: $this->encryptableField(), set: $this->decryptableField()); }
    protected function address1(): Attribute { return Attribute::make(get: $this->encryptableField(), set: $this->decryptableField()); }
    protected function address2(): Attribute { return Attribute::make(get: $this->encryptableField(), set: $this->decryptableField()); }
    protected function city(): Attribute { return Attribute::make(get: $this->encryptableField(), set: $this->decryptableField()); }
    protected function state(): Attribute { return Attribute::make(get: $this->encryptableField(), set: $this->decryptableField()); }
    protected function zipCode(): Attribute { return Attribute::make(get: $this->encryptableField(), set: $this->decryptableField()); }
    protected function homePhone(): Attribute { return Attribute::make(get: $this->encryptableField(), set: $this->decryptableField()); }
    protected function workPhone(): Attribute { return Attribute::make(get: $this->encryptableField(), set: $this->decryptableField()); }
    protected function ssn(): Attribute { return Attribute::make(get: $this->encryptableField(), set: $this->decryptableField()); }
   
    protected function employer(): Attribute { return Attribute::make(get: $this->encryptableField(), set: $this->decryptableField()); }
    protected function occupation(): Attribute { return Attribute::make(get: $this->encryptableField(), set: $this->decryptableField()); }
    protected function language(): Attribute { return Attribute::make(get: $this->encryptableField(), set: $this->decryptableField()); }
    protected function otherLanguage(): Attribute { return Attribute::make(get: $this->encryptableField(), set: $this->decryptableField()); }
    protected function claimNumber(): Attribute { return Attribute::make(get: $this->encryptableField(), set: $this->decryptableField()); }
    protected function jurisdiction(): Attribute { return Attribute::make(get: $this->encryptableField(), set: $this->decryptableField()); }
   
    protected function otherClaimType(): Attribute { return Attribute::make(get: $this->encryptableField(), set: $this->decryptableField()); }
    protected function insuredCarrier(): Attribute { return Attribute::make(get: $this->encryptableField(), set: $this->decryptableField()); }

    // Text Fields
    protected function injuryDescription(): Attribute { return Attribute::make(get: $this->encryptableField(), set: $this->decryptableField()); }
    protected function injuryBackground(): Attribute { return Attribute::make(get: $this->encryptableField(), set: $this->decryptableField()); }

    

   
}
