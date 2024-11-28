<?php

namespace App\Models;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class AttorneyInformation extends Model
{
    protected $guarded = [];
    protected $table = 'attorney_informations';

    // Mutator for attorney_name
    protected function attorneyName(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value ? Crypt::decrypt($value) : null,
            set: fn (?string $value) => $value ? Crypt::encrypt($value) : null,
        );
    }

    // Mutator for firm_name
    protected function firmName(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value ? Crypt::decrypt($value) : null,
            set: fn (?string $value) => $value ? Crypt::encrypt($value) : null,
        );
    }

    // Mutator for address1
    protected function address1(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value ? Crypt::decrypt($value) : null,
            set: fn (?string $value) => $value ? Crypt::encrypt($value) : null,
        );
    }

    // Mutator for address2
    protected function address2(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value ? Crypt::decrypt($value) : null,
            set: fn (?string $value) => $value ? Crypt::encrypt($value) : null,
        );
    }

    // Mutator for city
    protected function city(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value ? Crypt::decrypt($value) : null,
            set: fn (?string $value) => $value ? Crypt::encrypt($value) : null,
        );
    }

    // Mutator for state
    protected function state(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value ? Crypt::decrypt($value) : null,
            set: fn (?string $value) => $value ? Crypt::encrypt($value) : null,
        );
    }

    // Mutator for zip_code
    protected function zipCode(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value ? Crypt::decrypt($value) : null,
            set: fn (?string $value) => $value ? Crypt::encrypt($value) : null,
        );
    }

    // Mutator for phone
    protected function phone(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value ? Crypt::decrypt($value) : null,
            set: fn (?string $value) => $value ? Crypt::encrypt($value) : null,
        );
    }

    // Mutator for fax
    protected function fax(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value ? Crypt::decrypt($value) : null,
            set: fn (?string $value) => $value ? Crypt::encrypt($value) : null,
        );
    }
}


