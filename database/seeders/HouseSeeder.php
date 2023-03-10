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
        $house->admin_id = '2';
        $house->save();

        $house = new House();

        $house->address = 'Liepkalnio';
        $house->house_nr = '14';
        $house->city = 'Vilnius';
        $house->house_size = '2676.5';
        $house->admin_id = '2';
        $house->save();

    }
}
