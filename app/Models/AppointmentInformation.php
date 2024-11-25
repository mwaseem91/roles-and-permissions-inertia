<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppointmentInformation extends Model
{
    protected $guarded = [];
    protected $table = 'appointment_informations';


    function specialty()
    {
        return $this->belongsTo(Specialty::class ,'specialty' , 'id');
    }
}
