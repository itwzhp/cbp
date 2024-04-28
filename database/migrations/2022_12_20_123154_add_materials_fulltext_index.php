<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\QueryException;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

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
            // MariaDB support
            DB::statement(<<<'SQL'
ALTER TABLE materials ADD FULLTEXT INDEX `materials_fulltext_index` (title, description);
SQL
            );
        }
    }

    public function down()
    {
        Schema::table('materials', function (Blueprint $table) {
            $table->dropIndex('materials_fulltext_index');
        });
    }
};
