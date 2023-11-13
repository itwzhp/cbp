<?php
namespace App\Domains\Migration\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MergeAccountDuplicatesCommand extends Command
{
    protected $signature = 'users:merge';

    public function __invoke()
    {
        $users = DB::select(DB::raw('select * from(
select id,
       regexp_substr(email, \'.+zhp\.pl$\' ) as suffix
from users
) u
where u.suffix is not null'));

        dd($users);
    }
}
