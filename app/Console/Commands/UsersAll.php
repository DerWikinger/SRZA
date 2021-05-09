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
    protected $signature = 'users:all
                            {--withTrashed : Whether to show deleted users}';

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
        $users = ($this->option('withTrashed') ? User::withTrashed()->get() : User::all());
        $data = [];
        foreach ($users as $user)
        {
            $data[] = [
                'name' => $user->name,
                'nickname' => $user->nickname,
                'role' => $user->role ? $user->role->name : 'No role',
                'email' => $user->email,
                'verified' => $user->hasVerifiedEmail() ? 'Yes' : 'No',
            ];
        }
        $headers = ['Name', 'Nickname', 'Role', 'Email', 'Verified'];

        $this->table($headers, $data);
        return 0;
    }
}
