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
        $table->string('title');
        $table->string('employment_type');
        $table->json('tags')->nullable();
        $table->text('description')->nullable();
        $table->text('requirements')->nullable();
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
}


    public function down()
    {
        Schema::dropIfExists('job_positions');
    }
};
