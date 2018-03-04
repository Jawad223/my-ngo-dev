<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Table3 extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'user_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'primary_key' => TRUE,
                'auto_increment' => TRUE,
                'unsigned' => TRUE,
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '30',
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'cnic' => array(
                'type' => 'VARCHAR',
                'constraint' => '13',
            ),
            'dob' => array(
                'type' => 'DATE'
            ),
            'cell' => array(
                'type' => 'VARCHAR',
                'constraint' => '11',
            ),
            'pin' => array(
                'type' => 'VARCHAR',
                'constraint' => '4',
            ),
            'address' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'gender' => array(
                'type' => 'VARCHAR',
                'constraint' => '6',
            ),
            'user_status' => array(
                'type' => 'BOOLEAN',
            ),
            'delete_flag' => array(
                'type' => 'BOOLEAN',
                'default' => FALSE,
            ),
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'modified_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ));
        $this->dbforge->add_key('user_id', TRUE);
        $this->dbforge->create_table('user', TRUE);

        $this->dbforge->add_field(array(
            'role_id' => array(
                'type' => 'INT',
                'constraint' => '5',
                'primary_key' => TRUE,
                'auto_increment' => TRUE
            ),
            'role_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '15',
            ),
            'delete_flag' => array(
                'type' => 'BOOLEAN',
                'default' => FALSE,
            ),
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'modified_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ));
        $this->dbforge->add_key('role_id', TRUE);
        $this->dbforge->create_table('role', TRUE);

        $this->dbforge->add_field(array(
            'status_id' => array(
                'type' => 'INT',
                'constraint' => '5',
                'auto_increment' => TRUE,
                'primary_key' => TRUE,
            ),
            'status' => array(
                'type' => 'VARCHAR',
                'constraint' => '15',
            ),
            'delete_flag' => array(
                'type' => 'BOOLEAN',
                'default' => FALSE,
            ),
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'modified_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ));
        $this->dbforge->add_key('status_id', TRUE);
        $this->dbforge->create_table('status', TRUE);

        $this->dbforge->add_field(array(
            'donation_id' => array(
                'type' => 'INT',
                'constraint' => '5',
                'auto_increment' => TRUE,
                'primary_key' => TRUE,
            ),
            'subject' => array(
                'type' => 'VARCHAR',
                'constraint' => '30',
            ),
            'description' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
            ),
            'file' => array(
                'type' => 'VARCHAR',
                'constraint' => '30',
            ),
            'donated_as' => array(
                'type' => 'INT',
                'constraint' => '1',
            ),
            'category_id' => array(
                'type' => 'INT',
                'constraint' => '1',
            ),
            'measurement_id' => array(
                'type' => 'INT',
                'constraint' => '1',
            ),
            'status_id' => array(
                'type' => 'INT',
                'constraint' => '1',
            ),
            'user_id' => array(
                'type' => 'INT',
                'constraint' => '1',
            ),
            'delete_flag' => array(
                'type' => 'BOOLEAN',
                'default' => FALSE,
            ),
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'modified_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ));
        $this->dbforge->add_key('donation_id', TRUE);
        $this->dbforge->create_table('donation', TRUE);

        $this->dbforge->add_field(array(
            'reception_id' => array(
                'type' => 'INT',
                'constraint' => '5',
                'auto_increment' => TRUE,
                'primary_key' => TRUE,
            ),
            'subject' => array(
                'type' => 'VARCHAR',
                'constraint' => '30',
            ),
            'description' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
            ),
            'requested_as' => array(
                'type' => 'INT',
                'constraint' => '1',
            ),
            'reference_id' => array(
                'type' => 'INT',
                'constraint' => '1'
            ),
            'category_id' => array(
                'type' => 'INT',
                'constraint' => '1',
            ),
            'measurement_id' => array(
                'type' => 'INT',
                'constraint' => '1',
            ),
            'status_id' => array(
                'type' => 'INT',
                'constraint' => '1',
            ),
            'user_id' => array(
                'type' => 'INT',
                'constraint' => '1',
            ),
            'delete_flag' => array(
                'type' => 'BOOLEAN',
                'default' => FALSE,
            ),
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'modified_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ));
        $this->dbforge->add_key('reception_id', TRUE);
        $this->dbforge->create_table('reception', TRUE);

        $this->dbforge->add_field(array(
            'control_id' => array(
                'type' => 'INT',
                'constraint' => '5',
                'primary_key' => TRUE,
                'auto_increment' => TRUE
            ),
            'control_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '30',
            ),
            'control_url' => array(
                'type' => 'VARCHAR',
                'constraint' => '30',
            ),
            'delete_flag' => array(
                'type' => 'BOOLEAN',
                'default' => FALSE,
            ),
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'modified_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ));
        $this->dbforge->add_key('control_id', TRUE);
        $this->dbforge->create_table('control', TRUE);

        $this->dbforge->add_field(array(
            'category_id' => array(
                'type' => 'INT',
                'constraint' => '5',
                'primary_key' => TRUE,
                'auto_increment' => TRUE
            ),
            'category_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '30',
            ),
            'parent_category_id' => array(
                'type' => 'INT',
                'constraint' => '1',
            ),
            'measurement_unit_id' => array(
                'type' => 'INT',
                'constraint' => '1',
            ),
            'delete_flag' => array(
                'type' => 'BOOLEAN',
                'default' => FALSE,
            ),
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'modified_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ));
        $this->dbforge->add_key('category_id', TRUE);
        $this->dbforge->create_table('category', TRUE);

        $this->dbforge->add_field(array(
            'measurement_id' => array(
                'type' => 'INT',
                'constraint' => '5',
                'primary_key' => TRUE,
                'auto_increment' => TRUE
            ),
            'measurement_unit' => array(
                'type' => 'VARCHAR',
                'constraint' => '30',
            ),
            'delete_flag' => array(
                'type' => 'BOOLEAN',
                'default' => FALSE,
            ),
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'modified_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ));
        $this->dbforge->add_key('measurement_id', TRUE);
        $this->dbforge->create_table('measurement', TRUE);

        $this->dbforge->add_field(array(
            'rc_id' => array(
                'type' => 'INT',
                'constraint' => '5',
                'primary_key' => TRUE,
                'auto_increment' => TRUE
            ),
            'role_id' => array(
                'type' => 'INT',
                'constraint' => '1',
            ),
            'control_id' => array(
                'type' => 'INT',
                'constraint' => '1',
            ),
            'delete_flag' => array(
                'type' => 'BOOLEAN',
                'default' => FALSE,
            ),
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'modified_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ));
        $this->dbforge->add_key('rc_id', TRUE);
        $this->dbforge->create_table('role_control', TRUE);

        $this->dbforge->add_field(array(
            'reference_id' => array(
                'type' => 'INT',
                'constraint' => '5',
                'primary_key' => TRUE,
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '30',
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '30',
            ),
            'user_id' => array(
                'type' => 'INT',
                'constraint' => '1'
            ),
            'delete_flag' => array(
                'type' => 'BOOLEAN',
                'default' => FALSE,
            ),
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'modified_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ));
        $this->dbforge->add_key('reference_id', TRUE);
        $this->dbforge->create_table('reference', TRUE);

        $this->dbforge->add_field(array(
            'ur_id' => array(
                'type' => 'INT',
                'constraint' => '5',
                'primary_key' => TRUE,
                'auto_increment' => TRUE
            ),
            'role_id' => array(
                'type' => 'INT',
                'constraint' => '1'
            ),
            'user_id' => array(
                'type' => 'INT',
                'constraint' => '1',
            ),
            'delete_flag' => array(
                'type' => 'BOOLEAN',
                'default' => FALSE,
            ),
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'modified_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ));
        $this->dbforge->add_key('ur_id', TRUE);
        $this->dbforge->create_table('user_role', TRUE);

        $this->dbforge->add_field(array(
            'notification_id' => array(
                'type' => 'INT',
                'constraint' => '5',
                'primary_key' => TRUE,
                'auto_increment' => TRUE
            ),
            'subject' => array(
                'type' => 'VARCHAR',
                'constraint' => '30',
            ),
            'description' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'viewed' => array(
                'type' => 'BOOLEAN',
                'default' => FALSE,
            ),
            'user_id' => array(
                'type' => 'INT',
                'constraint' => '1',
            ),
            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'modified_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ));
        $this->dbforge->add_key('notification_id', TRUE);
        $this->dbforge->create_table('notification', TRUE);
    }

    public function down() {
        $this->dbforge->drop_table('user');
        $this->dbforge->drop_table('role');
        $this->dbforge->drop_table('status');
        $this->dbforge->drop_table('donation');
        $this->dbforge->drop_table('reception');
        $this->dbforge->drop_table('category');
        $this->dbforge->drop_table('control');
        $this->dbforge->drop_table('role_control');
        $this->dbforge->drop_table('measurement');
        $this->dbforge->drop_table('reference');
        $this->dbforge->drop_table('user_role');
        $this->dbforge->drop_table('notification');
    }

}