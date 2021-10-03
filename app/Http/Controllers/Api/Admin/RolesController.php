<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Admin\RoleResource;
use App\Http\Resources\Admin\RoleCollection;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Http\Requests\Admins\RoleFormRequest;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::paginate(10);
        return $this->response(new RoleCollection($roles),'Roles retrived successfully');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

            $role = Role::where(['name' => $request->name])->get();

            if(!$role->count()) {
                $role = Role::create(['name' => $request->name]);
                if($role){
                    $role->syncPermissions($request->permissions);
                    return $this->response(new RoleResource($role),'Role created successfully');
                }
            }else {
                return $this->error('This role Already exists');
            }
            return $this->error('Something went wrong');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::find($id);

        if($role) {
            $role->update(['name' => $request->name]);
    
            if($role){
                $role->syncPermissions($request->permissions);
                return $this->response(new RoleResource($role),'Role created successfully');
            }
        } else {
            return $this->error('this role doesn\'t exists');
        }

        return $this->error('something went wrong');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);

        if(!$role){
            return $this->error('Role doesn\'t exists');
        }

        if($role->delete()){
            return $this->response([],'Role deleted successfully');
        }

        return $this->error('something went wrong');


    }
}
