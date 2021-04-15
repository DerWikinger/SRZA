<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use App\Models\User;

class UsersControllerTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndexView()
    {
        Artisan::call('key:generate');
        $response = $this->get('/users');

        $this->assertTrue('401' == $response->getStatusCode());

        $user = User::factory()->suspended()->create();
        $response = $this->actingAs($user)->get('/users');
        $response->assertOk();
    }
}
