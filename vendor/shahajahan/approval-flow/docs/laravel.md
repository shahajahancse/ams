# Laravel Integration

## Installation
composer require shahajahan/approval-flow

## Usage
use ApprovalFlow\Services\ApprovalFlow;
use ApprovalFlow\Adapters\LaravelAdapter;

$flow = new ApprovalFlow(new LaravelAdapter());

$nextRole = $flow->nextRole(2);
$prevRole = $flow->previousRole(2);
$canApprove = $flow->canApprove(auth()->id(), $documentId);

## Migrations
php artisan migrate --path=vendor/shahajahan/approval-flow/database/migrations
