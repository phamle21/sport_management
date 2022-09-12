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
        Schema::create('league_seasons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('season_id')->nullable();
            $table->unsignedBigInteger('league_id')->nullable();
            $table->timestamps();

            $table->foreign('season_id')
                ->references('id')->on('seasons')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('league_id')
                ->references('id')->on('leagues')
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
        Schema::dropIfExists('league_seasons');
    }
};
