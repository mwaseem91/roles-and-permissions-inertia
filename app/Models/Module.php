<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Module extends Model
{
    use HasFactory;

    protected $guarded =  ['id'];

    /**
     *  Boot Function
     */
           
    public function permission()
    {
        return $this->hasMany(\Spatie\Permission\Models\Permission::class,'module_id','id');
    }
}
