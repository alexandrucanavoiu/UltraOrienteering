<?php

use Illuminate\Database\Seeder;

class ClubDistrictsSeeder extends Seeder
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

        DB::table('club_districts')->insert($records);
    }
}
