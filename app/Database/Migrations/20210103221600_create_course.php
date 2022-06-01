<?php namespace App\Database\Migrations;

class CreateCourse extends \CodeIgniter\Database\Migration {

        public function up()
        {
                $this->forge->addField([
                        'id'          => [
                                'type'           => 'BIGINT',
                                'unsigned'       => TRUE,
                                'auto_increment' => TRUE
                        ],
                        'course_name'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 50,
                        ],
                        'abbreviate'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 60,
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
                $this->forge->createTable('course');
        }

        public function down()
        {
                $this->forge->dropTable('course');
        }
}