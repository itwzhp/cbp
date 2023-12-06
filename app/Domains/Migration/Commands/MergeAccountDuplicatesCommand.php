<?php
namespace App\Domains\Migration\Commands;

use App\Domains\Materials\Models\Material;
use App\Domains\Users\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MergeAccountDuplicatesCommand extends Command
{
    protected $signature = 'users:merge';

    public function __invoke()
    {
        $users = DB::select('select * from(
select id,
       regexp_substr(email, \'.+zhp\.pl$\' ) as suffix
from users
) u
where u.suffix is not null');

        foreach ($users as $user) {
            $prefix = explode('@', $user->suffix)[0];

            $account = User::where('email', "{$prefix}@zhp.net.pl")->first();

            if ($account !== null) {

                $duplicate = User::where('email', $user->suffix)->first();
                $this->mergeAccounts($account, $duplicate);
            }
        }
    }

    protected function mergeAccounts(User $account, User $duplicate): void
    {
        Material::where('user_id', $duplicate->id)
            ->update([
                'user_id' => $account->id,
            ]);

        $duplicate->delete();
    }
}
