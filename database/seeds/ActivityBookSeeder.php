<?php

use Illuminate\Database\Seeder;

class ActivityBookSeeder extends Seeder
{
    //Hello
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\ActivityBook::class, 20)->create();
    }
}
