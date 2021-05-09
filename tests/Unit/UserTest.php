<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUserConstructor()
    {
        $user = new User;
        $this->assertNotNull($user);

        $id = 1;
        $user->id = $id;  //set
        $this->assertEquals($id, $user->id); //get

        $name = 'John Vega';
        $user->name = $name;  //set
        $this->assertEquals($name, $user->name);  //get

        $email = 'john@gmail.com';
        $user->email = $email;  //set
        $this->assertEquals($email, $user->email);  //get

        $nickname = 'johnV';
        $user->nickname = $nickname;  //set
        $this->assertEquals($nickname, $user->nickname);  //get

        $password = '123';
        $user->password = $password;  //set
        $this->assertEquals($password, $user->password);  //get

        $user->nickname = '';
        $this->assertEquals($name, $user->username);

        $user->nickname = $nickname;
        $this->assertEquals($nickname, $user->username);
    }
}
