<?php namespace App\Database\Migrations;

class CreateCourseSchedule extends \CodeIgniter\Database\Migration {

        public function up()
        {
                $this->forge->addField([
                        'id'          => [
                                'type'           => 'BIGINT',
                                'unsigned'       => TRUE,
                                'auto_increment' => TRUE
                        ],
                         'course_id' => [
                                'type'           => 'INT',
                                'constraint'     => 5,
                        ],
                        'schedule' => [
                               'type'           => 'VARCHAR',
                               'constraint'     => '100',
                               'default'        => null,
                               
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
                $this->forge->createTable('course_schedule');
        }

        public function down()
        {
                $this->forge->dropTable('course_schedule');
        }
}
