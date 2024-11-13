<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Attorney;
use Illuminate\Http\Request;
use App\Http\Requests\AttorneyRequest;

class AttorneyController extends Controller
{
    public function index()
    {
        $attorneys = Attorney::all(); 
        return Inertia::render('Admin/Attorney/index', ['attorneys' => $attorneys]);
    }

    // Show form to create a new attorney (Create)
    public function create()
    {
        return Inertia::render('Admin/Attorney/create');
    }

    // Store new attorney (Create)
    public function store(AttorneyRequest $request)
    {
        Attorney::create($request->all());
        return redirect()->route('attorneys.index')->with('success', 'Attorney created successfully');
        
    }


    public function edit($id)
    {
        $attorney = Attorney::findOrFail($id);
        return Inertia::render('Admin/Attorney/create', ['attorney' => $attorney]);
    }

    // Update attorney information (Update)
    public function update(AttorneyRequest $request, $id)
    {
       
        $attorney = Attorney::findOrFail($id);
        $attorney->update($request->all());

        return redirect()->route('attorneys.index')->with('success', 'Attorney updated successfully');
    }

    // Delete an attorney (Delete)
    public function destroy($id)
    {
        $attorney = Attorney::findOrFail($id);
        $attorney->delete();

        return redirect()->route('attorneys.index')->with('success', 'Attorney deleted successfully');
    }
}
