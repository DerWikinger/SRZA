<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NavbarTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testNavbarUsersIcon()
    {
        $user = User::factory()->create();
        $this->assertEquals(Role::member(), $user->role);
        $response = $this->actingAs($user)->get('home');
        $response->assertDontSee('Users');

        $user = User::factory()->suspended()->create();
        $this->assertEquals(Role::admin(), $user->role);
        $response = $this->actingAs($user)->get('home');
        $response->assertSee('Users');
    }

    public function testNavbarProfileIcon()
    {
        $response = $this->get('home');
        $response->assertDontSee('Profile');

        $user = User::factory()->create();
        $this->assertEquals(Role::member(), $user->role);
        $response = $this->actingAs($user)->get('home');
        $response->assertSee('Profile');

        $user = User::factory()->suspended()->create();
        $this->assertEquals(Role::admin(), $user->role);
        $response = $this->actingAs($user)->get('home');
        $response->assertSee('Profile');
    }
}
