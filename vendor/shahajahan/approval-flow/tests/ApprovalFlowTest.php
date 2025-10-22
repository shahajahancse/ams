<?php
use PHPUnit\Framework\TestCase;
use ApprovalFlow\Services\ApprovalFlow;
use ApprovalFlow\Adapters\PdoAdapter;

class ApprovalFlowTest extends TestCase
{
    public function testCanApprove()
    {
        $adapter = $this->createMock(PdoAdapter::class);
        $adapter->method('checkApprovalPermission')->willReturn(true);
        $flow = new ApprovalFlow($adapter);
        $this->assertTrue($flow->canApprove(1, 10));
    }
}
