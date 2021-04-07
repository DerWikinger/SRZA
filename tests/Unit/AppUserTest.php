<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\TestCase;
use App\Models\AppUser;

class AppUserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $user = new AppUser;
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

        $login = 'johnV';
        $user->login = $login;  //set
        $this->assertEquals($login, $user->login);  //get

        $password = '123';
        $user->password = $password;  //set
        $this->assertEquals($password, $user->password);  //get
    }

}
