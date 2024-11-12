<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Module;
use App\Http\Requests\PermissionRequest;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::join('modules', 'modules.id', '=', 'permissions.module_id')
            ->select('permissions.*', 'modules.name as module_name')->get();

        return Inertia::render('Admin/Permission/index', [
            'permissions' => $permissions
        ]);
    }

    // Get Module List
    public function create()
    {
        try {
            $modules = Module::get();
            return Inertia::render('Admin/Permission/Form', [
                'modules' => $modules
            ]);
        } catch (\Exception $e) {
            return to_route('permissions.index')->with('error', 'Something went wrong');
        }
    }

    // Store Permission in Database
    public function store(PermissionRequest $request)
    {
        try {
            Permission::create([
                'module_id' => $request->module_id,
                'name' => $request->name,
            ]);

            return to_route('permissions.index')->with('success', 'Permission Added Successfully');
        } catch (\Exception $e) {
            return to_route('permissions.index')->with('error', 'Something went wrong');
        }
    }

    public function edit($id)
    {
        try {
            $modules = Module::get();
            $detail = Permission::join('modules', 'modules.id', '=', 'permissions.module_id')
                ->select('permissions.*', 'modules.name as module')->where('permissions.id', '=', $id)->first();

            return Inertia::render('Admin/Permission/Form', [
                'modules' => $modules,
                'detail' => $detail,
            ]);
        } catch (\Exception $e) {
            return to_route('permissions.index')->with('error', 'Something went wrong');
        }
    }

    // Update Permission Data in Database
    public function update(PermissionRequest $request, $id)
    {
        try {
            Permission::findOrFail($id)->update([
                'module_id' => $request->module_id,
                'name' => $request->name,
            ]);

            return to_route('permissions.index')->with('success', 'Permission Updated Successfully');
        } catch (\Exception $e) {
            return to_route('permissions.index')->with('error', 'Something went wrong');
        }
    }

    // Delete a Permission from the Database
    public function destroy($id)
    {
        try {
            $permission = Permission::findOrFail($id);
            $permission->delete();

            return to_route('permissions.index')->with('success', 'Permission deleted successfully');
        } catch (\Exception $e) {
            return to_route('permissions.index')->with('error', 'Something went wrong');
        }
    }

}
