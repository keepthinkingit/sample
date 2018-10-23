<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Status;

class StatusPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function destroy(User $user, Status $status)
    {
        //只有当前用户id 等于status表uid字段相同才能删除。
        return $user->id === $status->user_id;
    }
}
