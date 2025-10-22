<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Update_tables extends CI_Migration {

    public function up()
    {
        // Update approver_user_role table
        $this->dbforge->drop_column('approver_user_role', 'forward_type');
        $this->dbforge->drop_column('approver_user_role', 'process_type');

        // Update approval_role_manage table
        $fields = array(
            'fb_type_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'after' => 'role_id'
            ),
            'type' => array(
                'type' => "ENUM('approver','reviewer','verifier')",
                'default' => 'approver',
                'after' => 'fb_type_id'
            )
        );
        $this->dbforge->add_column('approval_role_manage', $fields);
        $this->dbforge->drop_column('approval_role_manage', 'process_type');
    }

    public function down()
    {
        // Revert changes to approver_user_role table
        $fields = array(
            'forward_type' => array(
                'type' => "ENUM('only_forward','forward_backward','multi_forward','multi_forward_backward')",
                'default' => 'only_forward',
            ),
            'process_type' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            )
        );
        $this->dbforge->add_column('approver_user_role', $fields);

        // Revert changes to approval_role_manage table
        $this->dbforge->drop_column('approval_role_manage', 'fb_type_id');
        $this->dbforge->drop_column('approval_role_manage', 'type');
        $fields = array(
            'process_type' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            )
        );
        $this->dbforge->add_column('approval_role_manage', $fields);
    }
}
