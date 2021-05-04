<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
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
            'nickname' => 'guest',
            'password' => '123'
        ]);

        $this->assertDatabaseHas('users', ['email' => $user->email], 'mysql');

    }

    public function testCreateAppUserViaFactoryWithFake()
    {
        $user = User::factory()->create();

        $this->assertNotEmpty($user->name);
        $this->assertNotEmpty($user->nickname);
        $this->assertNotEmpty($user->email);
        $this->assertNotEmpty($user->password);

        $this->assertDatabaseHas('users', ['email' => $user->email], 'mysql');
    }

    public function testCreateAppUserViaConstuctor()
    {
        $user = new User();
        $user['name'] = 'newUser';
        $user['nickname'] = 'junior';
        $user['password'] = 'qwerty';
        $user['email'] = 'newUser@mail.com';

        $this->assertTrue($user->save());

        $this->assertDatabaseHas('users', ['email' => $user->email], 'mysql');
    }

}
