<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('job_positions', function (Blueprint $table) {
        $table->enum('employment_type', [
            'full_time',
            'part_time',
            'internship',
            'remote',
            'contract'
        ])->default('full_time')->change();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_positions', function (Blueprint $table) {
            //
        });
    }
};
