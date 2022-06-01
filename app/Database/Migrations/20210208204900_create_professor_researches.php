<?php namespace App\Database\Migrations;

class CreateProfessorResearch extends \CodeIgniter\Database\Migration {

        public function up()
        {
                $this->forge->addField([
                        'id'          => [
                                'type'           => 'BIGINT',
                                'unsigned'       => TRUE,
                                'auto_increment' => TRUE
                        ],
                         'author_id'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '50',
                        ],
                        'research_id'       => [
                                'type'           => 'INT',
                                'constraint'     => 5,
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
                $this->forge->createTable('professor_research');
        }

        public function down()
        {
                $this->forge->dropTable('professor_research');
        }
}