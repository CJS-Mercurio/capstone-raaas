<?php namespace App\Database\Migrations;

class CreateAdminConfig extends \CodeIgniter\Database\Migration {

        public function up()
        {
                $this->forge->addField([
                        'id'          => [
                                'type'           => 'BIGINT',
                                'unsigned'       => TRUE,
                                'auto_increment' => TRUE
                        ],
                         'school_year' => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '100',
                        ],
                        'current_director' => [
                                'type'           => 'TEXT',
                                'constraint'     => '100',
                        ],
                         'created_at datetime default current_timestamp',
                         'updated_at datetime default current_timestamp on update current_timestamp',
                         'deleted_at' => [
                                'type'           => 'DATETIME',
                                'null'           => true,
                                'default'        => null,
                                'comment'        => 'Date of soft deletion',
                        ],

                ]);

                $this->forge->addKey('id', TRUE);
                $this->forge->createTable('admin_config');
        }

        public function down()
        {
                $this->forge->dropTable('admin_config');
        }
}