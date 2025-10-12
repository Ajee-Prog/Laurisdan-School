<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['title'=>'English Primer',
            'author'=>'A. Author',
            'isbn'=>'EN001',
            'quantity'=>10,
            'notes'=>'For Primary classes'],

            ['title'=>'Mathematics Basics',
            'author'=>'B. Author',
            'isbn'=>'MA001',
            'quantity'=>12,
            'notes'=>'Core textbook'],

            ['title'=>'Basic Science',
            'author'=>'C. Author',
            'isbn'=>'SC001',
            'quantity'=>8,
            'notes'=>'Lab manual not included'],
            ['title'=>'Computer Programming',
            'author'=>'YusTech. Author',
            'isbn'=>'CP001',
            'quantity'=>10,
            'notes'=>'For Primary classes'],
        ];
        foreach($items as $b){
            Book::create($b);
        }



    }
}
