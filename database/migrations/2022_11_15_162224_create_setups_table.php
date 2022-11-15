<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('setups', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('material_id');
            $table->foreign('material_id')
                ->references('id')
                ->on('materials')
                ->cascadeOnDelete();

            $table->unsignedSmallInteger('capacity_min')->nullable();
            $table->unsignedSmallInteger('capacity_opt')->nullable();
            $table->unsignedSmallInteger('capacity_max')->nullable();

            $table->unsignedSmallInteger('duration')->nullable();
            $table->string('time')->nullable();

            $table->unsignedSmallInteger('instructor_count')->nullable();
            $table->text('instructor_competence')->nullable();

            $table->text('remarks')->nullable();
            $table->text('location')->nullable();
            $table->text('technical_requirements')->nullable();
            $table->text('materials')->nullable();
            $table->text('participant_materials')->nullable();
            $table->text('participant_clothing')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('setups');
    }
};
