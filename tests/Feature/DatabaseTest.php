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

    public function testCreateAppUserViaFactory()
    {
        $user = AppUser::factory()->create([
            'name' => 'user',
            'email' => 'user@mail.com',
            'login' => 'guest',
            'password' => '123'
        ]);

        $this->assertDatabaseHas('users', ['login' => $user->login], 'mysql');

    }

    public function testCreateAppUserViaFactoryWithFake()
    {
        $user = AppUser::factory()->create();

        $this->assertNotEmpty($user->name);
        $this->assertNotEmpty($user->login);
        $this->assertNotEmpty($user->email);
        $this->assertNotEmpty($user->password);

        var_dump($user);
        $this->assertDatabaseHas('users', ['login' => $user->login], 'mysql');
    }

    public function testCreateAppUserViaConstuctor()
    {
        $user = new AppUser();
        $user['name'] = 'newUser';
        $user['login'] = 'junior';
        $user['password'] = 'qwerty';
        $user['email'] = 'newUser@mail.com';

        $this->assertTrue($user->save());

        $this->assertDatabaseHas('users', ['login' => $user->login], 'mysql');
    }
}
