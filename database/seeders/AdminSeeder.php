<?php

namespace Database\Seeders;

use App\Models\Classroom;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@laurisdan.com',
            'password' => Hash::make('password2018'),
            'role'  => 'admin',
        ]);

        // ,,,,,

        User::create([
            'name'=>'Teacher Admin',
            'email'=>'teacheradmin@laurisdan.com',
            'password'=>bcrypt('password2018'),
            'role'=>'teacher'
        ]);

        User::create([
            'name'=>'Student',
            'email'=>'studen1@laurisdan.com',
            'password'=>bcrypt('password2018'),
            'role'=>'student'
        ]);
        // for($i=1;$i<=6;$i++){
        //      Classroom::create(['name'=>'Primary '.$i,'level'=>'Primary '.$i]); }
    
        // ;;;;;

        
    }
}
