<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamMemberSocialsTable extends Migration
{
    public function up()
    {
        Schema::create('team_member_socials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_member_id')->constrained('team_members')->onDelete('cascade');

            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();
            $table->string('github')->nullable();
            $table->string('youtube')->nullable();
            $table->string('facebook')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('team_member_socials');
    }
}
