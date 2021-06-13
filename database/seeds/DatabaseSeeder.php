<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserTypeSeeder::class,
            UserSeeder::class,
            PlanSeeder::class,
            SubscriptionSeeder::class,
            AgeGroupSeeder::class,
            BookSeeder::class,
            PageSeeder::class,
            VideoSeeder::class,
            BookUserFavouriteSeeder::class,
            BookUserReadSeeder::class,
            AuthorSeeder::class,
            AuthorBookSeeder::class,
            ActivitySeeder::class,
            ActivityImageSeeder::class,
            ActivityBookSeeder::class,
            ActivityBookUserSeeder::class
        ]);
    }
}
