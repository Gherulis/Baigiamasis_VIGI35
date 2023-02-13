<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DeclareWater;

class DeclareWaterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $declareWater = new DeclareWater();
        $declareWater->flat_id = '1';
        $declareWater->kitchen_cold ='521';
        $declareWater->kitchen_hot = '321';
        $declareWater->bath_hot = '244';
        $declareWater->bath_cold ='235';
        $declareWater->kitchen_cold_usage = '19';
        $declareWater->kitchen_hot_usage = '12';
        $declareWater->bath_cold_usage ='31';
        $declareWater->bath_hot_usage ='98';
        $declareWater->declaredBy = "Laura";
        $declareWater->created_at = '2022-12-11';
        $declareWater->save();

        $declareWater = new DeclareWater();
        $declareWater->flat_id = '2';
        $declareWater->kitchen_cold ='434';
        $declareWater->kitchen_hot = '221';
        $declareWater->bath_cold ='244';
        $declareWater->bath_hot = '238';
        $declareWater->kitchen_cold_usage = '9';
        $declareWater->kitchen_hot_usage = '3';
        $declareWater->bath_cold_usage = '8';
        $declareWater->bath_hot_usage =  '7';
        $declareWater->declaredBy = "Simonytė";
        $declareWater->created_at = '2022-12-11';
        $declareWater->save();

        $declareWater = new DeclareWater();
        $declareWater->flat_id = '3';
        $declareWater->kitchen_cold ='415';
        $declareWater->kitchen_hot = '212';
        $declareWater->bath_cold ='246';
        $declareWater->bath_hot = '233';
        $declareWater->kitchen_cold_usage = '9';
        $declareWater->kitchen_hot_usage = '6';
        $declareWater->bath_cold_usage = '3';
        $declareWater->bath_hot_usage =  '2';
        $declareWater->declaredBy = "Laurynas";
        $declareWater->created_at = '2022-12-11';
        $declareWater->save();

        $declareWater = new DeclareWater();
        $declareWater->flat_id = '4';
        $declareWater->kitchen_cold ='426';
        $declareWater->kitchen_hot = '214';
        $declareWater->bath_cold ='256';
        $declareWater->bath_hot = '244';
        $declareWater->kitchen_cold_usage = '7';
        $declareWater->kitchen_hot_usage = '2';
        $declareWater->bath_cold_usage = '14';
        $declareWater->bath_hot_usage =  '1';
        $declareWater->declaredBy = "Olia";
        $declareWater->created_at = '2022-12-11';
        $declareWater->save();

        $declareWater = new DeclareWater();
        $declareWater->flat_id = '5';
        $declareWater->kitchen_cold ='436';
        $declareWater->kitchen_hot = '214';
        $declareWater->bath_cold ='274';
        $declareWater->bath_hot = '216';
        $declareWater->kitchen_cold_usage = '3';
        $declareWater->kitchen_hot_usage = '6';
        $declareWater->bath_cold_usage = '10';
        $declareWater->bath_hot_usage =  '4';
        $declareWater->declaredBy = "Petras";
        $declareWater->created_at = '2022-12-11';
        $declareWater->save();

        $declareWater = new DeclareWater();
        $declareWater->flat_id = '6';
        $declareWater->kitchen_cold ='476';
        $declareWater->kitchen_hot = '254';
        $declareWater->bath_cold ='236';
        $declareWater->bath_hot = '276';
        $declareWater->kitchen_cold_usage = '12';
        $declareWater->kitchen_hot_usage = '1';
        $declareWater->bath_cold_usage = '10';
        $declareWater->bath_hot_usage =  '3';
        $declareWater->declaredBy = "Jūratė";
        $declareWater->created_at = '2022-12-11';
        $declareWater->save();


        $declareWater = new DeclareWater();
        $declareWater->flat_id = '1';
        $declareWater->kitchen_cold ='456';
        $declareWater->kitchen_hot = '234';
        $declareWater->bath_cold ='276';
        $declareWater->bath_hot = '255';
        $declareWater->kitchen_cold_usage = '10';
        $declareWater->kitchen_hot_usage = '4';
        $declareWater->bath_cold_usage = '13';
        $declareWater->bath_hot_usage =  '7';
        $declareWater->declaredBy = "Simas";
        $declareWater->created_at = '2023-01-11';
        $declareWater->save();

        $declareWater = new DeclareWater();
        $declareWater->flat_id = '2';
        $declareWater->kitchen_cold ='456';
        $declareWater->kitchen_hot = '234';
        $declareWater->bath_cold ='276';
        $declareWater->bath_hot = '255';
        $declareWater->kitchen_cold_usage = '10';
        $declareWater->kitchen_hot_usage = '4';
        $declareWater->bath_cold_usage = '13';
        $declareWater->bath_hot_usage =  '7';
        $declareWater->declaredBy = "Simas";
        $declareWater->created_at = '2023-01-11';
        $declareWater->save();

        $declareWater = new DeclareWater();
        $declareWater->flat_id = '3';
        $declareWater->kitchen_cold ='456';
        $declareWater->kitchen_hot = '234';
        $declareWater->bath_cold ='276';
        $declareWater->bath_hot = '255';
        $declareWater->kitchen_cold_usage = '10';
        $declareWater->kitchen_hot_usage = '4';
        $declareWater->bath_cold_usage = '13';
        $declareWater->bath_hot_usage =  '7';
        $declareWater->declaredBy = "Orijus";
        $declareWater->created_at = '2023-01-11';
        $declareWater->save();

        $declareWater = new DeclareWater();
        $declareWater->flat_id = '4';
        $declareWater->kitchen_cold ='456';
        $declareWater->kitchen_hot = '234';
        $declareWater->bath_cold ='276';
        $declareWater->bath_hot = '255';
        $declareWater->kitchen_cold_usage = '10';
        $declareWater->kitchen_hot_usage = '4';
        $declareWater->bath_cold_usage = '13';
        $declareWater->bath_hot_usage =  '7';
        $declareWater->declaredBy = "Timas";
        $declareWater->created_at = '2023-01-11';
        $declareWater->save();

        $declareWater = new DeclareWater();
        $declareWater->flat_id = '5';
        $declareWater->kitchen_cold ='456';
        $declareWater->kitchen_hot = '234';
        $declareWater->bath_cold ='276';
        $declareWater->bath_hot = '255';
        $declareWater->kitchen_cold_usage = '10';
        $declareWater->kitchen_hot_usage = '4';
        $declareWater->bath_cold_usage = '13';
        $declareWater->bath_hot_usage =  '7';
        $declareWater->declaredBy = "Simas";
        $declareWater->created_at = '2023-01-11';
        $declareWater->save();

        $declareWater = new DeclareWater();
        $declareWater->flat_id = '6';
        $declareWater->kitchen_cold ='456';
        $declareWater->kitchen_hot = '234';
        $declareWater->bath_cold ='276';
        $declareWater->bath_hot = '255';
        $declareWater->kitchen_cold_usage = '10';
        $declareWater->kitchen_hot_usage = '4';
        $declareWater->bath_cold_usage = '13';
        $declareWater->bath_hot_usage =  '7';
        $declareWater->declaredBy = "Artas";
        $declareWater->created_at = '2023-02-11';
        $declareWater->save();

    }
}
