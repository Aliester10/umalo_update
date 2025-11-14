<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('t_activities', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('title');
            $table->date('start_date')->nullable()->after('date');
            $table->date('end_date')->nullable()->after('start_date');
            $table->string('location')->nullable()->after('description');
            $table->integer('participants')->nullable()->after('location');
            $table->string('duration')->nullable()->after('participants');
            $table->string('category')->nullable()->after('duration');
            $table->string('status')->nullable()->after('category');
            $table->string('cover_image')->nullable()->after('status');
            $table->text('tags')->nullable()->after('cover_image');
        });
    }

    public function down()
    {
        Schema::table('t_activities', function (Blueprint $table) {
            $table->dropColumn([
                'slug','start_date','end_date','location','participants',
                'duration','category','status','cover_image','tags'
            ]);
        });
    }
};
