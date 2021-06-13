<?php

use Illuminate\Database\Seeder;

class BookUserReadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<50;$i++){
            $bookIds    = DB::table('books')->pluck('id');
            $userIds    = DB::table('users')->pluck('id');
            $rating     = rand(1,5);

            DB::table('book_user_read')->insert(
                [
                    'book_id'       => $bookIds->random(),
                    'user_id'       => $userIds->random(),
                    'rating'        => $rating,
                    'read_date'     => now(),
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ]
            );
        }
    }
}
