<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Module extends Model
{
    use HasFactory;

    protected $guarded =  ['id'];

    /**
     *  Boot Function
     */
           
     public static function booted()
     {
         static::created(function ($module) {
             $permissions = ['create', 'view', 'edit', 'delete'];
             foreach ($permissions as $action) {
                 $permissionName = "{$module->name}_{$action}";
                 $permissionName = str_replace(' ', '_', $permissionName);
                 Permission::firstOrCreate(['name' => $permissionName,'module_id' => $module->id]);
             }
             app()[PermissionRegistrar::class]->forgetCachedPermissions();
         });
         static::deleted(function ($module) {
             Permission::where('name', 'like', "{$module->name}_%")->delete();
             app()[PermissionRegistrar::class]->forgetCachedPermissions();
         });
     }

    public function permission()
    {
        return $this->hasMany(\Spatie\Permission\Models\Permission::class,'module_id','id');
    }
}
