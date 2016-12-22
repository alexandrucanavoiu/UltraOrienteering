<?php

use Illuminate\Database\Seeder;

class ParticipantManagersTableSeeder extends Seeder
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
                'participant_id' => 3,
                'category_id' => 5,
                'uuid_card_id' => 3,
                'stage_id' => 1,
                'post_start' => '00:00:00',
                'post_1' => '00:00:00',
                'post_2' => '00:00:00',
                'post_3' => '00:00:00',
                'post_4' => '00:00:00',
                'post_5' => '00:00:00',
                'post_6' => '00:00:00',
                'post_7' => null,
                'post_8' => null,
                'post_9' => null,
                'post_10' => null,
                'post_11' => null,
                'post_12' => null,
                'post_finish' => '00:00:00',
            ],
        ];

        $now = date('Y-m-d H:i:s');

        foreach ($records as $key => $record) {
            $records[$key]['created_at'] = $now;
            $records[$key]['updated_at'] = $now;
        }

        DB::table('participant_managers')->insert($records);
    }
}
