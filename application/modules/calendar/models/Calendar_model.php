<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Calendar_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_members_count() {
        // count query
        // $this->db->select('COUNT(*) as count');
        // $this->db->from('members');
        // $q = $this->db->get()->result();

        // $tmp = $q;
        // $ret['num_rows'] = $tmp[0]->count;

        // return $ret;
    }

}
