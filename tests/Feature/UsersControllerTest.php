<?php

namespace Tests\Feature;

use App\Models\Role;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;
use App\Models\User;

class UsersControllerTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();
//        Artisan::call('key:generate');
//        Http::fake();
        $this->seed('DatabaseSeeder');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndexView()
    {
        $this->assertTrue(User::all()->count() >= 10);
        $response = $this->get('/users');

        $this->assertTrue('401' == $response->getStatusCode());

        $user = User::factory()->suspended()->create();
        $this->assertEquals(Role::admin(), $user->role);
        $response = $this->actingAs($user)->get('/users');
        $response->assertOk();
    }
}
