<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement(<<<'SQL'
            create fulltext index materials_fulltext_index
                on materials(title, description)
                with parser ngram
        SQL
        );
    }

    public function down()
    {
        //
    }
};
