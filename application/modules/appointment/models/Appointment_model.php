<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Appointment_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_list($limit=1000, $offset=0, $status=NULL){
        $this->db->select('*');
        $this->db->from('appointment');
        if($status){
            $this->db->where('status', $status);
        }
        $this->db->order_by('date', 'DESC');
        $query = $this->db->get()->result();
        $result['rows'] = $query;

        // count query
        $q = $this->db->select('COUNT(*) as count');
        $this->db->from('appointment'); 
        if($status){
            $this->db->where('status', $status);
        }
        $query = $this->db->get()->result();
        $tmp = $query;
        $result['num_rows'] = $tmp[0]->count;

        return $result;
    }

    public function get_app_person($id){
        $this->db->select('*');
        $this->db->from('appointment_person');        
        $this->db->where('data_id', $id);
        $query = $this->db->get()->result();
        // echo $this->db->last_query(); exit;
        return $query;
    }

    public function get_info($id) {
        $this->db->select('a.*, u.first_name, u.org_prof_name, u.phone, u.email');
        $this->db->from('appointment a');
        $this->db->join('users u', 'u.id=a.author', 'LEFT');
        $this->db->where('a.id', $id);
        $query = $this->db->get()->row();

        return $query;
    }

    public function appointment_destroy($id) {
        // Delete row
        if($this->db->delete('appointment', array('id' => $id))){            
            return TRUE;
        }else{
            return FALSE;
        }
    }

}
