<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_gl_account_mappings_table extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'ams_account_type' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'unique' => TRUE,
            ),
            'cbs_gl_account_code' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'description' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('gl_account_mappings');

        // Insert default mappings
        $data = array(
            array(
                'ams_account_type' => 'Asset Cost Account',
                'cbs_gl_account_code' => '15000', // Example GL code
                'description' => 'GL account for asset cost'
            ),
            array(
                'ams_account_type' => 'Cash/Bank or Accounts Payable',
                'cbs_gl_account_code' => '10100', // Example GL code
                'description' => 'GL account for cash/bank or accounts payable'
            ),
            array(
                'ams_account_type' => 'Depreciation Expense Account',
                'cbs_gl_account_code' => '60000', // Example GL code
                'description' => 'GL account for depreciation expense'
            ),
            array(
                'ams_account_type' => 'Accumulated Depreciation Account',
                'cbs_gl_account_code' => '15500', // Example GL code
                'description' => 'GL account for accumulated depreciation'
            ),
            array(
                'ams_account_type' => 'Gain on Disposal Account',
                'cbs_gl_account_code' => '70000', // Example GL code
                'description' => 'GL account for gain on asset disposal'
            ),
            array(
                'ams_account_type' => 'Loss on Disposal Account',
                'cbs_gl_account_code' => '80000', // Example GL code
                'description' => 'GL account for loss on asset disposal'
            )
        );
        $this->db->insert_batch('gl_account_mappings', $data);
    }

    public function down()
    {
        $this->dbforge->drop_table('gl_account_mappings');
    }
}
