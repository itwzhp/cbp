<?php
namespace App\Domains\Migration\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SanitizeFieldsValuesCommand extends Command
{
    protected $signature = 'wp:sanitize_fields';

    public function __invoke()
    {
        DB::statement(<<<'SQL'
            update fields
            set value = REPLACE(SUBSTRING(SUBSTRING_INDEX(value, ',', 1),
                    CHAR_LENGTH(SUBSTRING_INDEX(value, ',', 1 - 1)) + 1),
                    ',', '')
            where type in ('author', 'reviewer', 'redactor');
            SQL
        );
    }
}
