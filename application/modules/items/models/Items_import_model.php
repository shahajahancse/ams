<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Items_import_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('excel'); // Load PHPExcel library
    }

    public function import_assets($file_path) {
        $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);

        if ($file_extension == 'csv') {
            $reader = new PHPExcel_Reader_CSV();
        } else {
            $reader = PHPExcel_IOFactory::createReaderForFile($file_path);
        }

        $reader->setReadDataOnly(TRUE);
        $objPHPExcel = $reader->load($file_path);
        $worksheet = $objPHPExcel->getActiveSheet();
        $highestRow = $worksheet->getHighestRow();
        $highestColumn = $worksheet->getHighestColumn();

        $imported_count = 0;
        $updated_count = 0;
        $errors = [];

        // Assuming the first row is the header
        $header = $worksheet->rangeToArray('A1:' . $highestColumn . '1', NULL, TRUE, FALSE)[0];
        $header = array_map('trim', $header);
        $header = array_map('strtolower', $header);
        $header = array_map(function($h) { return str_replace(' ', '_', $h); }, $header);


        for ($row = 2; $row <= $highestRow; $row++) {
            $rowData = $worksheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE)[0];
            $item_data = array_combine($header, $rowData);

            // Map spreadsheet columns to database columns
            $db_data = [
                'item_name'         => $item_data['item_name'] ?? null,
                'description'       => $item_data['item_specification'] ?? null, // Assuming 'item_specification' in file
                'division_id'       => $item_data['division_id'] ?? null,
                'cat_id'            => $item_data['category_id'] ?? null, // Assuming 'category_id' in file
                'sub_cat_id'        => $item_data['sub_category_id'] ?? null, // Assuming 'sub_category_id' in file
                'unit_id'           => $item_data['unit_id'] ?? null,
                'type'              => $item_data['type'] ?? null,
                'order_level'       => $item_data['order_level'] ?? null,
                'status'            => $item_data['status'] ?? null,
                'acquisition_date'  => !empty($item_data['acquisition_date']) ? date('Y-m-d', strtotime($item_data['acquisition_date'])) : null,
                'cost'              => $item_data['cost'] ?? null,
                'supplier_id'       => $item_data['supplier_id'] ?? null,
                'serial_number'     => $item_data['serial_number'] ?? null,
                'warranty_months'   => $item_data['warranty_months'] ?? null,
                'custodian_id'      => $item_data['custodian_id'] ?? null,
                'asset_status'      => $item_data['asset_status'] ?? null,
                'branch_id'         => $item_data['branch_id'] ?? null,
                'department_id'     => $item_data['department_id'] ?? null,
                'floor_id'          => $item_data['floor_id'] ?? null,
                'room_id'           => $item_data['room_id'] ?? null,
            ];

            // Remove null values to avoid overwriting with null if column is missing
            $db_data = array_filter($db_data, function($value) { return $value !== null; });

            // Basic validation (you might want more robust validation)
            if (empty($db_data['item_name'])) {
                $errors[] = "Row {" . $row . ": Item Name is required.";
                continue;
            }

            // Check if asset already exists (e.g., by serial_number or a unique identifier)
            $existing_item = null;
            if (!empty($db_data['serial_number'])) {
                $existing_item = $this->db->get_where('items', ['serial_number' => $db_data['serial_number']])->row();
            } elseif (!empty($db_data['item_name'])) { // Fallback if no serial, but less reliable
                $existing_item = $this->db->get_where('items', ['item_name' => $db_data['item_name']])->row();
            }


            if ($existing_item) {
                // Update existing item
                $this->db->where('id', $existing_item->id);
                $this->db->update('items', $db_data);
                $updated_count++;
            } else {
                // Insert new item
                $this->db->insert('items', $db_data);
                $imported_count++;
            }
        }

        unlink($file_path); // Delete the uploaded file

        if (!empty($errors)) {
            return ['status' => 'error', 'message' => 'Import completed with errors: ' . implode(', ', $errors)];
        } else {
            return ['status' => 'success', 'message' => "Import successful. " . $imported_count . " new assets imported, " . $updated_count . " assets updated."];
        }
    }
}
