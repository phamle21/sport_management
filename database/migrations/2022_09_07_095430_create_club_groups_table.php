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
        Schema::create('club_groups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group_id')->nullable();
            $table->unsignedBigInteger('club_id')->nullable();
            $table->string('indicators');
            $table->timestamps();

            $table->foreign('group_id')
                ->references('id')->on('groups')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('club_id')
                ->references('id')->on('clubs')
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
        Schema::dropIfExists('club_groups');
    }
};
