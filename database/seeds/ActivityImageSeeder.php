<?php

use Illuminate\Database\Seeder;

class ActivityImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory (\App\ActivityImage::class,50)->create();
    }
}
