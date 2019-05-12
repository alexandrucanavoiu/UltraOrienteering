<?php

use Illuminate\Database\Seeder;
use App\Models\ComponentStatus;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $now = date('Y-m-d H:i:s');

        DB::table('settings')->insert([
            'id' => 1,
            'organizer_name' => "Ultra Orienteering",
            'competition_type' => 1,
            'created_at' => $now,
            'updated_at' => $now
        ]);

    }
}
