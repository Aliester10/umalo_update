<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('solutions', function (Blueprint $table) {
            $table->id();

            // Basic info
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('banner_image')->nullable();
            $table->text('short_description')->nullable();

            // Overview section
            $table->string('overview_title')->nullable();
            $table->longText('overview_description')->nullable();

            // Benefits
            $table->longText('benefits')->nullable();

            // CTA Buttons
            $table->string('brochure_file')->nullable();
            $table->string('contact_link')->nullable();

            // ordering & status
            $table->integer('order')->default(0);
            $table->enum('status', ['draft', 'published'])->default('draft');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('solutions');
    }
};
