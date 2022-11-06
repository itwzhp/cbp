<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('licences', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url')->nullable();
            $table->tinyInteger('wp_id')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('licences', function (Blueprint $table) {
            //
        });
    }
};
