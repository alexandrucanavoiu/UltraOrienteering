<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
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
                'route_id' => 2,
                'name' => 'F18x',
            ],
            [
                'route_id' => 2,
                'name' => 'M18',
            ],
            [
                'route_id' => 1,
                'name' => 'Open',
            ],
            [
                'route_id' => 1,
                'name' => 'Closed',
            ],
            [
                'route_id' => 2,
                'name' => 'Specialty',
            ],
        ];

        $now = date('Y-m-d H:i:s');

        foreach ($records as $key => $record) {
            $records[$key]['created_at'] = $now;
            $records[$key]['updated_at'] = $now;
        }

        DB::table('categories')->insert($records);
    }
}
