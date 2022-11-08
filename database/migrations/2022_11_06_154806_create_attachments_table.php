<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('material_id');
            $table->foreign('material_id')
                ->references('id')
                ->on('materials')
                ->cascadeOnDelete();

            $table->string('name');
            $table->string('path');
            $table->string('mime');

            $table->unsignedInteger('wp_id')->nullable();
            $table->unsignedInteger('downloads')->default(0);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('attachments');
    }
};
