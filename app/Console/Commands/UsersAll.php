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
        $users = User::all(['name', 'nickname', 'email'])->toArray();
        $headers = ['Name', 'Nickname', 'Email'];

        $this->table($headers, $users);
        return 0;
    }
}
