<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Resource\Admin\AdminResource;
use App\Http\Resources\Admin\AdminCollection;
use App\Http\Requests\API\AdminFormRequest;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::paginate(10);
        return $this->response(new AdminCollection($admins),'Admins retrived successfully');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminFormRequest $request)
    {
        $fileds = $request->validated();
        $fileds['password'] =  bcrypt($fileds['password']);
        $admin = Admin::create($fileds);
        return $this->response(new AdminResource($admin),'Admins stored successfully');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminFormRequest $request, $id)
    {
        $admin = Admin::find($id);
        if(!$admin) {
            return $this->error('Requested model not found');
        }

        $fileds = $request->validated();
        $fileds['password'] =  bcrypt($fileds['password']);
        $admin->update($fileds);
        return $this->response(new AdminResource($admin),'Admins updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Admin::find($id);

        if(!$admin) {
            return $this->error('Requested model not found');
        }

        if($admin->delete()) {
            return $this->response(true,'Admin deleted successfully');
        }
    }
}
