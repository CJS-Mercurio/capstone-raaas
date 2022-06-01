<?php namespace App\Database\Migrations;

class CreateFacultySeminar extends \CodeIgniter\Database\Migration {

        public function up()
        {
                $this->forge->addField([
                        'id'          => [
                                'type'           => 'BIGINT',
                                'unsigned'       => TRUE,
                                'auto_increment' => TRUE
                        ],
                        'faculty_id' => [
                               'type'           => 'INT',
                               'constraint'     => 5,
                        ],
                        'event_title' => [
                               'type'           => 'VARCHAR',
                               'constraint'     => '100',
                       ],
                         'sponsor' => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '100',
                        ],
                         'venue' => [
                               'type'           => 'VARCHAR',
                               'constraint'     => '50',
                         ],
                          'date_attended' => [
                                 'type'           => 'DATE',
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
                $this->forge->createTable('faculty_seminar');
        }

        public function down()
        {
                $this->forge->dropTable('faculty_seminar');
        }
}
