<?php

use Illuminate\Database\Seeder;

class AuthorBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i<50; $i++){
            $authorIds  = DB::table('authors')->pluck('id');
            $bookIds    = DB::table('books')->pluck('id');

            DB::table('author_book')->insert(
                [
                    'author_id'     => $authorIds->random(),
                    'book_id'       => $bookIds->random(),
                    'created_at'    => now(),
                    'updated_at'    => now()
                ]
            );
        }
    }
}
