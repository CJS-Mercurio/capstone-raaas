<?php namespace App\Database\Migrations;

class CreatePanel extends \CodeIgniter\Database\Migration {

        public function up()
        {
                $this->forge->addField([
                        'id'          => [
                                'type'           => 'BIGINT',
                                'unsigned'       => TRUE,
                                'auto_increment' => TRUE
                        ],
                         'first_name' => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '50',
                        ],
                        'middle_name' => [
                               'type'           => 'VARCHAR',
                               'constraint'     => '50',
                         ],
                          'last_name' => [
                                 'type'           => 'VARCHAR',
                                 'constraint'     => '50',
                         ],
                         'occupation' => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '50',
                         ],
                         'company' => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '50',
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
                $this->forge->createTable('panel');
        }

        public function down()
        {
                $this->forge->dropTable('panel');
        }
}
