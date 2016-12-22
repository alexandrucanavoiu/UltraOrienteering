<?php

use Illuminate\Database\Seeder;

class RoutesTableSeeder extends Seeder
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
                'name' => 'Short',
                'length_in_km' => 2,
                'post_amount' => 6,
                'post_1' => 'P1',
                'post_2' => 'P2',
                'post_3' => 'P3',
                'post_4' => 'P4',
                'post_5' => 'P5',
                'post_6' => 'P6',
                'post_7' => '',
                'post_8' => '',
                'post_9' => '',
                'post_10' => '',
                'post_11' => '',
                'post_12' => '',
            ],
            [
                'name' => 'Second route',
                'length_in_km' => 4,
                'post_amount' => 6,
                'post_1' => 'P1',
                'post_2' => 'P2',
                'post_3' => 'P3',
                'post_4' => 'P4',
                'post_5' => 'P5',
                'post_6' => 'P6',
                'post_7' => '',
                'post_8' => '',
                'post_9' => '',
                'post_10' => '',
                'post_11' => '',
                'post_12' => '',
            ],
        ];

        $now = date('Y-m-d H:i:s');

        foreach ($records as $key => $record) {
            $records[$key]['created_at'] = $now;
            $records[$key]['updated_at'] = $now;
        }

        DB::table('routes')->insert($records);
    }
}
