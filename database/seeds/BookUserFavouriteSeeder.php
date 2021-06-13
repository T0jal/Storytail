<?php

use Illuminate\Database\Seeder;

class BookUserFavouriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i<50; $i++){
            $bookIds    = DB::table('books')->pluck('id');
            $userIds    = DB::table('users')->pluck('id');

            DB::table('book_user_favourite')->insert(
                [
                    'book_id'       => $bookIds->random(),
                    'user_id'       => $userIds->random(),
                    'created_at'    => now(),
                    'updated_at'    => now()
                ]
            );
        }
    }
}
