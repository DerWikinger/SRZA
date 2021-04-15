<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class UsersAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Returns all application users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::all();
        $data = [];
        foreach ($users as $user)
        {
            array_push($data, [
                'name' => $user->name,
                'nickname' => $user->nickname,
                'role' => $user->role ? $user->role->name : 'No role',
                'email' => $user->email
            ]);
        }
        $headers = ['Name', 'Nickname', 'Role', 'Email'];

        $this->table($headers, $data);
        return 0;
    }
}
