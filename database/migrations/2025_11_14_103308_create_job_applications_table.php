<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_position_id')->constrained('job_positions')->cascadeOnDelete();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->string('location')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('resume'); // file path
            $table->longText('cover_letter')->nullable();
            $table->enum('status', ['pending', 'reviewed', 'shortlisted', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('job_applications');
    }
};
