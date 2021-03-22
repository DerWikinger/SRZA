<?php

class UserTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testUser()
    {
        $user = new App\Models\AppUser;
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
