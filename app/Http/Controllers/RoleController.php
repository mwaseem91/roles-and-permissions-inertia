<?php
    
namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Http\Requests\RoleRequest;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::orderBy('id','DESC')->get();
        return Inertia::render('Admin/Role/ListRole' , [
            'roles' =>  $roles
        ]);
    }
    
  
    public function create()
    {
        $permissions = Permission::get();
        return Inertia::render('Admin/Role/Form' , [
            'permissions' =>  $permissions
        ]);
    }
    
   
    public function store(RoleRequest $request)
    {
        $permissionsID = array_map(
            function($value) { return (int)$value; },
            $request->input('permissions')
        );
        
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($permissionsID);
    
        return to_route('roles.index')->with('success', 'Role created successfully');
    }
   
    public function show($id)
    {
        $role = Role::find($id);
            $rolePermissions = Permission::join('role_has_permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
            ->where('role_has_permissions.role_id', $id)
            ->get();

        return Inertia::render('Roles/Show', [
            'role' => $role,
            'rolePermissions' => $rolePermissions
        ]);
    }
    
   
    public function edit($id)
    {
        $role = Role::with('permissions')->findOrFail($id);
        $rolePermissions = Permission::get();
       
        return Inertia::render('Admin/Role/Form', [
            'role' => $role,
            'permissions' => $rolePermissions
        ]);
    
    }
    
    
    public function update(RoleRequest $request, $id): RedirectResponse
    {
        $role = Role::find($id);
        $role->name = $request->name;
        $role->save();

        $permissionsID = array_map(
            function($value) { return (int)$value; },
            $request->permissions
        );
    
        $role->syncPermissions($permissionsID);
    
        return to_route('roles.index')->with('success', 'Role updated successfully');
    }
  
    public function destroy($id): RedirectResponse
    {
        $role = Role::find($id);
        $role->delete();
       
        return to_route('roles.index')->with('success','Role deleted successfully');
    }
}
