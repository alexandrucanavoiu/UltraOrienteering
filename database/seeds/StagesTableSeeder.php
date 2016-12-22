<?php

use Illuminate\Database\Seeder;

class StagesTableSeeder extends Seeder
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
                'name' => 'Ziua 1',
                'start_time' => \Carbon\Carbon::parse('12/28/2016 2:00pm'),
                'duration' => '00:03:00',
            ],
            [
                'name' => 'Ziua 2',
                'start_time' => \Carbon\Carbon::parse('12/31/2016 7:00pm'),
                'duration' => '00:03:00',
            ],
            [
                'name' => 'Ziua 3',
                'start_time' => \Carbon\Carbon::parse('12/13/2016 4:00pm'),
                'duration' => '00:03:00',
            ],
            [
                'name' => 'Ziua 4x',
                'start_time' => \Carbon\Carbon::parse('12/13/2016 10:00am'),
                'duration' => '00:05:00',
            ],
        ];

        $now = date('Y-m-d H:i:s');

        foreach ($records as $key => $record) {
            $records[$key]['created_at'] = $now;
            $records[$key]['updated_at'] = $now;
        }

        DB::table('stages')->insert($records);
    }
}
