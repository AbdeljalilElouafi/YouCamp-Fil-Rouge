<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regions = [
            ['id' => 1, 'region' => 'Tanger-Tétouan-Al Hoceïma'],
            ['id' => 2, 'region' => 'l\'Oriental'],
            ['id' => 3, 'region' => 'Fès-Meknès'],
            ['id' => 4, 'region' => 'Rabat-Salé-Kénitra'],
            ['id' => 5, 'region' => 'Béni Mellal-Khénifra'],
            ['id' => 6, 'region' => 'Casablanca-Settat'],
            ['id' => 7, 'region' => 'Marrakech-Safi'],
            ['id' => 8, 'region' => 'Drâa-Tafilalet'],
            ['id' => 9, 'region' => 'Souss-Massa'],
            ['id' => 10, 'region' => 'Guelmim-Oued Noun'],
            ['id' => 11, 'region' => 'Laâyoune-Sakia El Hamra'],
            ['id' => 12, 'region' => 'Dakhla-Oued Ed Dahab'],
        ];

        DB::table('regions')->insert($regions);
    }
}
