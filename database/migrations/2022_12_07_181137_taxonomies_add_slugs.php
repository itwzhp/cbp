<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('taxonomies', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique();
        });

        Schema::table('tags', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique();
        });
    }

    public function down()
    {
        Schema::table('taxonomies', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        Schema::table('tags', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique();
        });
    }
};
