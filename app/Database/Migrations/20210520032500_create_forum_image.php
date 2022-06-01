<?php namespace App\Database\Migrations;

class CreateForumImage extends \CodeIgniter\Database\Migration {

        public function up()
        {
                $this->forge->addField([
                        'id'          => [
                                'type'           => 'BIGINT',
                                'unsigned'       => TRUE,
                                'auto_increment' => TRUE
                        ],
                         'forum_id' => [
                                'type'           => 'INT',
                                'constraint'     => 5,
                        ],
                        'image' => [
                               'type'           => 'VARCHAR',
                               'constraint'     => '50',
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
                $this->forge->createTable('forum_image');
        }

        public function down()
        {
                $this->forge->dropTable('forum_image');
        }
}
