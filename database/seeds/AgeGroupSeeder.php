<?php

use Illuminate\Database\Seeder;

class AgeGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['age_group'=>'0-3'],
            ['age_group'=>'3-8'],
            ['age_group'=>'5-9'],
            ['age_group'=>'7-10'],
            ['age_group'=>'8-12'],
            ['age_group'=>'12+'],
            ['age_group'=>'14+'],
        ];

        DB::table('age_groups')->insert($data);
    }
}
