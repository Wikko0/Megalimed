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
        Schema::create('calculators', function (Blueprint $table) {
            $table->id();
            $table->string('size')->nullable();
            $table->string('minHeight')->nullable();
            $table->string('maxHeight')->nullable();
            $table->string('minKg')->nullable();
            $table->string('maxKg')->nullable();
            $table->string('lengthTop')->nullable();
            $table->string('widthTop')->nullable();
            $table->string('lengthBot')->nullable();
            $table->string('widthBot')->nullable();
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
        Schema::dropIfExists('calculators');
    }
};
