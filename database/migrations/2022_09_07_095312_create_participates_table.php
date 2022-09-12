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
        Schema::create('participates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('club_id')->nullable();
            $table->unsignedBigInteger('league_id')->nullable();
            $table->timestamps();

            $table->foreign('club_id')
                ->references('id')->on('clubs')
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
        Schema::dropIfExists('participates');
    }
};
