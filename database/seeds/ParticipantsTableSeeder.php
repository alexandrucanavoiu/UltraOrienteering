<?php

use Illuminate\Database\Seeder;

class ParticipantsTableSeeder extends Seeder
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
                'uuid_card_id' => 5,
                'club_id' => 1,
                'name' => 'Alexandru Canavoiu',
            ],
            [
                'uuid_card_id' => 9,
                'club_id' => 4,
                'name' => 'Maria Grigorex',
            ],
            [
                'uuid_card_id' => 1,
                'club_id' => 1,
                'name' => 'Random Dude',
            ],
            [
                'uuid_card_id' => 12,
                'club_id' => 2,
                'name' => 'Cool Dude',
            ],
        ];

        $now = date('Y-m-d H:i:s');

        foreach ($records as $key => $record) {
            $records[$key]['created_at'] = $now;
            $records[$key]['updated_at'] = $now;
        }

        DB::table('participants')->insert($records);
    }
}
