<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\flat;
class FlatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Flat::factory()->count(30)->create();
        $flat = new Flat();
        $flat->house_id = '1';
        $flat->flat_nr = '1';
        $flat->flat_size = '73.59';
        $flat->gyv_mok_suma = '100';
        $flat->invitation = 'A001';
        $flat->save();

        $flat = new Flat();
        $flat->house_id = '1';
        $flat->flat_nr = '2';
        $flat->flat_size = '74.21';
        $flat->gyv_mok_suma = '100';
        $flat->invitation = 'A002';
        $flat->save();

        $flat = new Flat();
        $flat->house_id = '1';
        $flat->flat_nr = '3';
        $flat->flat_size = '87.05';
        $flat->gyv_mok_suma = '100';
        $flat->invitation = 'A003';
        $flat->save();

        $flat = new Flat();
        $flat->house_id = '1';
        $flat->flat_nr = '4';
        $flat->flat_size = '73.59';
        $flat->gyv_mok_suma = '100';
        $flat->invitation = 'A004';
        $flat->save();

        $flat = new Flat();
        $flat->house_id = '1';
        $flat->flat_nr = '5';
        $flat->flat_size = '74.21';
        $flat->gyv_mok_suma = '100';
        $flat->invitation = 'A005';
        $flat->save();

        // $flat = new Flat();
        // $flat->house_id = '1';
        // $flat->flat_nr = '6';
        // $flat->flat_size = '87.05';
        // $flat->gyv_mok_suma = '100';
        // $flat->save();

        // $flat = new Flat();
        // $flat->house_id = '1';
        // $flat->flat_nr = '7';
        // $flat->flat_size = '73.59';
        // $flat->gyv_mok_suma = '100';
        // $flat->save();

        // $flat = new Flat();
        // $flat->house_id = '1';
        // $flat->flat_nr = '8';
        // $flat->flat_size = '74.21';
        // $flat->gyv_mok_suma = '100';
        // $flat->save();

        // $flat = new Flat();
        // $flat->house_id = '1';
        // $flat->flat_nr = '9';
        // $flat->flat_size = '94.05';
        // $flat->gyv_mok_suma = '100';
        // $flat->save();

        // $flat = new Flat();
        // $flat->house_id = '1';
        // $flat->flat_nr = '10';
        // $flat->flat_size = '73.59';
        // $flat->gyv_mok_suma = '100';
        // $flat->save();

        // $flat = new Flat();
        // $flat->house_id = '1';
        // $flat->flat_nr = '11';
        // $flat->flat_size = '74.21';
        // $flat->gyv_mok_suma = '100';
        // $flat->save();

        // $flat = new Flat();
        // $flat->house_id = '1';
        // $flat->flat_nr = '12';
        // $flat->flat_size = '87.05';
        // $flat->gyv_mok_suma = '100';
        // $flat->save();

        // $flat = new Flat();
        // $flat->house_id = '1';
        // $flat->flat_nr = '13';
        // $flat->flat_size = '73.59';
        // $flat->gyv_mok_suma = '100';
        // $flat->save();

        // $flat = new Flat();
        // $flat->house_id = '1';
        // $flat->flat_nr = '14';
        // $flat->flat_size = '74.21';
        // $flat->gyv_mok_suma = '100';
        // $flat->save();

        // $flat = new Flat();
        // $flat->house_id = '1';
        // $flat->flat_nr = '15';
        // $flat->flat_size = '87.05';
        // $flat->gyv_mok_suma = '100';
        // $flat->save();

        // $flat = new Flat();
        // $flat->house_id = '1';
        // $flat->flat_nr = '16';
        // $flat->flat_size = '73.59';
        // $flat->gyv_mok_suma = '100';
        // $flat->save();

        // $flat = new Flat();
        // $flat->house_id = '1';
        // $flat->flat_nr = '17';
        // $flat->flat_size = '87.05';
        // $flat->gyv_mok_suma = '100';
        // $flat->save();

        // $flat = new Flat();
        // $flat->house_id = '1';
        // $flat->flat_nr = '18';
        // $flat->flat_size = '74.21';
        // $flat->gyv_mok_suma = '100';
        // $flat->save();

        // $flat = new Flat();
        // $flat->house_id = '1';
        // $flat->flat_nr = '19';
        // $flat->flat_size = '73.59';
        // $flat->gyv_mok_suma = '50';
        // $flat->save();

        // $flat = new Flat();
        // $flat->house_id = '1';
        // $flat->flat_nr = '20';
        // $flat->flat_size = '87.05';
        // $flat->gyv_mok_suma = '100';
        // $flat->save();

        // $flat = new Flat();
        // $flat->house_id = '1';
        // $flat->flat_nr = '21';
        // $flat->flat_size = '78.21';
        // $flat->gyv_mok_suma = '100';
        // $flat->save();

        // $flat = new Flat();
        // $flat->house_id = '1';
        // $flat->flat_nr = '22';
        // $flat->flat_size = '73.59';
        // $flat->gyv_mok_suma = '100';
        // $flat->save();

        // $flat = new Flat();
        // $flat->house_id = '1';
        // $flat->flat_nr = '23';
        // $flat->flat_size = '87.05';
        // $flat->gyv_mok_suma = '100';
        // $flat->save();

        // $flat = new Flat();
        // $flat->house_id = '1';
        // $flat->flat_nr = '24';
        // $flat->flat_size = '77.21';
        // $flat->gyv_mok_suma = '100';
        // $flat->save();

        // $flat = new Flat();
        // $flat->house_id = '1';
        // $flat->flat_nr = '25';
        // $flat->flat_size = '73.59';
        // $flat->gyv_mok_suma = '100';
        // $flat->save();

        // $flat = new Flat();
        // $flat->house_id = '1';
        // $flat->flat_nr = '26';
        // $flat->flat_size = '87.05';
        // $flat->gyv_mok_suma = '50';
        // $flat->save();

        // $flat = new Flat();
        // $flat->house_id = '1';
        // $flat->flat_nr = '27';
        // $flat->flat_size = '74.21';
        // $flat->gyv_mok_suma = '100';
        // $flat->save();

        // $flat = new Flat();
        // $flat->house_id = '1';
        // $flat->flat_nr = '28';
        // $flat->flat_size = '73.59';
        // $flat->gyv_mok_suma = '100';
        // $flat->save();

        // $flat = new Flat();
        // $flat->house_id = '1';
        // $flat->flat_nr = '29';
        // $flat->flat_size = '87.05';
        // $flat->gyv_mok_suma = '100';
        // $flat->save();

        // $flat = new Flat();
        // $flat->house_id = '1';
        // $flat->flat_nr = '30';
        // $flat->flat_size = '74.21';
        // $flat->gyv_mok_suma = '100';
        // $flat->save();

        $flat = new Flat();
        $flat->house_id = '2';
        $flat->flat_nr = '1';
        $flat->flat_size = '73.59';
        $flat->gyv_mok_suma = '100';
        $flat->invitation = 'B001';
        $flat->save();


    }
}
