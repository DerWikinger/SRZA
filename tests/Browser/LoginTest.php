<?php

namespace Tests\Browser;

use App\Models\Role;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testLoginUser()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->assertSee(__('Login'))
                ->type('email', 'member@gmail.com')
                ->type('password', 'password')
                ->press(__('Login'));
            $user = \App\Models\User::all()
                ->where('email', 'like', 'member@gmail.com')
                ->first();
            $browser->assertAuthenticatedAs($user);
        });
    }
}
