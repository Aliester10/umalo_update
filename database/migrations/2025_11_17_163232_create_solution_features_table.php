<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('solution_features', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('solution_id');
            $table->string('feature_title');
            $table->string('feature_icon')->nullable(); // optional icon
            
            $table->timestamps();

            // foreign key
            $table->foreign('solution_id')
                  ->references('id')
                  ->on('solutions')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('solution_features');
    }
};
