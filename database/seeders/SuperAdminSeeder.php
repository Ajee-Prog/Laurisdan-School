<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'superadmin@laurisdannpschool.com.ng'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password2018'),
                'role' => 'superadmin',
            ]
        );
    }
}
