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
                                'default'        => null,

                        ],
                        'email'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 50,
                                'default'        => null,

                        ],

                        'password'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '60',
                                'default'        => null,

                        ],
                        'first_name'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '100',
                                'default'        => null,

                        ],
                        'middle_name'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '100',
                                'default'        => null,
                        ],
                        'last_name'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '100',
                                'default'        => null,

                        ],
                         'birthdate'       => [
                                'type'           => 'DATE',
                                'default'        => null,

                        ],
                         'gender'       => [
                                'type'           => 'CHAR',
                                'constraint'     => '10',
                                'default'        => null,

                        ],
                        'valid_id'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '100',
                                'default'        => null,

                        ],
                        'academic_status'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 50,
                                'default'        => null,

                        ],
                         'academic_year'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 50,
                                'default'        => null,

                        ],
                        'batch_year'       => [
                               'type'           => 'VARCHAR',
                               'constraint'     => 50,
                               'default'        => null,

                       ],
                         'student_number'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 50,
                                'default'        => null,

                        ],
                         'faculty_code'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 50,
                                'default'        => null,

                        ],
                         'faculty_status'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 50,
                                'default'        => null,

                        ],
                         'faculty_position'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 100,
                                'default'        => null,

                        ],
                        'role_id'       => [
                                'type'           => 'INT',
                                'constraint'     => 5,
                                'default'        => null,

                        ],
                        'uniid' =>[
                            'type'      => 'VARCHAR',
                            'constraint'     => 32,
                            'default'        => null,

                        ],
                        'status'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '10',
                                'default'        => null,

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
