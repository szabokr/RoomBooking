<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class admin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make admin user';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.hu',
            'phone' => '06000000000',
            'permission_id' => '3',
            'password' => Hash::make('admin')
        ]);
        echo "Admin created.";
    }
}
