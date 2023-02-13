<?php
namespace App\Domains\Users\Repositories;

use App\Domains\Users\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Laravel\Sanctum\PersonalAccessToken;

class ApiTokensRepository
{
    const API_TOKEN_NAME = 'api';

    public function get(User $user): PersonalAccessToken
    {
        /** @var PersonalAccessToken $token */
        $token = $user->tokens()
            ->where('name', 'api')
            ->where(function (Builder $q) {
                $q->whereNull('expires_at')
                    ->orWhere('expires_at', '>', Carbon::now());
            })->first();

        if ($token !== null) {
            return $token;
        }

        return $this->create($user);
    }

    protected function create(User $user): PersonalAccessToken
    {
        /** @var PersonalAccessToken $token */
        $token = $user->tokens()->create([
            'name'       => 'api',
            'token'      => hash('sha256', $plainTextToken = Str::random(40)),
            'abilities'  => ['*'],
            'expires_at' => Carbon::now()->addWeek(),
        ]);

        return $token;
    }
}
