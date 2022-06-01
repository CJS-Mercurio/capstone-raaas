<?php namespace App\Database\Migrations;

class CreateActivityLog extends \CodeIgniter\Database\Migration {

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
                        'task_name' => [
                          'type'           => 'VARCHAR',
                          'constraint'     => '50',
                       ],
                         'detail_id' => [
                           'type'           => 'INT',
                           'constraint'     => 5,
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
                $this->forge->createTable('activity_log');
        }

        public function down()
        {
                $this->forge->dropTable('activity_log');
        }
}
