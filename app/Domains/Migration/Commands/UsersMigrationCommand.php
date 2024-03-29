<?php
namespace App\Domains\Migration\Commands;

use App\Domains\Users\Models\User;
use App\Domains\Users\Roles\RolesEnum;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersMigrationCommand extends Command
{
    protected $signature = 'wp:users';

    public function __invoke(): void
    {
        $oldUsers = DB::connection('wp')
            ->table('wp_users')
            ->get();

        $count = 0;

        foreach ($oldUsers as $oldUser) {
            if ($this->shouldIgnore($oldUser)) {
                $count++;

                continue;
            }

            $usermeta = $this->extractUsermeta($oldUser);

            $user = $this->createUser($oldUser, $usermeta);
            $this->info('Added user: ' . $user->email);
        }

        $this->info("Ignored {$count} suspicious users");
    }

    protected function extractUsermeta(\stdClass $wpUser): array
    {
        $usermeta = DB::connection('wp')
            ->table('wp_usermeta')
            ->where('user_id', $wpUser->ID)
            ->get();

        return [
            'first_name' => $usermeta->where('meta_key', 'first_name')->first()->meta_value,
            'last_name'  => $usermeta->where('meta_key', 'last_name')->first()->meta_value,
            'role'       => $this->detectRole($usermeta->where('meta_key', 'wp_capabilities')->first()->meta_value),
        ];
    }

    protected function detectRole(string $value): ?string
    {
        $value = Str::of($value);

        if ($value->contains('contributor')) {
            return RolesEnum::CONTRIBUTOR->value;
        }

        if ($value->contains('author')) {
            return RolesEnum::AUTHOR->value;
        }

        if ($value->contains('editor')) {
            return RolesEnum::EDITOR->value;
        }

        if ($value->contains('recenzent')) {
            return RolesEnum::REVIEWER->value;
        }

        if ($value->contains('administrator')) {
            return RolesEnum::ADMIN->value;
        }

        return null;
    }

    protected function createUser(mixed $oldUser, array $usermeta): User
    {
        /** @var User $user */
        $user = User::updateOrCreate([
            'email' => $oldUser->user_email,
        ], [
            'name'       => $oldUser->display_name,
            'created_at' => $oldUser->user_registered,
            'wp_id'      => $oldUser->ID,
            'first_name' => $usermeta['first_name'],
            'last_name'  => $usermeta['last_name'],
            'password'   => Hash::make(Str::random()),
        ]);

        $user->assignRole([$usermeta['role']]);

        return $user;
    }

    protected function shouldIgnore(mixed $oldUser): bool
    {
        if (Str::of($oldUser->user_email)->endsWith([
            'zhp.pl',
            'zhp.net.pl',
            'gmail.com',
            'wp.pl',
            'gazeta.pl',
            'op.pl',
            'o2.pl',
            'autograf.pl',
            'onet.eu',
        ])) {
            return false;
        }

        return true;
    }
}
