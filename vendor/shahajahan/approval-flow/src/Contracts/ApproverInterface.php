<?php
namespace ApprovalFlow\Contracts;

interface ApproverInterface
{
    public function getForwardRole(int $roleId);
    public function getBackwardRole(int $roleId);
    public function checkApprovalPermission(int $userId, int $documentId);
}
