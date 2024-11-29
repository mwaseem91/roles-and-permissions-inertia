<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

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
