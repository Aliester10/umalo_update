<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessStepsTable extends Migration
{
    public function up()
    {
        Schema::create('process_steps', function (Blueprint $table) {
            $table->id();
            $table->integer('step_number');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('process_steps');
    }
}
