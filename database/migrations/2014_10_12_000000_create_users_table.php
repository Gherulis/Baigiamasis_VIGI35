<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     //matai kame esme, tau turejo atsirast lentele kontaktais. Bet nematau kad atsiradus butu
     //pamgeink migruoti tuscioje duomenubaze . Nes dabar su migracija neturetu buti jokiu problemu ok dekui o kodel taip ivyko kad reikjo kazka darasyti
         *
         * //del MySQL versijos. MySql 5.7 versija turi toki bug kad neleidzia irasyti pakankamai ilgo string laraveliui kuriant duomenu baze. tai
         * //visad reikia tada pasikoreguoti app/Providers/AppServiceProvider ir pridet tas eilutes kurias pridejau
         *
         * Supratau, dekui
         * o dar klausimas ar galima taip header ir footer kelt kaip pasidariau
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->unsignedBigInteger('flat_id')->default('1')->nullable();
            $table->string('color')->default('Standartinė');
            $table->foreign('flat_id')->references('id')->on('flats');
            $table->integer('phone')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
