<?php

namespace Tests\Browser;

use App\Models\Role;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegisterNewUserTest extends DuskTestCase
{
    /**
     * A Dusk test RegisterNewUser.
     *
     * @return void
     */
    public function testRegisterNewUser()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                ->assertSee(__('Register'))
                ->type('name', 'new_user')
                ->type('email', 'new_user@mail.com')
                ->type('password', 'password')
                ->type('password_confirmation', 'password')
                ->press(__('Register'));
            $user = \App\Models\User::all()
                ->where('email', 'like', 'new_user@mail.com')
                ->first();
            $this->assertEquals(Role::member(), $user->role);
        });
    }
}
