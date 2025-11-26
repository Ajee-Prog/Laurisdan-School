<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// use App\Models\User;
use Illuminate\Support\Facades\DB;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classes')->insert([
           [ 'name' => 'Primary 1','slug'=> 'primary-1'],
           [ 'name' => 'Primary 2','slug'=> 'primary-2'],
           [ 'name' => 'Primary 3','slug'=> 'primary-3'],
           [ 'name' => 'Primary 4','slug'=> 'primary-4'],
           [ 'name' => 'Primary 5','slug'=> 'primary-5'],
           [ 'name' => 'Primary 6','slug'=> 'primary-6'],
            
        ]);
    }
}
