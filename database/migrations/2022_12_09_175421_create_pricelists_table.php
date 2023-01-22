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
            $table->decimal('saltas_vanduo');
            $table->decimal('karstas_vanduo');
            $table->decimal('sildymas');
            $table->decimal('silumos_mazg_prieziura');
            $table->decimal('gyvatukas');
            $table->decimal('salto_vandens_abon');
            $table->decimal('elektra_bendra');
            $table->decimal('ukio_islaid');
            $table->decimal('nkf');
            $table->decimal('saltas_vanduo_price');
            $table->decimal('karstas_vanduo_price');
            $table->decimal('sildymas_price');
            $table->decimal('silumos_mazg_prieziura_price');
            $table->decimal('gyvatukas_price');
            $table->decimal('salto_vandens_abon_price');
            $table->decimal('elektra_bendra_price');
            $table->decimal('ukio_islaid_price');
            $table->decimal('nkf_price');
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
