<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\AdminSeeder;
use Database\Seeders\BookTableSeeder;
use Database\Seeders\ClassSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // $this->call(AdminSeeder::class);
        
        $this->call([
            // UserSeeder::class,
            AdminSeeder::class,
            BookTableSeeder::class,
            ClassSeeder::class
            
            // OtherSeederClass::class, // Add other seeder classes here to make it cleans
        ]);


        // $this->call(BookTableSeeder::class);
        // $this->call(ClassSeeder::class);
    }
}
