<?php
    
namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Module;
use App\Http\Requests\RoleRequest;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreRoleRequest;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Exception;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::orderBy('id','DESC')->get();
        return Inertia::render('Admin/Role/index' , [
            'roles' =>  $roles
        ]);
    }
    
  
    public function create()
    {
        $modules =Module::with('permission')->get();
        $permissions = Permission::join('modules','modules.id','=','permissions.module_id')
            ->select('permissions.*','modules.name as module_name')->get();

        return Inertia::render('Admin/Role/Form' , [
            'permissions' =>  $permissions,
            'modules' =>  $modules
        ]);
    }
    
   
    public function store(StoreRoleRequest $request)
    {
        $permissionsID = array_map(
            function($value) { return (int) $value; },
            $request->permissions
        );
        
        DB::beginTransaction();

        try {
            $role = Role::create(['name' => $request->name]);
            $role->syncPermissions($permissionsID);

            DB::commit();
            return to_route('roles.index')->with('success', 'Role created successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return to_route('roles.index')->with('error', 'Failed to create role' );
        }
    }
   
   
    public function edit($id)
    {
        $modules =Module::with('permission')->get();
        $role = Role::with('permissions')->findOrFail($id);
        $rolePermissions = Permission::get();
       
        return Inertia::render('Admin/Role/Form', [
            'role' => $role,
            'permissions' => $rolePermissions,
            'modules' => $modules
        ]);
    
    }
    
    
    public function update(RoleRequest $request, $id): RedirectResponse
    {
        $permissionsID = array_map(
            function ($value) { return (int) $value; },
            $request->permissions
        );

        DB::beginTransaction();

        try {
            $role = Role::findOrFail($id);
            $role->name = $request->name;
            $role->save();
            $role->syncPermissions($permissionsID);

            DB::commit();
            return to_route('roles.index')->with('success', 'Role updated successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return to_route('roles.index')->with('error', 'Failed to update role');
        }
    }
  
    public function destroy($id): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $role = Role::findOrFail($id);
            $role->delete();

            DB::commit();
            return to_route('roles.index')->with('success', 'Role deleted successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return to_route('roles.index')->with('error', 'Failed to delete role');
        }
    }
}
