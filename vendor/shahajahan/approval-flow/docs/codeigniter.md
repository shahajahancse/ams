# CodeIgniter Integration

## Installation
Include package via Composer: composer require shahajahan/approval-flow
Load Composer autoload in index.php

## Usage
$flow = new \ApprovalFlow\Services\ApprovalFlow(
    new \ApprovalFlow\Adapters\CodeIgniterAdapter($this)
);

$next = $flow->nextRole($currentRoleId);
$canApprove = $flow->canApprove($user_id, $doc_id);

## Migrations
Import database/migrations/CodeIgniter_approval_tables.sql into your DB
