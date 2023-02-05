<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Nkf;


class NkfSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nkf = new nkf();
        $nkf->house_id = '1';
        $nkf->description = 'Trinkeliu keitimas';
        $nkf->type = 'Išlaidos';
        $nkf->amountPayed = '800';
        $nkf->save();

        $nkf = new nkf();
        $nkf->house_id = '1';
        $nkf->description = 'Lauko spynos keitimas';
        $nkf->type = 'Išlaidos';
        $nkf->amountPayed = '200';
        $nkf->save();

        $nkf = new nkf();
        $nkf->house_id = '1';
        $nkf->description = 'Menesinis kaupimo indelis';
        $nkf->type = 'Iplaukos';
        $nkf->amountPayed = '300';
        $nkf->save();

        $nkf = new nkf();
        $nkf->house_id = '1';
        $nkf->description = 'Rusio duru keitimas';
        $nkf->type = 'Planas';
        $nkf->amountPayed = '350';
        $nkf->save();

        $nkf = new nkf();
        $nkf->house_id = '1';
        $nkf->description = 'Kanalizacijos valymas';
        $nkf->type = 'Išlaidos';
        $nkf->amountPayed = '610';
        $nkf->save();
    }
}
