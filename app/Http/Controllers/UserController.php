<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
    
class UserController extends Controller
{
    
    public function index()
    {
        $users = User::latest()->with('roles')->get();
        return Inertia::render('Admin/User/index' , [
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
    
    
    public function store(UserStoreRequest $request): RedirectResponse
    {
       
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
    
        $user = User::create($input);
        $user->assignRole($request->role);
        return to_route('users.index')->with('success', 'Role created successfully'); 
    }
    
   
    
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::select('id', 'name')->get();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return Inertia::render('Admin/User/create' , [
            'user' => $user,
            'roles' => $roles,
            'userRole' => $userRole 
        ]);
    }
    
   
    public function update(UserUpdateRequest $request, $id): RedirectResponse
    {
       
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')->with('success','User updated successfully');
    }
    
   
    public function destroy($id): RedirectResponse
    {
        User::find($id)->delete();
       
        return to_route('users.index')->with('success','User deleted successfully');
    }
   
}
 