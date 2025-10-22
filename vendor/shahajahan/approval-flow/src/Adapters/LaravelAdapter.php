<?php
namespace ApprovalFlow\Adapters;

use Illuminate\Support\Facades\DB;
use ApprovalFlow\Contracts\ApproverInterface;

class LaravelAdapter implements ApproverInterface
{
    public function getForwardRole(int $roleId)
    {
        return DB::table('approval_role_manage')->where('role_id', $roleId)->value('access_forward');
    }

    public function getBackwardRole(int $roleId)
    {
        return DB::table('approval_role_manage')->where('role_id', $roleId)->value('access_backward');
    }

    public function checkApprovalPermission(int $userId, int $documentId)
    {
        return DB::table('approval_role_manage')
                 ->where('user_id', $userId)
                 ->where('status', 1)
                 ->exists();
    }
}
