<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Inertia\Inertia;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function index()
    {
        $users = Module::latest()->with('roles')->get();
        return Inertia::render('Admin/User/ListUser' , [
            'users' =>  $users
        ]);
       
    }
    
   
    public function create()
    {
        $roles = Role::select('id', 'name')->get();
        return Inertia::render('Admin/User/create' , [
            'roles' => $roles
        ]);
    }
    
    
    public function store(Request $request): RedirectResponse
    {
       
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
    
        $user = Module::create($input);
        $user->assignRole($request->role);
        return to_route('users.index')->with('success', 'Role created successfully'); 
    }
    
   
    public function show($id)
    {
        $user = Module::find($id);

        return view('users.show',compact('user'));
    }
    
    
    public function edit($id)
    {
        $user = Module::find($id);
        $roles = Role::select('id', 'name')->get();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return Inertia::render('Admin/User/create' , [
            'user' => $user,
            'roles' => $roles,
            'userRole' => $userRole 
        ]);
    }
    
   
    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
    

        $user = Module::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }
    
   
    public function destroy($id): RedirectResponse
    {
        Module::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }
}
