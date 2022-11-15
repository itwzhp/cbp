<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('scenarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('material_id');
            $table->foreign('material_id')
                ->references('id')
                ->on('materials')
                ->cascadeOnDelete();

            $table->unsignedSmallInteger('order')->nullable();
            $table->string('title')->nullable();
            $table->string('form')->nullable();
            $table->unsignedSmallInteger('duration')->nullable();
            $table->string('responsible')->nullable();
            $table->text('description')->nullable();
            $table->text('materials')->nullable();

            $table->unsignedInteger('wp_id')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('scenarios');
    }
};
