<?php

namespace Database\Factories;

use App\Models\AppUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AppUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $f = $this->faker;
        return [
            'name' => $f->name,
            'login' => $f->name,
            'email' => $f->email,
            'password' => $f->password,
            'id' => $f->randomNumber()
        ];
    }
}
