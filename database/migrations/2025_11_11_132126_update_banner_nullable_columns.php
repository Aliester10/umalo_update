<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('t_banner', function (Blueprint $table) {
            $table->string('title')->nullable()->change();
            $table->text('description')->nullable()->change();
            $table->string('button_text')->nullable()->change();
            $table->string('button_url')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('t_banner', function (Blueprint $table) {
            $table->string('title')->nullable(false)->change();
            $table->text('description')->nullable(false)->change();
            $table->string('button_text')->nullable(false)->change();
            $table->string('button_url')->nullable(false)->change();
        });
    }
};
