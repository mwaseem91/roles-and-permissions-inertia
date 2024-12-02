<?php

namespace App\Models;

use App\Models\ModelWithAudit;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Module extends ModelWithAudit
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
