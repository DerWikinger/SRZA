<?php

namespace Tests\Feature;

use App\Models\AppUser;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DatabaseTest extends TestCase
{
    use InteractsWithDatabase;
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */
//    public function testBasicTest()
//    {
//        $response = $this->get('/');
//
//        $response->assertStatus(200);
//    }

    public function createAppUserTest()
    {
        $user = AppUser::factory()->create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'login' => 'guest',
            'password' => '123'
        ]);

//        $user = new AppUser();
//        $user['name'] = 'administrator';
//        $user['login'] = 'admin';
//        $user['password'] = 'admin';
//        $user['email'] = 'admin@gmail.com';
//
//        $this->assertTrue($user->save());

        $this->assertDatabaseHas('users', ['login' => $user['login']], 'mysql');
    }
}
