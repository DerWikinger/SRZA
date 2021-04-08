<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DatabaseTest extends TestCase
{
    use InteractsWithDatabase;
    use DatabaseTransactions;

    /**
     * A test of creating new User via factory.
     *
     * @return void
     */
    public function testCreateAppUserViaFactory()
    {
        $user = User::factory()->create([
            'name' => 'user',
            'email' => 'user@mail.com',
            'login' => 'guest',
            'password' => '123'
        ]);

        $this->assertDatabaseHas('users', ['login' => $user->login], 'mysql');

    }

    public function testCreateAppUserViaFactoryWithFake()
    {
        $user = User::factory()->create();

        $this->assertNotEmpty($user->name);
        $this->assertNotEmpty($user->login);
        $this->assertNotEmpty($user->email);
        $this->assertNotEmpty($user->password);

        var_dump($user);
        $this->assertDatabaseHas('users', ['login' => $user->login], 'mysql');
    }

    public function testCreateAppUserViaConstuctor()
    {
        $user = new User();
        $user['name'] = 'newUser';
        $user['login'] = 'junior';
        $user['password'] = 'qwerty';
        $user['email'] = 'newUser@mail.com';

        $this->assertTrue($user->save());

        $this->assertDatabaseHas('users', ['login' => $user->login], 'mysql');
    }

}
