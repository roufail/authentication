<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use JWTAuth;
use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class createAdminApiTest extends TestCase
{

    private $api_token;

    protected function setUp() :void 
    {
        parent::setUp();
        auth()->shouldUse('admins');
        $this->api_token = 'bearer '.JWTAuth::attempt([
            'email' => 'osama.saieed@gmail.com',
            'password' => '123456789'
        ]);

       if(!$this->api_token)
            $response->assertStatus(500);
            
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_admin()
    {
        $email = Str::random(10).'@gmail.com';
        $admin = [
            'name' => 'osama',
            'email' => $email,
            'password' => '123456789',
            'confirm_password' => '123456789'
        ];

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => $this->api_token,
        ])->json('post','/api/admin/admins', $admin);
        $admin_cred = [
            'name' => 'osama',
            'email' => $email,
        ];
        $this->assertDatabaseHas('admins', $admin_cred);
    }



    
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_update_admin()
    {

        $email = Str::random(10).'@gmail.com';
        $admin = [
            'name' => 'osama',
            'email' => $email,
            'password' => '123456789',
            'confirm_password' => '123456789',
        ];

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => $this->api_token,
        ])->json('put','/api/admin/admins/3', $admin);

        $admin_cred = [
            'name' => 'osama',
            'email' => $email,
        ];
        $this->assertDatabaseHas('admins', $admin_cred);
    }



    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_delete_admin()
    {
        $id = "29";
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => $this->api_token,
        ])->json('delete','/api/admin/admins/'.$id);
        $this->assertStringContainsString('deleted successfully', $response->json()['message']);
    }

}
