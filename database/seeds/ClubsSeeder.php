<?php

use Illuminate\Database\Seeder;

class ClubsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [
            [
                'club_district_id' => 21,
                'name' => 'Asociatia Drumetii Montanex',
                'city' => 'Targu Jiu',
            ],
            [
                'club_district_id' => 19,
                'name' => 'Jnepenissssdgfgvvfoo',
                'city' => 'Bucuresti',
            ],
            [
                'club_district_id' => 10,
                'name' => 'Mecanturistlfdff',
                'city' => 'Galati',
            ],
            [
                'club_district_id' => 2,
                'name' => 'Marinia Scoala X',
                'city' => 'Targu Jiu',
            ],
        ];

        $now = date('Y-m-d H:i:s');

        foreach ($records as $key => $record) {
            $records[$key]['created_at'] = $now;
            $records[$key]['updated_at'] = $now;
        }

        DB::table('clubs')->insert($records);
    }
}
