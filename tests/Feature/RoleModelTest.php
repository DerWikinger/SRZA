<?php

namespace Tests\Feature;

use App\Models\Role;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoleModelTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAdmin()
    {
        $admin = Role::where('name', 'like', 'admin')->first();
        $this->assertNotNull(Role::admin());
        $this->assertEquals($admin, Role::admin());
    }

    public function testMember()
    {
        $member = Role::where('name', 'like', 'member')->first();
        $this->assertNotNull(Role::member());
        $this->assertEquals($member, Role::member());
    }
}
