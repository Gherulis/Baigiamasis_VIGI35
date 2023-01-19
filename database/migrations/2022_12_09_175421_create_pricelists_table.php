<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pricelists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('house_id');
            $table->foreign('house_id')->references('id')->on('houses');
            $table->integer('saltas_vanduo');
            $table->integer('karstas_vanduo');
            $table->integer('sildymas');
            $table->integer('silumos_mazg_prieziura');
            $table->integer('gyvatukas');
            $table->integer('salto_vandens_abon');
            $table->integer('elektra_bendra');
            $table->integer('ukio_islaid');
            $table->integer('nkf');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pricelists');
    }
};
