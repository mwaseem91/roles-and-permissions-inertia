<?php

namespace App\Models;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class IssuesAndItemsToAddress extends Model
{
    protected $guarded = [];

    protected $table = 'issues_and_items_to_addresses';


    protected function coverLetter(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value ? Crypt::decrypt($value) : null,
            set: fn (?string $value) => $value ? Crypt::encrypt($value) : null,
        );
    }
    protected function additionalInformation(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => $value ? Crypt::decrypt($value) : null,
            set: fn (?string $value) => $value ? Crypt::encrypt($value) : null,
        );
    }
}
