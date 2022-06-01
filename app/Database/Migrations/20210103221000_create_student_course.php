<?php namespace App\Database\Migrations;

class CreateStudentCourse extends \CodeIgniter\Database\Migration {

        public function up()
        {
                $this->forge->addField([
                        'id'          => [
                                'type'           => 'BIGINT',
                                'unsigned'       => TRUE,
                                'auto_increment' => TRUE
                        ],
                        'student_id'       => [
                                'type'           => 'BIGINT',
                                'constraint'     => '20',
                        ],
                        'course_id'       => [
                                'type'           => 'BIGINT',
                                'constraint'     => '20',
                        ],                  
                         'created_at datetime default current_timestamp',
                         'updated_at datetime default current_timestamp on update current_timestamp',
                        'deleted_at' => [
                                'type'           => 'DATETIME',
                                'null'           => true,
                                'default'        => null,
                                'comment'        => 'Date of soft deletion',
                        ]

                ]);

                $this->forge->addKey('id', TRUE);
                $this->forge->createTable('student_course');
        }

        public function down()
        {
                $this->forge->dropTable('student_course');
        }
}