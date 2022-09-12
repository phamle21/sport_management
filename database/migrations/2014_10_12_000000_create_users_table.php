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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('address');
            $table->string('gender');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('booking_gournds');
        Schema::dropIfExists('player_histories');
        Schema::dropIfExists('match_details');
        Schema::dropIfExists('club_groups');
        Schema::dropIfExists('group_stages');
        Schema::dropIfExists('participates');
        Schema::dropIfExists('league_seasons');
        Schema::dropIfExists('player_clubs');
        Schema::dropIfExists('permission_roles');
        Schema::dropIfExists('user_roles');

        Schema::dropIfExists('permissions');
        Schema::dropIfExists('clubs');
        Schema::dropIfExists('matches');
        Schema::dropIfExists('seasons');
        Schema::dropIfExists('users');
    }
};
