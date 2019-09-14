<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateDefaultUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create default users of system';

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
     * @return mixed
     */
    public function handle()
    {
        //Truncate the user table
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('users')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $admin = [
            'email' => 'admin@example.com',
            'password' => 'admin@123'
        ];
        $user = [
            'email' => 'user@example.com',
            'password' => 'user@123'
        ];


        \App\User::create([
            'name' => 'Admin',
            'email' => $admin['email'],
            'password' => bcrypt($admin['password']),
            'role_id' => 1
        ]);

        \App\User::create([
            'name' => 'User',
            'email' => $user['email'],
            'password' => bcrypt($user['password']),
            'role_id' => 2
        ]);
        $this->output->write('Admin and User are successfully generated', true);
        $this->output->write('Admin...', true);
        $this->output->write('  Email : ' . $admin['email'], true);
        $this->output->write('  Password : ' . $admin['password'], true);
        $this->output->write('User...', true);
        $this->output->write('  Email : ' . $user['email'], true);
        $this->output->write('  Password : ' . $user['password'], true);
    }

}
