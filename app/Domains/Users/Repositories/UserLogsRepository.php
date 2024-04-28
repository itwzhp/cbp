<?php
namespace App\Domains\Users\Repositories;

use App\Domains\Users\ActionsEnum;
use App\Domains\Users\Models\User;
use App\Domains\Users\Models\UserLog;
use Illuminate\Database\Eloquent\Model;

class UserLogsRepository
{
    public function log(User $user, ActionsEnum $action, ?Model $onModel = null, ?array $withDetails = null): UserLog
    {
        $params = [
            'user_id' => $user->id,
            'action'  => $action,
            'details' => $withDetails,
        ];

        if ($onModel !== null) {
            $params += [
                'model_id'   => $onModel->id,
                'model_type' => get_class($onModel),
            ];
        }

        return UserLog::create($params);
    }
}
