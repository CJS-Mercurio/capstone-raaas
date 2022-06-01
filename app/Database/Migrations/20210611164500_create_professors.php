<?php namespace App\Database\Migrations;

class CreateProfessors extends \CodeIgniter\Database\Migration {

        public function up()
        {
                $this->forge->addField([
                        'id'          => [
                                'type'           => 'BIGINT',
                                'unsigned'       => TRUE,
                                'auto_increment' => TRUE
                        ],
                         'facultycode' => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 5,
                        ],
                          'firstname' => [
                                 'type'           => 'VARCHAR',
                                 'constraint'     => '50',
                         ],
                         'middlename' => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '50',
                                'default'        => null,
                        ],
                        'lastname' => [
                               'type'           => 'VARCHAR',
                               'constraint'     => '50',
                        ],
                        'birthdate' => [
                               'type'           => 'date',
                        ],
                        'position' => [
                               'type'           => 'VARCHAR',
                               'constraint'     => '50',
                        ],
                        'status' => [
                               'type'           => 'VARCHAR',
                               'constraint'     => '50',
                        ],
                        'gender' => [
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
                $this->forge->createTable('professors');
        }

        public function down()
        {
                $this->forge->dropTable('professors');
        }
}
