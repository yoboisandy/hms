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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id', 'exists:users,id')->constrained();
            $table->foreignId('room_id', 'exists:rooms,id')->constrained();
            $table->date('start_date');
            $table->date('end_date');
            $table->string('price');
            $table->string('status')->default('Pending');
            $table->foreignId('roomtype_id', 'exists:roomtypes,id')->constrained();
            $table->softDeletes();
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
        Schema::dropIfExists('books');
    }
};
