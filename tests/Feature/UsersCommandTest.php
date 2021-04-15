<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UsersCommandTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUsersAll()
    {
        $users = User::all();
        $rows = [];
        foreach($users as $user)
        {
            array_push( $rows, [
                'name' => $user->name,
                'Nickname' => $user->nickname,
                'Role' => $user->role ? $user->role->name : 'No role',
                'email' => $user->email,
            ]);
        }
        $this->artisan('users:all')->expectsTable(['Name', 'Nickname', 'Role', 'Email'], $rows);
    }
}
