<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data =
            [   'user_type_id'          => 1,
                'first_name'            => 'Dev',
                'last_name'             => 'Team',
                'user_name'             => 'devteam',
                'email'                 => 'dev@team.pt',
                'email_verified_at'     => now(),
                'password'              => Hash::make('123+qwe'),
                'user_photo_url'        => 'no_photo.jpg',
                'remember_token'        => Str::random(10),
                'created_at'=>now(),
                'updated_at'=>now(),
            ];
        DB::table('users')->insert($data);

        factory (\App\User::class,50)->create();
    }
}
