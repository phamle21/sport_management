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
        Schema::create('sponsorships', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('sponsor_amount');
            $table->string('sponsor_oder_id');
            $table->string('sponsor_status');
            $table->string('sponsor_link');
            $table->string('sponsor_method');
            $table->unsignedBigInteger('sponsor_id')->nullable();
            $table->unsignedBigInteger('league_id')->nullable();
            $table->timestamps();

            $table->foreign('sponsor_id')
                ->references('id')->on('sponsors')
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
        Schema::dropIfExists('sponsorships');
    }
};
