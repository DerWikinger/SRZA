<?php

use App\Models\User;
use PHPUnit\Framework as Test;

class ProfileCest
{
    private $user;

    public function _before(FunctionalTester $I)
    {
        $this->user = User::all()
            ->where('email', 'like', 'member@gmail.com')
            ->first();
    }

    // tests
    public function loginUserTest(FunctionalTester $I)
    {
        $I->wantToTest('Login of user');
        $I->amOnPage('/');
        $I->see('Login');
        $I->click('Login');
        $I->amOnPage('login');
        $I->fillField('#email', 'member@gmail.com');
        $I->seeInField('#email', 'member@gmail.com');
        $I->comment('I put wrong password to test login failed');
        $I->fillField('#password', '1234567');
        $I->seeInField(['name' => 'password'], '1234567');
        $I->click('button[type=submit]');
        sleep(1);
        $I->expect('Login was failed');
        $I->see('These credentials do not match our records');

        $I->fillField('#password', '12345678');
        $I->seeInField(['name' => 'password'], '12345678');
        $I->seeInField('#email', 'member@gmail.com');
        $I->click('button[type=submit]');
        sleep(3);
        $I->expect('Login was success and i have been redirected to Home page');
        $I->seeCurrentRouteIs('home');
        $I->expect('I am logged user');
        $I->canSeeAuthentication('web');
        $I->see('Profile');
    }

    public function updateAvatarTest(FunctionalTester $I)
    {
        $I->wantToTest('Upload of new avatar image');
        $I->comment('I need to login');
        $I->amOnPage('/');
        $I->see('Login');
        $I->click('Login');
        $I->amOnPage('login');
        $I->fillField('#email', 'member@gmail.com');
        $I->fillField('#password', '12345678');
        $I->click('button[type=submit]');
        sleep(2);
        $I->canSeeAuthentication('web');
        Test\assertEquals(auth()->id(), $this->user->id);
        $I->see('Profile');
        $I->click('Profile');
        $I->amOnPage('/profile/' . $this->user->id);
        $I->seeElement('input[type=file]');
        $I->seeElement('#avatar');
        $fileName = $I->grabAttributeFrom('#avatar', 'alt');
        $count = 0;
        if (!str_contains($fileName ?? '', 'default')
            && preg_match('/^.*_(\d+).[a-z]{3,4}$/', $fileName, $data)) {
            $count = is_numeric($data[1]) ? (int)$data[1] : 0;
        }
        $I->attachFile('input[name=avatar_image]', 'test_avatar.jpg');
        $I->click('button[type=submit]');
        sleep(2);
        $I->expect('My new avatar is uploaded and i can view that');
        $I->amOnPage('/profile/' . $this->user->id);
        $I->seeElement('#avatar');
        $fileName = $I->grabAttributeFrom('#avatar', 'alt');
        $new_count = 1;
        if (preg_match('/^.*_(\d+).[a-z]{3,4}$/', $fileName, $data)) {
            $new_count = is_numeric($data[1]) ? (int)$data[1] : 1;
        }
        $I->expect('Number of my avatar image was increased by one');
        Test\assertEquals($count + 1, $new_count);
        $I->comment('I need to delete new test image from storage');
        \Illuminate\Support\Facades\Storage::delete('/public/images/avatars/' . $this->user->id . '/' . $fileName);
    }
}
