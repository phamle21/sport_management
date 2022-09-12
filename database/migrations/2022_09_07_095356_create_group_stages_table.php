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
        Schema::create('group_stages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group_id')->nullable();
            $table->unsignedBigInteger('stage_id')->nullable();
            $table->timestamps();

            $table->foreign('group_id')
                ->references('id')->on('groups')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('stage_id')
                ->references('id')->on('stages')
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
        Schema::dropIfExists('group_stages');
    }
};
