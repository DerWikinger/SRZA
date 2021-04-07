<?php

namespace Tests\Feature;

use App\Models\AppUser;
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
        $rows = AppUser::all(['name', 'login', 'email'])->toArray();
        $this->artisan('users:all')->expectsTable(['Name', 'Login', 'Email'], $rows);
    }
}
