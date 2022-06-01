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
                   'student_number' => [
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
                  ],
                  'lastname' => [
                         'type'           => 'VARCHAR',
                         'constraint'     => '50',
                  ],
                  'gender' => [
                         'type'           => 'VARCHAR',
                         'constraint'     => '50',
                  ],
                  'birthdate' => [
                         'type'           => 'date',
                  ],
                  'academic_status' => [
                         'type'           => 'VARCHAR',
                         'constraint'     => '50',
                  ],
                  'course_id' => [
                         'type'           => 'INT',
                         'constraint'     => '5',
                  ],
                  'user_id' => [
                         'type'           => 'INT',
                         'constraint'     => '5',
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
          $this->forge->createTable('students');
        }

        public function down()
        {
                $this->forge->dropTable('students');
        }
}
