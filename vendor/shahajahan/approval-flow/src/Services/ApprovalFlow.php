<?php
namespace ApprovalFlow\Services;

use ApprovalFlow\Contracts\ApproverInterface;

class ApprovalFlow
{
    protected $adapter;

    public function __construct(ApproverInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    public function nextRole(int $currentRoleId)
    {
        return $this->adapter->getForwardRole($currentRoleId);
    }

    public function previousRole(int $currentRoleId)
    {
        return $this->adapter->getBackwardRole($currentRoleId);
    }

    public function canApprove(int $userId, int $documentId)
    {
        return $this->adapter->checkApprovalPermission($userId, $documentId);
    }
}
