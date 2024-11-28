<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Casts\Attribute;

class PhysicianInformation extends Model
{
    protected $guarded = [];
    protected $table = 'physician_informations';

    protected function lastName(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value ? Crypt::decrypt($value) : null,
            set: fn (?string $value) => $value ? Crypt::encrypt($value) : null,
        );
    }

    protected function firstName(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value ? Crypt::decrypt($value) : null,
            set: fn (?string $value) => $value ? Crypt::encrypt($value) : null,
        );
    }

}


