<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            $table->unsignedBigInteger('licence_id')->nullable();
            $table->foreign('licence_id')
                ->references('id')
                ->on('licences')
                ->cascadeOnDelete();

            $table->string('state', 128);
            $table->string('title');
            $table->fullText('title');
            $table->text('description');
            $table->fullText('description');
            $table->string('slug')->unique();
            $table->unsignedInteger('wp_id')->unique()->nullable();
            $table->timestamps();
            $table->timestamp('published_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materials');
    }
};
