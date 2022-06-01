<?php namespace App\Database\Migrations;

class CreateStudents extends \CodeIgniter\Database\Migration {

        public function up()
        {
                $this->forge->addField([
                        'id'          => [
                                'type'           => 'BIGINT',
                                'unsigned'       => TRUE,
                                'auto_increment' => TRUE
                        ],
                        'student_number'       => [
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
                        //  'year'       => [
                        //         'type'           => 'INT',
                        //         'constraint'     => 10,
                        // ],
                        'course_id'       => [
                                'type'           => 'INT',
                                'constraint'     => 5,
                        ],
                        'academic_status'       => [
                                'type'           => 'CHAR',
                                'constraint'     => '10',
                        ],
                        'batch_year'       => [
                                'type'           => 'INT',
                                'constraint'     => 10,
                        ],
                          'branch_id'       => [
                                'type'           => 'INT',
                                'constraint'     => 10,
                        ],
                        'uniid' =>[
                            'type'      => 'VARCHAR',
                            'constraint'     => 32,
                        ],
                'activation_date datetime default current_timestamp',                          
                         'created_at datetime default current_timestamp',
                         'updated_at datetime default current_timestamp on update current_timestamp',

                ]);

                $this->forge->addKey('id', TRUE);
                $this->forge->createTable('student');
        }

        public function down()
        {
                $this->forge->dropTable('student');
        }
}