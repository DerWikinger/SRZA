<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use App\Models\User;

class UsersControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndexView()
    {
        Artisan::call('key:generate');
        $response = $this->get('/users');

        $response->assertRedirect('/login');

        $admin = User::all()->where('login', 'like', 'admin')->first();

        Auth::loginUsingId($admin->id);
        $this->assertTrue(Auth::check());

        $response = $this->get('/users');
        $response->assertSee('Users list');
    }
}
