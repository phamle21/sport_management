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
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('phone')->nullable()->unique();
            $table->string('gender')->nullable();
            $table->string('birthday')->nullable();
            $table->text('avatar')->nullable();
            $table->string('email')->unique();
            $table->string('status')->default('Active');;
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('facebook_id')->nullable();
            $table->string('google_id')->nullable();
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
        Schema::dropIfExists('group_stages');
        Schema::dropIfExists('participates');
        Schema::dropIfExists('league_seasons');
        Schema::dropIfExists('player_teams');
        Schema::dropIfExists('permission_roles');
        Schema::dropIfExists('user_roles');

        Schema::dropIfExists('permissions');
        Schema::dropIfExists('teams');
        Schema::dropIfExists('matches');
        Schema::dropIfExists('seasons');
        Schema::dropIfExists('users');
    }
};
