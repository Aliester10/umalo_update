<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('job_positions', function (Blueprint $table) {
            $table->id();

            // sesuai model
            $table->string('title');
            $table->enum('employment_type', ['fulltime', 'parttime', 'internship', 'contract'])->default('fulltime');
            $table->json('tags')->nullable();
            $table->longText('description')->nullable();
            $table->longText('requirements')->nullable();

            // boolean di model
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('job_positions');
    }
};
