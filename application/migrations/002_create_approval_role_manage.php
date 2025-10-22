<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_approval_role_manage extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'user_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ),
            'role_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ),
            'process_type' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
            'user_ordering' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => TRUE,
            ),
            'access_forward' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
            'access_backward' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
        ));
        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->add_field('CONSTRAINT fk_approval_role_manage_role_id FOREIGN KEY (role_id) REFERENCES approver_user_role(id) ON DELETE CASCADE');
        $this->dbforge->create_table('approval_role_manage');
    }

    public function down()
    {
        $this->dbforge->drop_table('approval_role_manage');
    }
}
