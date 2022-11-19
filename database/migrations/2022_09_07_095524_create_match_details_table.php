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
        Schema::create('match_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('matches_id')->nullable();
            $table->unsignedBigInteger('team_id')->nullable();
            $table->text('indicators');
            $table->string('note');
            $table->timestamps();

            $table->foreign('matches_id')
                ->references('id')->on('matches')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('team_id')
                ->references('id')->on('teams')
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
        Schema::dropIfExists('match_details');
    }
};
