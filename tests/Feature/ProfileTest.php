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

    private $user;

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
        $response->assertSee(__('users.profileCardHeader'));

        $response = $this->actingAs($this->user)->get('/profile/' . ($this->user->id + 1));
        $this->assertTrue('401' == $response->getStatusCode());

        $timestamp = $this->user->email_verified_at;
        $this->user->email_verified_at = null;
        $response = $this->actingAs($this->user)->get('/profile/' . ($this->user->id));
        $response->assertSee('email/verify');
        $this->user->email_verified_at = $timestamp;
    }

    public function testEdit()
    {
        $nickname = 'new_nickname';

        $data = [
            'id' => $this->user->id,
            'name' => $this->user->name,
            'email' => $this->user->email,
            'nickname' => $nickname,
        ];
        $response = $this->actingAs($this->user)->put('/profile/update', $data);
        $response->assertRedirect('/profile/' . $this->user->id . '?saved=1');
        $this->assertDatabaseHas('users', ['id' => $this->user->id, 'nickname' => $nickname]);
    }
}
