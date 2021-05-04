<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserModelTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRoleOfNewUser()
    {
        $user = new User();
        $new_user_role = Role::find($user->role ? $user->roel->id : 0);
        $this->assertNull($new_user_role);
    }

    public function testRegisterNewUser()
    {
        $user = new User(['name'=>'new_user', 'email'=>'new_user@mail.com']);

        $this->assertNull($user->role);

        $token = 'bearer';
        $response = $this->withToken($token)->get('/register');
        $response->assertOk();

//        $response = $this->post('/register', [
//            '_token' => $token,
//            'name' => $user->name,
//            'email' => $user->email,
//            'password' => 'password',
//            'password_confirmation' => 'password'
//        ]);
//
//        $user = auth()->user();
//        var_dump($user);
////        $this->assertEquals(Role::member(), $user->role);
//        $response->assertRedirect('/home');
    }


}
