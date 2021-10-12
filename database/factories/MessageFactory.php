<?php

namespace Database\Factories;

use App\Models\Chat;
use App\Models\Message;
use Carbon\Carbon;
use Faker\Provider\Lorem;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Message::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $chat = Chat::first();
        $users = $chat->users->map(function ($user) {
            return $user->id;
        });
        $count = $users->count();
        return [
            'chat_id' => $chat->id,
            'user_id' => $users[ random_int(1, $count) - 1 ],
            'content' => Lorem::text(100),
        ];
    }
}
