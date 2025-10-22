<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_approver_user_role extends CI_Migration {

    public function up()
    {
        $sql = "CREATE TABLE `approver_user_role` (`id` int(11) NOT NULL AUTO_INCREMENT, `name` varchar(100) NOT NULL, `type` enum('approver','reviewer','verifier') DEFAULT 'approver', `forward_type` enum('only_forward','forward_backward','multi_forward','multi_forward_backward') DEFAULT 'only_forward', `process_type` varchar(255) DEFAULT NULL, `sl` int(11) DEFAULT 1, `status` tinyint(1) DEFAULT 1, `remarks` varchar(255) DEFAULT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $this->db->query($sql);
    }

    public function down()
    {
        $this->dbforge->drop_table('approver_user_role');
    }
}
