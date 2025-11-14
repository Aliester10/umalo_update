<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('activity_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('activity_id');
            $table->string('day_title');
            $table->longText('schedule_content');
            $table->timestamps();

            $table->foreign('activity_id')
                  ->references('id')->on('t_activities')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('activity_schedules');
    }
};
