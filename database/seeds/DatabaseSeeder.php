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

        Eloquent::unguard();

        //disable foreign key check for this connection before running seeders
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // $this->call(UsersTableSeeder::class);

        $this->call(ClubDistrictsTableSeeder::class);
        if (App::environment('local')) {
            // Runs only if we are in development environment
            $this->call(ClubsTableSeeder::class);
            $this->call(UuidCardsTableSeeder::class);
            $this->call(ParticipantsTableSeeder::class);
            $this->call(StagesTableSeeder::class);
            $this->call(RoutesTableSeeder::class);
            $this->call(CategoriesTableSeeder::class);
            $this->call(ParticipantManagersTableSeeder::class);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
