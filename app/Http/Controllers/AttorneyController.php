<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Attorney;
use App\Http\Requests\AttorneyRequest;
use Exception;

class AttorneyController extends Controller
{
    public function index()
    {
        try {
            $attorneys = Attorney::latest()->get();
            return Inertia::render('Admin/Attorney/index', ['attorneys' => $attorneys]);

        } catch (Exception $e) {
            return redirect()->route('attorneys.index')->with('error', 'Something went wrong');
        }
    }

    // Show form to create a new attorney (Create)
    public function create()
    {
        return Inertia::render('Admin/Attorney/create');
    }

    // Store new attorney (Create)
    public function store(AttorneyRequest $request)
    {
        try {
            Attorney::create($request->all());
            return redirect()->route('attorneys.index')->with('success', 'Attorney created successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function edit($id)
    {
        try {
            $attorney = Attorney::findOrFail($id);
            return Inertia::render('Admin/Attorney/create', ['attorney' => $attorney]);
       
        } catch (Exception $e) {
            return redirect()->route('attorneys.index')->with('error', 'Something went wrong');
        }
    }

    // Update attorney information (Update)
    public function update(AttorneyRequest $request, $id)
    {
        try {
            $attorney = Attorney::findOrFail($id);
            $attorney->update($request->all());

            return redirect()->route('attorneys.index')->with('success', 'Attorney updated successfully');

        } catch (Exception $e) {
            return redirect()->route('attorneys.index')->with('error', 'Something went wrong');
        }
    }

    // Delete an attorney (Delete)
    public function destroy($id)
    {
        try {
            $attorney = Attorney::findOrFail($id);
            $attorney->delete();

            return redirect()->route('attorneys.index')->with('success', 'Attorney deleted successfully');

        } catch (Exception $e) {
            return redirect()->route('attorneys.index')->with('error','Something went wrong');
        }
    }

}
