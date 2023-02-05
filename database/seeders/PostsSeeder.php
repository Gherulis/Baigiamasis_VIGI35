<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\posts;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = new posts();
        $posts->postName = 'APVA priima paraiškas seniems daugiabučiams atnaujinti';
        $posts->postBody = 'Aplinkos projektų valdymo agentūra (APVA) šiandien paskelbė naują kvietimą teikti paraiškas seniems daugiabučiams atnaujinti. Šiam kvietimui skirta 100 mln. eurų suma statybos rangos darbų pastato energinį efektyvumą didinančioms ir kitoms pastato atnaujinimo priemonėms. Kvietimo pabaiga – 2023 m. balandžio 14 d.';
        $posts->postLink = 'https://www.statybunaujienos.lt/naujiena/APVA-priima-paraiskas-seniems-daugiabuciams-atnaujinti/19694';
        $posts->postImage = '1.jpg';
        $posts->uploadedBy = '1';
        $posts->save();

        $posts = new posts();
        $posts->postName = 'Renovuojant daugiabučius bus galima gauti kreditą ir elektromobilių įkrovimo vietoms įrengti';
        $posts->postBody = 'Į valstybės remiamų daugiabučio namo atnaujinimo (modernizavimo) priemonių sąrašą bus įtrauktas elektromobilių įkrovimo infrastruktūros įrengimas daugiabučiam namui priklausančiose automobilių saugyklose. Tam pritarė Vyriausybė.';
        $posts->postLink = 'https://www.statybunaujienos.lt/naujiena/APVA-priima-paraiskas-seniems-daugiabuciams-atnaujinti/19694';
        $posts->postImage = '2.jpg';
        $posts->uploadedBy = '1';
        $posts->save();

        $posts = new posts();
        $posts->postName = 'Centro kvartalo daugiabučių namų renovacija';
        $posts->postBody = 'Didžiajai daliai šalies gyventojų svarbi ne tik gyvenamo būsto kokybė, bet ir jų namus supanti aplinka. Būtent kompleksinis teritorijų atnaujinimas suteikia galimybę ne tik atnaujinti patį daugiabutį, bet ir sutvarkyti aplink namą esančias žaliąsias teritorijas, automobilių stovėjimo aikšteles, vaikų žaidimo zonas.
        Tauragės rajono savivaldybės tarybos patvirtintos trys daugiabučių gyvenamųjų namų kvartalo energinio efektyvumo didinimo programos: Centro, Žalgirių mikrorajonų ir Tauragės dvaro k. (Taurų k.).';
        $posts->postLink = 'https://www.tauragesst.lt/naujienos/centro-kvartalo-daugiabuciu-namu-renovacija/';
        $posts->postImage = '3.jpg';
        $posts->uploadedBy = '1';
        $posts->save();

        $posts = new posts();
        $posts->postName = 'Palanga';
        $posts->postBody = 'Palanga (žem. Palonga) – Lietuvos miestas prie Baltijos jūros, Žemaitijoje, 25 km į šiaurę nuo Klaipėdos, Palangos miesto savivaldybė ir dvidešimtas pagal gyventojų skaičių Lietuvos miestas, klimatinis ir balneologinis kurortas.';
        $posts->postImage = '1.jpg';
        $posts->uploadedBy = '1';
        $posts->save();

        $posts = new Posts();
        $posts->postName = 'APVA priima paraiškas seniems daugiabučiams atnaujinti';
        $posts->postBody = 'Aplinkos projektų valdymo agentūra (APVA) šiandien paskelbė naują kvietimą teikti paraiškas seniems daugiabučiams atnaujinti. Šiam kvietimui skirta 100 mln. eurų suma statybos rangos darbų pastato energinį efektyvumą didinančioms ir kitoms pastato atnaujinimo priemonėms. Kvietimo pabaiga – 2023 m. balandžio 14 d.';
        $posts->postLink = 'www.delfi.lt';
        $posts->postImage = '4.jpg';
        $posts->uploadedBy = '1';
        $posts->save();

        $posts = new posts();
        $posts->postName = 'Sėkmės receptą radęs Lietuvos kurortas sustoti neketina: papasakojo, kokie planai laukia Palangos';
        $posts->postBody = 'Per pastaruosius kelerius metus Lietuvos pajūris tapo tikru fenomenu: būstai čia buvo tiesiog graibstomi bet kokiomis kainomis, o NT vystytojai, pamatę neįtikėtiną šio regiono populiarumą, ėmė ieškoti galimybių jame ką nors pastatyti. Regiono poilsio centru išliko Palanga ir jos apylinkės, todėl daug naujų projektų pradėta būtent čia.';
        $posts->postLink = 'https://www.statybunaujienos.lt/naujiena/APVA-priima-paraiskas-seniems-daugiabuciams-atnaujinti/19694';
        $posts->postImage = '5.jpg';
        $posts->uploadedBy = '1';
        $posts->save();

    }
}
