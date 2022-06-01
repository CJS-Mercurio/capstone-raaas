<?php namespace App\Database\Migrations;

class CreateForum extends \CodeIgniter\Database\Migration {

        public function up()
        {
                $this->forge->addField([
                        'id'          => [
                                'type'           => 'BIGINT',
                                'unsigned'       => TRUE,
                                'auto_increment' => TRUE
                        ],
                         'title' => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '100',
                        ],
                        'date' => [
                                'type'           => 'DATE',
                        ],
                        'time' => [
                               'type'           => 'VARCHAR',
                               'constraint'     => '100',
                        ],
                        'event_type' => [
                              'type'           => 'VARCHAR',
                              'constraint'     => '100',
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
                $this->forge->createTable('forum');
        }

        public function down()
        {
                $this->forge->dropTable('forum');
        }
}
