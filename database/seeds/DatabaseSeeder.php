<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        $this->call(ClubDistrictsSeeder::class);
        if (App::environment('local')) {
            // Runs only if we are in test environment
        }
    }
}
