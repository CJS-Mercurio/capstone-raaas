<?php namespace App\Database\Migrations;

class CreateActivityLogDetail extends \CodeIgniter\Database\Migration {

        public function up()
        {
                $this->forge->addField([
                        'id'          => [
                                'type'           => 'BIGINT',
                                'unsigned'       => TRUE,
                                'auto_increment' => TRUE
                        ],
                        'reference' => [
                               'type'           => 'VARCHAR',
                               'constraint'     => '100',
                               'comment'        => 'Document or Forum ID',

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
                $this->forge->createTable('activity_log_detail');
        }

        public function down()
        {
                $this->forge->dropTable('activity_log_detail');
        }
}
