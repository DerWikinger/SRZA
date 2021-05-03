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
            $rows[] = [
                'name' => $user->name,
                'nickname' => $user->nickname,
                'role' => $user->role ? $user->role->name : 'No role',
                'email' => $user->email,
                'verified'=>$user->hasVerifiedEmail() ? 'Yes' : 'No',
            ];
        }
        $this->artisan('users:all')->expectsTable(['Name', 'Nickname', 'Role', 'Email', 'Verified'], $rows);
    }
}
