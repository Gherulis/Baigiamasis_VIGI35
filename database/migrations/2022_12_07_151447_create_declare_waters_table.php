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
        Schema::create('declare_waters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('flat_id');
            $table->foreign('flat_id')->references('id')->on('flats');
            $table->integer('kitchen_cold');
            $table->integer('kitchen_hot');
            $table->integer('bath_cold');
            $table->integer('bath_hot');
            $table->integer('kitchen_cold_usage');
            $table->integer('kitchen_hot_usage');
            $table->integer('bath_cold_usage');
            $table->integer('bath_hot_usage');
            $table->string('declaredBy');
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
        Schema::dropIfExists('declare_waters');
    }
};
