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
        Schema::create('roomtypes', function (Blueprint $table) {
            $table->id();
            $table->string("type_name");
            $table->text("description")->nullable();
            $table->string("adult_occupancy");
            $table->string("child_occupancy");
            $table->string("image")->nullable();
            $table->string("base_occupancy");
            $table->string("higher_occupancy");
            $table->boolean("extra_bed");
            $table->string("base_price");
            $table->string("additional_price");
            $table->string("extra_bed_price");
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
        Schema::dropIfExists('roomtypes');
    }
};
