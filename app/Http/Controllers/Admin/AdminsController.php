<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Http\Requests\Admins\AdminFormRequest;
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
        return view("admin.admins.list",compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Admin $admin)
    {
        return view("admin.admins.form",compact("admin"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminFormRequest $request)
    {
        $admin = Admin::create($request->validated());

        if($admin){
            return redirect()->route('admin.admins.index')->with(['success' => 'Admin created successfully!']);
        }
        return redirect()->route('admin.admins.index')->withErrors(['error' => 'Something went wrong!']);
 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        return view("admin.admins.form",compact("admin"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminFormRequest $request,Admin $admin)
    {
        $fileds = $request->validated();

        if ($fileds['password']) {
	        unset($request['password']);
		}


        $admin = $admin->update($fileds);
        


        if($admin){
            return redirect()->route('admin.admins.index')->with(['success' => 'Admin updated successfully!']);
        }
        return redirect()->back()->withErrors(['error' => 'Something went wrong!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
       if($admin->delete()){
           return redirect()->route('admin.admins.index')->with(['success' => 'Admin deleted successfully!']);
       }
       return redirect()->route('admin.admins.index')->withErrors(['error' => 'Something went wrong!']);
    }
}
