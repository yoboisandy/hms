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
        Schema::create('hallbooks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id', 'exists:users,id')->constrained();
            $table->foreignId('hall_id', 'exists:halls,id')->nullable()->constrained();
            $table->date('start_date');
            $table->date('end_date');
            $table->string('status')->default('Pending');
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
        Schema::dropIfExists('hallbooks');
    }
};
