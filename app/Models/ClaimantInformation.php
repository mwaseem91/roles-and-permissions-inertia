<?php

namespace App\Models;

use App\Models\ClaimType;
use Illuminate\Database\Eloquent\Model;

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
}
