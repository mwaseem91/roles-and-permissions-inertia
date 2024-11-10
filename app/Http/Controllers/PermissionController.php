<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use App\Models\Module;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    public $model;

    // Constructor to bind model to repo
    public function __construct(Permission $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $models= $this->model->join('modules','modules.id','=','permissions.module_id')
            ->select('permissions.*','modules.name as module')->get();
           
            return Inertia::render('Admin/Role/ListRole' , [
                'models' => $models
            ]);
    }

    // Get Module List
    public function create()
    {
        $modules =Module::get();
        return Inertia::render('Admin/Permission/Form' , [
            'modules' =>  $modules
        ]);
       
    }
  

    // Store Permission in Database
    public function store(Request $request)
    {

        DB::beginTransaction();
        try {
            $this->model->create([

                'module_id' => $request->module,
                'name' => $request->name,
                'type' => $request->type
            ]);
            DB::commit();
            return to_route('permissions.index')->with('success', 'Permission Added Successfully');
        } catch (\Exception $e) {

            DB::rollback();
            return to_route('permissions.index')->with('danger', 'Something went Wrong');
        }
    }
    public function edit($id)
    {
       

        $module = Module::get();

        $detail = $this->model->join('modules','modules.id','=','permissions.module_id')
        ->select('permissions.*','modules.name as module')->where('permissions.id','=',$id)->first();

        return view('pages.permission.edit',compact('detail','module','breadCumb'));
    }

    // Get Permission Detail By ID
    public function show($id)
    {
        return $this->model->join('modules','modules.id','=','permissions.module_id')
            ->select('permissions.*','modules.name as module')->where('permissions.id','=',$id)->first();

            $associated = $this->associatedRole($id);
            return view('pages.permission.view', compact('detail', 'associated', 'breadCumb'));
    }

    // Update Permission Data in Database
    public function update(array $data, $id)
    {
        return $this->model->find($id)->update([

            'module_id' => $data['module'],
            'name' => $data['name'],
            'type' => $data['type']
        ]);
    }

    // Get Associated Role Against Permission
    public function associatedRole($id)
    {
        return $this->model->join('role_has_permissions','role_has_permissions.permission_id','=','permissions.id')
            ->join('roles','roles.id','=','role_has_permissions.role_id')
            ->select('roles.name as role','permissions.*')->where('permissions.id','=',$id)->get();
    }

    // Destroy Permission in Database
    public function destroy(array $data)
    {
        return $this->model->find($data['permission_id'])->delete();
    }
}
