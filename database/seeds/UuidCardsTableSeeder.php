<?php

use Illuminate\Database\Seeder;

class UuidCardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [
            ['uuidcard' => 'C23D5193',],
            ['uuidcard' => 'C2385053',],
            ['uuidcard' => 'C2366213',],
            ['uuidcard' => 'C238E403',],
            ['uuidcard' => 'C23FC5B3',],
            ['uuidcard' => 'C241BF03',],
            ['uuidcard' => 'C241EF83',],
            ['uuidcard' => 'C23F5A93',],
            ['uuidcard' => 'C24028E3',],
            ['uuidcard' => 'C23EB703',],
            ['uuidcard' => 'AB89C2A9',],
            ['uuidcard' => 'C238EC63',],
            ['uuidcard' => 'C23A2893',],
        ];

        $now = date('Y-m-d H:i:s');

        foreach ($records as $key => $record) {
            $records[$key]['created_at'] = $now;
            $records[$key]['updated_at'] = $now;
        }

        DB::table('uuid_cards')->insert($records);
    }
}
