<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\house;

class HouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $house = new House();

        $house->address = 'Druskininku';
        $house->house_nr = '11';
        $house->city = 'Palanga';
        $house->house_size = '2362.5';
        $house->save();

    }
}
