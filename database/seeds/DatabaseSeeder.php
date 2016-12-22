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

        $this->call(ClubDistrictsTableSeeder::class);
        if (App::environment('local')) {
            // Runs only if we are in test environment
            $this->call(ClubsTableSeeder::class);
            $this->call(UuidCardsTableSeeder::class);
            $this->call(ParticipantsTableSeeder::class);
            $this->call(StagesTableSeeder::class);
            $this->call(RoutesTableSeeder::class);
            $this->call(CategoriesTableSeeder::class);
        }
    }
}
