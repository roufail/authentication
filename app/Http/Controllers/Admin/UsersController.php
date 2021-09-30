<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\Admins\UserFormRequest;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        return view("admin.users.list",compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        $roles = Role::pluck('name','id');
        return view("admin.users.form",compact("user","roles"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserFormRequest $request)
    {
        $user = User::create($request->validated());

        if($user){
            $user->assignRole($request->role);
            return redirect()->route('admin.users.index')->with(['success' => 'User created successfully!']);
        }
        return redirect()->route('admin.users.index')->withErrors(['error' => 'Something went wrong!']);
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
    public function edit(User $user)
    {
        return view("admin.users.form",compact("user"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserFormRequest $request, User $user)
    {
        $fileds = $request->validated();

        if (!$fileds['password']) {
	        unset($fileds['password']);
		}
        

        $user->update($fileds);
        
        if($user){
            $user->assignRole($request->role);
            return redirect()->route('admin.users.index')->with(['success' => 'User updated successfully!']);
        }

        return redirect()->back()->withErrors(['error' => 'Something went wrong!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user->delete()){
            return redirect()->route('admin.users.index')->with(['success' => 'User deleted successfully!']);
        }
        return redirect()->route('admin.users.index')->withErrors(['error' => 'Something went wrong!']);
     }
}
