<?php namespace App\Database\Migrations;

class CreateUserFavorite extends \CodeIgniter\Database\Migration {

        public function up()
        {
                $this->forge->addField([
                        'id'          => [
                                'type'           => 'BIGINT',
                                'unsigned'       => TRUE,
                                'auto_increment' => TRUE
                        ],
                         'user_id' => [
                                'type'           => 'INT',
                                'constraint'     => 5,
                        ],
                        'document_id' => [
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
                $this->forge->createTable('user_favorite');
        }

        public function down()
        {
                $this->forge->dropTable('user_favorite');
        }
}
