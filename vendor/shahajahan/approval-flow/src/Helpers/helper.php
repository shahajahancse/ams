<?php
if (!function_exists('approval_log')) {
    function approval_log($message)
    {
        echo "[ApprovalFlow] " . date('Y-m-d H:i:s') . " - " . $message . PHP_EOL;
    }
}
