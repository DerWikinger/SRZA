<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use function PHPUnit\Framework\assertContains;

class ChangeAvatarTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testChangeAvatar()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->assertSee(__('Login'))
                ->type('email', 'member@gmail.com')
                ->type('password', '12345678')
                ->press(__('Login'))
                ->pause(500)
                ->seeLink(__('users.profileNavbarIcon'));
            $browser->clickLink(__('users.profileNavbarIcon'))
                ->pause(500)
                ->assertSeeIn('.card-header', __('users.profileCardHeader'));
            $alt = $browser->attribute('#avatar', 'alt');
            self::assertFalse(str_contains($alt, 'temp_avatar'));
            $browser->type('avatar_image', 'C:\PhpProjects\rockclub\tests\_data\test_avatar.jpg')
                ->pause(500);
            $alt = $browser->attribute('#avatar', 'alt');
            var_dump($alt);
            self::assertTrue(str_contains($alt, 'temp_avatar'));
        });
    }
}
