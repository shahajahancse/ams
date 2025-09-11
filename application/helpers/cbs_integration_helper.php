<?php
if (!function_exists('log_cbs_integration_event')) {
    function log_cbs_integration_event($event_type, $status, $message = '') {
        $CI =& get_instance();
        $CI->load->database();
        $log_data = array(
            'log_date' => date('Y-m-d H:i:s'),
            'event_type' => $event_type,
            'status' => $status,
            'message' => $message
        );
        $CI->db->insert('cbs_integration_log', $log_data);
    }
}