<?php

use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['user_type'=>'Admin'],
            ['user_type'=>'User'],
        ];

        DB::table('user_types')->insert($data);
    }
}
