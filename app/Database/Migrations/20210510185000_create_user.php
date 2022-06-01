<?php namespace App\Database\Migrations;

class CreateUser extends \CodeIgniter\Database\Migration {

        public function up()
        {
                $this->forge->addField([
                          'id'          => [
                                  'type'           => 'BIGINT',
                                  'unsigned'       => TRUE,
                                  'auto_increment' => TRUE
                          ],
                         'username'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 50,
                        ],
                        'email'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 50,
                        ],

                        'password'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '60',
                        ],
                        'first_name'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '100',
                        ],
                        'middle_name'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '100',
                        ],
                        'last_name'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '100',
                        ],
                         'birthdate'       => [
                                'type'           => 'DATE',
                        ],
                         'gender'       => [
                                'type'           => 'CHAR',
                                'constraint'     => '10',
                        ],
                        'valid_id'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '100',
                        ],
                         'academic_status'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 50,
                        ],
                         'academic_year'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 50,
                        ],
                        'batch_year'       => [
                               'type'           => 'VARCHAR',
                               'constraint'     => 50,
                       ],
                         'student_number'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 50,
                        ],
                         'faculty_code'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 50,
                        ],
                         'faculty_status'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 50,
                        ],
                         'faculty_position'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 100,
                        ],
                        'role_id'       => [
                                'type'           => 'INT',
                                'constraint'     => 5,
                        ],
                        'uniid' =>[
                            'type'      => 'VARCHAR',
                            'constraint'     => 32,
                        ],
                        'status'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '10',
                        ],
                         'activation_date datetime default current_timestamp',
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
                $this->forge->createTable('user');
        }

        public function down()
        {
                $this->forge->dropTable('user');
        }
}
