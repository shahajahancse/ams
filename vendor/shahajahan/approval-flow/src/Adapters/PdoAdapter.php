<?php
namespace ApprovalFlow\Adapters;

use PDO;
use ApprovalFlow\Contracts\ApproverInterface;

class PdoAdapter implements ApproverInterface
{
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getForwardRole(int $roleId)
    {
        $stmt = $this->pdo->prepare("SELECT access_forward FROM approval_role_manage WHERE role_id = ?");
        $stmt->execute([$roleId]);
        return $stmt->fetchColumn();
    }

    public function getBackwardRole(int $roleId)
    {
        $stmt = $this->pdo->prepare("SELECT access_backward FROM approval_role_manage WHERE role_id = ?");
        $stmt->execute([$roleId]);
        return $stmt->fetchColumn();
    }

    public function checkApprovalPermission(int $userId, int $documentId)
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM approval_role_manage WHERE user_id = ? AND status = 1");
        $stmt->execute([$userId]);
        return $stmt->fetchColumn() > 0;
    }
}
