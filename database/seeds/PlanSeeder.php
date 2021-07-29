<?php

use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data =
            ['name'=>'Free',
                'price'=>'0',
                'duration'=>null,
                'access_level'=>'0',
                'created_at'=>now(),
                'updated_at'=>now(),
            ];

        DB::table('plans')->insert($data);

        factory (\App\Plan::class,10)->create();
    }
}
