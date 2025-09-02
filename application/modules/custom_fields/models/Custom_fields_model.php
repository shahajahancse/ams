<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Custom_fields_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Custom Field Definitions (asset_custom_fields)
    public function get_custom_fields() {
        return $this->db->get('asset_custom_fields')->result();
    }

    public function get_custom_field($id) {
        return $this->db->get_where('asset_custom_fields', ['id' => $id])->row();
    }

    public function save_custom_field($data, $id = null) {
        if ($id) {
            $this->db->where('id', $id);
            return $this->db->update('asset_custom_fields', $data);
        } else {
            return $this->db->insert('asset_custom_fields', $data);
        }
    }

    public function delete_custom_field($id) {
        $this->db->where('id', $id);
        return $this->db->delete('asset_custom_fields');
    }

    // Custom Field Values (asset_custom_field_values)
    public function get_asset_custom_field_values($asset_id) {
        $this->db->select('acfv.*, acf.field_name, acf.field_type, acf.options');
        $this->db->from('asset_custom_field_values acfv');
        $this->db->join('asset_custom_fields acf', 'acf.id = acfv.custom_field_id');
        $this->db->where('acfv.asset_id', $asset_id);
        return $this->db->get()->result();
    }

    public function save_asset_custom_field_value($asset_id, $custom_field_id, $value) {
        $existing = $this->db->get_where('asset_custom_field_values', [
            'asset_id' => $asset_id,
            'custom_field_id' => $custom_field_id
        ])->row();

        $data = [
            'asset_id' => $asset_id,
            'custom_field_id' => $custom_field_id,
            'field_value' => $value
        ];

        if ($existing) {
            $this->db->where('id', $existing->id);
            return $this->db->update('asset_custom_field_values', $data);
        } else {
            return $this->db->insert('asset_custom_field_values', $data);
        }
    }

    public function delete_asset_custom_field_values($asset_id) {
        $this->db->where('asset_id', $asset_id);
        return $this->db->delete('asset_custom_field_values');
    }

    public function get_asset_custom_field_value($asset_id, $custom_field_id) {
        return $this->db->get_where('asset_custom_field_values', [
            'asset_id' => $asset_id,
            'custom_field_id' => $custom_field_id
        ])->row();
    }
}