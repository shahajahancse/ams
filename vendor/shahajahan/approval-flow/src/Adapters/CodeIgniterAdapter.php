<?php
namespace ApprovalFlow\Adapters;

use ApprovalFlow\Contracts\ApproverInterface;

class CodeIgniterAdapter implements ApproverInterface
{
    protected $db;

    public function __construct($ci)
    {
        $this->db = $ci->db;
    }

    public function getForwardRole(int $roleId)
    {
        return $this->db->select('access_forward')
                        ->where('role_id', $roleId)
                        ->get('approval_role_manage')
                        ->row('access_forward');
    }

    public function getBackwardRole(int $roleId)
    {
        return $this->db->select('access_backward')
                        ->where('role_id', $roleId)
                        ->get('approval_role_manage')
                        ->row('access_backward');
    }

    public function checkApprovalPermission(int $userId, int $documentId)
    {
        $query = $this->db->where('user_id', $userId)
                          ->where('status', 1)
                          ->get('approval_role_manage');
        return $query->num_rows() > 0;
    }
}
