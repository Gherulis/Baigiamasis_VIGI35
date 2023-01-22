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
        Schema::create('invoices', function (Blueprint $table) {

            $table->id();
            $table->integer('flat_id');
            $table->string ('data');
            $table->decimal('saltas_vanduo');
            $table->decimal('karstas_vanduo');
            $table->decimal('sildymas');
            $table->decimal('silumos_mazg_prieziura');
            $table->decimal('gyvatukas');
            $table->decimal('salto_vandens_abon');
            $table->decimal('elektra_bendra');
            $table->decimal('ukio_islaid');
            $table->decimal('nkf');
            $table->decimal('Kompensacija')->default('0');
            $table->decimal('Skola')->default('0');
            $table->decimal('Permoka')->default('0');
            $table->decimal('Delspinigiai')->default('0');
            $table->decimal('Sumoketa')->default('0');
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
        Schema::dropIfExists('invoices');
    }
};
