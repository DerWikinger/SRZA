<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RoleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Role::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $roles = \App\Models\Role::all();
        $role = $roles[random_int(0, $roles->count()-1)];
        return [
            'name' => $role->name,
            'access_level' => $role->access_level,
        ];
    }
}
