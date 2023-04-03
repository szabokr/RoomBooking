<?php

namespace Database\Seeders;

use App\Models\Permissions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'permission' => 'Guest',
            ],
            [
                'permission' => 'User',
            ],
            [
                'permission' => 'Admin',
            ],

        ];

        Permissions::insert($permissions);
    }
}
