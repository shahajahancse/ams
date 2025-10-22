<?php
require __DIR__ . '/../vendor/autoload.php';
use ApprovalFlow\Services\ApprovalFlow;
use ApprovalFlow\Adapters\PdoAdapter;

$pdo = new PDO('sqlite::memory:'); // demo DB
// create tables, seed test data (or skip and illustrate)
$adapter = new PdoAdapter($pdo);
$flow = new ApprovalFlow($adapter);
var_dump($flow->canApprove(1, 1));

// see ApprovalFlowServiceProvider.php
