<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('attachments', function (Blueprint $table) {
            $table->string('element')->nullable();
            $table->unsignedInteger('copies')->nullable();
            $table->string('print_color')->nullable();
            $table->string('thickness')->nullable();
            $table->string('size')->nullable();
            $table->text('comment')->nullable();
            $table->string('paper_color')->nullable();
        });
    }

    public function down()
    {
        Schema::table('attachments', function (Blueprint $table) {
            $table->dropColumn('element');
            $table->dropColumn('copies');
            $table->dropColumn('print_color');
            $table->dropColumn('thickness');
            $table->dropColumn('size');
            $table->dropColumn('comment');
            $table->dropColumn('paper_color');
        });
    }
};
