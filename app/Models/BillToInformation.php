<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Casts\Attribute;

class BillToInformation extends Model
{
    protected $table = 'bill_to_informations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    
    // Referring Company
    protected function referringCompany(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value ? Crypt::decrypt($value) : null,
            set: fn (?string $value) => $value ? Crypt::encrypt($value) : null,
        );
    }

    // Referring Source
    protected function referringSource(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value ? Crypt::decrypt($value) : null,
            set: fn (?string $value) => $value ? Crypt::encrypt($value) : null,
        );
    }

    // Address1
    protected function address1(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value ? Crypt::decrypt($value) : null,
            set: fn (?string $value) => $value ? Crypt::encrypt($value) : null,
        );
    }

    // Address2
    protected function address2(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value ? Crypt::decrypt($value) : null,
            set: fn (?string $value) => $value ? Crypt::encrypt($value) : null,
        );
    }

    // City
    protected function city(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value ? Crypt::decrypt($value) : null,
            set: fn (?string $value) => $value ? Crypt::encrypt($value) : null,
        );
    }

    // State
    protected function state(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value ? Crypt::decrypt($value) : null,
            set: fn (?string $value) => $value ? Crypt::encrypt($value) : null,
        );
    }

    // Zip Code
    protected function zipCode(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value ? Crypt::decrypt($value) : null,
            set: fn (?string $value) => $value ? Crypt::encrypt($value) : null,
        );
    }

    // Phone
    protected function phone(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value ? Crypt::decrypt($value) : null,
            set: fn (?string $value) => $value ? Crypt::encrypt($value) : null,
        );
    }

    // Fax
    protected function fax(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value ? Crypt::decrypt($value) : null,
            set: fn (?string $value) => $value ? Crypt::encrypt($value) : null,
        );
    }
}
