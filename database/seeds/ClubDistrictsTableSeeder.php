<?php

use Illuminate\Database\Seeder;

class ClubDistrictsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [
            ['name' => 'Alba',],
            ['name' => 'Arad',],
            ['name' => 'Arges',],
            ['name' => 'Bacau',],
            ['name' => 'Bihor',],
            ['name' => 'Bistrita Nasaud',],
            ['name' => 'Botosani',],
            ['name' => 'Braila',],
            ['name' => 'Brasov',],
            ['name' => 'Bucuresti',],
            ['name' => 'Buzau',],
            ['name' => 'Calarasi',],
            ['name' => 'Caras Severin',],
            ['name' => 'Cluj',],
            ['name' => 'Constanta',],
            ['name' => 'Covasna',],
            ['name' => 'Dambovita',],
            ['name' => 'Dolj',],
            ['name' => 'Galati',],
            ['name' => 'Giurgiu',],
            ['name' => 'Gorj',],
            ['name' => 'Harghita',],
            ['name' => 'Hunedoara',],
            ['name' => 'Ialomita',],
            ['name' => 'Iasi',],
            ['name' => 'Ilfov',],
            ['name' => 'Maramures',],
            ['name' => 'Mehedinti',],
            ['name' => 'Mures',],
            ['name' => 'Neamt',],
            ['name' => 'Olt',],
            ['name' => 'Prahova',],
            ['name' => 'Salaj',],
            ['name' => 'Satu Mare',],
            ['name' => 'Sibiu',],
            ['name' => 'Suceava',],
            ['name' => 'Teleorman',],
            ['name' => 'Timis',],
            ['name' => 'Tulcea',],
            ['name' => 'Valcea',],
            ['name' => 'Vaslui',],
            ['name' => 'Vrancea',],
        ];

        $now = date('Y-m-d H:i:s');

        foreach ($records as $key => $record) {
            $records[$key]['created_at'] = $now;
            $records[$key]['updated_at'] = $now;
        }

        DB::table('club_districts')->insert($records);
    }
}
