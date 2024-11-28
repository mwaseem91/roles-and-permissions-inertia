<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $guarded = [];

    protected $casts = [
        'file_path' => 'encrypted',
        'file_name' => 'encrypted',
    ];
}
