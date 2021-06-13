<?php

use Illuminate\Database\Seeder;

class ActivityBookUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i<20; $i++)
        {
            $activityBookIds    = DB::table('activity_books')->pluck('id');
            $userIds            = DB::table('users')->pluck('id');

            DB::table('activity_book_user')->insert(
                [
                    'activity_book_id'  => $activityBookIds->random(),
                    'user_id'           => $userIds->random(),
                    'created_at'        => now(),
                    'updated_at'        => now()
                ]
            );
        }
    }
}
