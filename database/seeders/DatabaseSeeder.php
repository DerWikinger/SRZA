<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
//        $id = 3;
//        $value = '123';
//        $user = User::find($id);
//        $user['password'] = Hash::make($value);
//        $user->save();
    }
}
