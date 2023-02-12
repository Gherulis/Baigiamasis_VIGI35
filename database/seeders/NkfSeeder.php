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
        $nkf->description = 'Trinkelių keitimas';
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
        $nkf->description = 'Mėnesinis kaupimo indelis';
        $nkf->type = 'Įplaukos';
        $nkf->amountPayed = '500';
        $nkf->save();

        $nkf = new nkf();
        $nkf->house_id = '1';
        $nkf->description = 'Rūsio durų keitimas';
        $nkf->type = 'Planas';
        $nkf->amountPayed = '350';
        $nkf->save();

        $nkf = new nkf();
        $nkf->house_id = '1';
        $nkf->description = 'Kanalizacijos valymas';
        $nkf->type = 'Išlaidos';
        $nkf->amountPayed = '610';
        $nkf->save();

        $nkf = new nkf();
        $nkf->house_id = '1';
        $nkf->description = 'Indelis';
        $nkf->type = 'Įplaukos';
        $nkf->amountPayed = '2500';
        $nkf->save();

        $nkf = new nkf();
        $nkf->house_id = '1';
        $nkf->description = 'Fasado remontas';
        $nkf->type = 'Planas';
        $nkf->amountPayed = '4500';
        $nkf->save();

        $nkf = new nkf();
        $nkf->house_id = '1';
        $nkf->description = 'Aikštelės juostų perdažymas';
        $nkf->type = 'Planas';
        $nkf->amountPayed = '700';
        $nkf->save();

        $nkf = new nkf();
        $nkf->house_id = '2';
        $nkf->description = 'Laiptynės perdažymas';
        $nkf->type = 'Išlaidos';
        $nkf->amountPayed = '1300';
        $nkf->save();

        $nkf = new nkf();
        $nkf->house_id = '2';
        $nkf->description = 'Lauko durų perdažymas';
        $nkf->type = 'Išlaidos';
        $nkf->amountPayed = '200';
        $nkf->save();

        $nkf = new nkf();
        $nkf->house_id = '2';
        $nkf->description = 'Mėnesinis kaupimo indelis';
        $nkf->type = 'Įplaukos';
        $nkf->amountPayed = '700';
        $nkf->save();

        $nkf = new nkf();
        $nkf->house_id = '2';
        $nkf->description = 'Pašto dėžučiu keitimas';
        $nkf->type = 'Planas';
        $nkf->amountPayed = '1150';
        $nkf->save();

        $nkf = new nkf();
        $nkf->house_id = '2';
        $nkf->description = 'Rūsio apšiltinimas';
        $nkf->type = 'Išlaidos';
        $nkf->amountPayed = '1610';
        $nkf->save();

        $nkf = new nkf();
        $nkf->house_id = '2';
        $nkf->description = 'Indelis';
        $nkf->type = 'Įplaukos';
        $nkf->amountPayed = '4000';
        $nkf->save();

        $nkf = new nkf();
        $nkf->house_id = '2';
        $nkf->description = 'Bendros laisvalaikio erdvės įrengimas';
        $nkf->type = 'Planas';
        $nkf->amountPayed = '2500';
        $nkf->save();

        $nkf = new nkf();
        $nkf->house_id = '2';
        $nkf->description = 'Vaikų žaidimo aikštelės remontas';
        $nkf->type = 'Planas';
        $nkf->amountPayed = '700';
        $nkf->save();

    }
}
