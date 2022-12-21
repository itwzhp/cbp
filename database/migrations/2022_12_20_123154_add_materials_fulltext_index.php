<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        try {
            DB::statement(<<<'SQL'
            create fulltext index materials_fulltext_index
                on materials(title, description)
                with parser ngram
        SQL
            );
        } catch (QueryException $exception) {
            DB::statement(<<<'SQL'
ALTER TABLE materials ADD FULLTEXT INDEX `materials_fulltext_index` (title, description);
SQL
            );
        }
    }

    public function down()
    {
        //
    }
};
