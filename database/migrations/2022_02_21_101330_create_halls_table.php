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
        Schema::create('halls', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('base_occupancy');
            $table->string('high_occupancy');
            $table->foreignId('amenity_id')->constrained();
            $table->foreignId('floor_id')->constrained();
            $table->string('image');
            $table->string('base_price');
            $table->string('high_price');
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
        Schema::dropIfExists('halls');
    }
};