<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Config;

class UserTest extends TestCase
{
    /**
     * Login as default API user and get token back.
     *
     * @return void
     */
    public function test_doit_Login()
    {
        $email = Config::get('api.apiEmail');
        $password = Config::get('api.apiPassword');
        $baseUrl = Config::get('app.url') . '/api/login?email=' . $email . '&password=' . $password ;
        
        $response = $this->json('GET', $baseUrl, []);

        $response
            ->assertStatus(200);
    }

    public function test_doit_Logout()
    {
        $user = User::where('email', Config::get('api.apiEmail'))->first();
        $token = JWTAuth::fromUser($user);
        $baseUrl = Config::get('app.url') . '/api/logout?token=' . $token;

        $response = $this->json('GET', $baseUrl, []);

        $response
            ->assertStatus(200)
            ->assertExactJson([
                'success' => true,
                'message' => 'logout success'
            ]);
    }
}
