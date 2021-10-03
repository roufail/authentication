<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\API\UserFormRequest;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use App\Resource\Admin\UserResource;
use App\Http\Resources\Admin\UserCollection;


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
        return $this->response(new UserCollection($users),'Users retrived successfully');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserFormRequest $request)
    {
        $role = Role::where(['name' => $request->role,'guard_name' => 'web']);
        if(!$role->count()) {
            return $this->error([],'Role Not exists');
        }
        $fileds = $request->validated();
        $fileds['password'] =  bcrypt($fileds['password']);
        $user = User::create($fileds);
        try {
            $user->assignRole($request->role);
        }catch(\Exception $e) {
            return $this->error([],$e->getMessage());
        }
        return $this->response(new UserResource($users),'User stored successfully');
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserFormRequest $request, $id)
    {

        $user = User::find($id);
        if(!$user) {
            return $this->error('Requested model not found');
        }
        
        $fileds = $request->validated();
        $fileds['password'] =  bcrypt($fileds['password']);
        $user->update($fileds);
        return $this->response(new UserResource($users),'user updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if(!$user) {
            return $this->error('Requested model not found');
        }

        if($user->delete()) {
            return $this->response(true,'User deleted successfully');
        }

    }



    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:50'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }


        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
                	'success' => false,
                	'message' => 'Login credentials are invalid.',
                ], 400);
            }
        } catch (JWTException $e) {
                
            return $credentials;
                return response()->json([
                        'success' => false,
                        'message' => 'Could not create token.',
                    ], 500);

        }

 	    return response()->json([
            'success' => true,
            'token' => $token,
        ]);

       return $this->createNewToken($token);

    }
}
