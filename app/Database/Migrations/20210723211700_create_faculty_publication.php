<?php namespace App\Database\Migrations;

class CreateFacultyPublication extends \CodeIgniter\Database\Migration {

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
                        'research_title' => [
                               'type'           => 'VARCHAR',
                               'constraint'     => '100',
                               'default'        => null,

                       ],
                         'publication' => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '100',
                                'default'        => null,

                        ],
                         'volume' => [
                               'type'           => 'VARCHAR',
                               'constraint'     => '50',
                               'default'        => null,

                         ],
                         'institute' => [
                               'type'           => 'VARCHAR',
                               'constraint'     => '100',
                               'default'        => null,

                         ],
                          'date_published' => [
                                 'type'           => 'DATE',
                                 'default'        => null,

                         ],
                         'abstract' => [
                               'type'           => 'VARCHAR',
                               'constraint'     => '5000',
                               'default'        => null,

                         ],
                         'school_year' => [
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
                $this->forge->createTable('faculty_publication');
        }

        public function down()
        {
                $this->forge->dropTable('faculty_publication');
        }
}
