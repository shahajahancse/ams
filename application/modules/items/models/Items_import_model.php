<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Items_import_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('excel'); // Load PHPExcel library
    }

    public function import_assets($file_path) {
        try {
            $objPHPExcel = PHPExcel_IOFactory::load($file_path);
            $sheet = $objPHPExcel->getActiveSheet();
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();

            $this->db->trans_start(); // Start transaction

            for ($row = 2; $row <= $highestRow; $row++) { // Assuming header is in row 1
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
                
                // Map columns based on the bulk_export headers
                // 'ID', 'Item Name', 'Description', 'Division ID', 'Category ID', 'Sub Category ID',
                // 'Unit ID', 'Type', 'Order Level', 'Status', 'Acquisition Date', 'Cost',
                // 'Supplier ID', 'Serial Number', 'Warranty Months', 'Custodian ID',
                // 'Asset Status', 'Branch ID', 'Department ID', 'Floor ID', 'Room ID',
                // 'depreciation_method', 'useful_life', 'salvage_value'

                $item_data = array(
                    'item_name' => $rowData[0][1], 
                    'description' => $rowData[0][2], 
                    'division_id' => $rowData[0][3], 
                    'cat_id' => $rowData[0][4], 
                    'sub_cat_id' => $rowData[0][5], 
                    'unit_id' => $rowData[0][6], 
                    'type' => $rowData[0][7], 
                    'order_level' => $rowData[0][8], 
                    'status' => $rowData[0][9], 
                    'acquisition_date' => date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($rowData[0][10])), 
                    'cost' => $rowData[0][11], 
                    'book_value' => $rowData[0][11], // Initial book value is cost
                    'supplier_id' => $rowData[0][12], 
                    'serial_number' => $rowData[0][13], 
                    'warranty_months' => $rowData[0][14], 
                    // 'custodian_id' => $rowData[0][15], 
                    'asset_status' => $rowData[0][16], 
                    // 'branch_id' => $rowData[0][17], 
                    // 'department_id' => $rowData[0][18], 
                    // 'floor_id' => $rowData[0][19], 
                    // 'room_id' => $rowData[0][20], 
                    'depreciation_method' => $rowData[0][17], 
                    'useful_life' => $rowData[0][18], 
                    'salvage_value' => $rowData[0][19]
                );
                $this->db->insert('items', $item_data);
            }

            $this->db->trans_complete(); // Complete transaction

            if ($this->db->trans_status() === FALSE) {
                return array('status' => 'error', 'message' => 'Database transaction failed.');
            } else {
                return array('status' => 'success', 'message' => 'Assets imported successfully.');
            }

        } catch (Exception $e) {
            return array('status' => 'error', 'message' => 'Error loading file: ' . $e->getMessage());
        }
    }
}