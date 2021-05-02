<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use DatabaseTransactions;
    private  $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->suspended()->create();
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRoute()
    {
        $response = $this->get('/profile');
        $this->assertFalse('200' == $response->getStatusCode());

        $response = $this->actingAs($this->user)->get('/profile/' . $this->user->id);
        $response->assertOk();
        var_dump($this->user->name);
        $response->assertSee('Profile of user: ' . $this->user->name );
    }
}
