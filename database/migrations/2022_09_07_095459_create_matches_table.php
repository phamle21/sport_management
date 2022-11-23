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
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location')->nullable();
            $table->string('match_date');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('ground_id')->nullable();
            $table->text('indicators');
            $table->unsignedBigInteger('group_id')->nullable();
            $table->unsignedBigInteger('team_id')->nullable();
            $table->unsignedBigInteger('team_opposing_id')->nullable();
            $table->timestamps();

            $table->foreign('group_id')
                ->references('id')->on('groups')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('team_id')
                ->references('id')->on('teams')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('team_opposing_id')
                ->references('id')->on('teams')
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
        Schema::dropIfExists('matches');
    }
};
