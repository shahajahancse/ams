<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_approve_forward_backward_type extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'forward_type' => array(
                'type' => "ENUM('only_forward','forward_backward','multi_forward','multi_forward_backward')",
                'default' => 'only_forward',
            ),
            'fb_url' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
            'status' => array(
                'type' => 'TINYINT',
                'constraint' => '1',
                'default' => 1,
            ),
            'remarks' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('approve_forward_backward_type');
    }

    public function down()
    {
        $this->dbforge->drop_table('approve_forward_backward_type');
    }
}
