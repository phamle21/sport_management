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
        Schema::create('booking_grounds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('matches_id')->nullable();
            $table->unsignedBigInteger('ground_id')->nullable();
            $table->string('time');
            $table->string('price');
            $table->string('status');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('matches_id')
                ->references('id')->on('matches')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('ground_id')
                ->references('id')->on('grounds')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_grounds');
    }
};
