<?php

namespace App\Http\Controllers;

use Exception;
use Inertia\Inertia;
use App\Models\Module;
use App\Http\Requests\ModuleRequest;

class ModuleController extends Controller
{
    public function index()
    {
        try {
            $modules = Module::get();
            return Inertia::render('Admin/Module/index', [
                'modules' => $modules
            ]);
        } catch (Exception $e) {
            return to_route('modules.index')->with('error', 'Failed to load modules');
        }
    }
    
    public function create()
    {
        try {
            return Inertia::render('Admin/Module/create');
        } catch (Exception $e) {
            return to_route('modules.index')->with('error', 'Failed to load module creation page');
        }
    }
    
    public function store(ModuleRequest $request)
    {
        try {
            Module::create(['name' => $request->name]);
            return to_route('modules.index')->with('success', 'Module created successfully');
        } catch (Exception $e) {
            return back()->with('error', 'Failed to create module');
        }
    }

    public function edit($id)
    {
        try {
            $module = Module::findOrFail($id);

            return Inertia::render('Admin/Module/create', [
                'module' => $module
            ]);
        } catch (Exception $e) {
            return to_route('modules.index')->with('error', 'Failed to load module edit page');
        }
    }
    
    public function update(ModuleRequest $request, $id)
    {
        try {
            $module = Module::findOrFail($id);
            $module->update(['name' => $request->name]);

            return to_route('modules.index')->with('success', 'Module updated successfully');
        } catch (Exception $e) {
            return back()->with('error', 'Failed to update module');
        }
    }

    public function destroy($id)
    {
        try {
            $module = Module::findOrFail($id);
            $module->delete();

            return to_route('modules.index')->with('success', 'Module deleted successfully');
        } catch (Exception $e) {
            return to_route('modules.index')->with('error', 'Failed to delete module');
        }
    }
}
