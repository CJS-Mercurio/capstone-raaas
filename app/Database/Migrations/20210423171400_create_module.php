<?php namespace App\Database\Migrations;

class CreateModule extends \CodeIgniter\Database\Migration {

        public function up()
        {
                $this->forge->addField([
                        'id'          => [
                                'type'           => 'BIGINT',
                                'unsigned'       => TRUE,
                                'auto_increment' => TRUE
                        ],
                        'module_name'       => [
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
                $this->forge->createTable('module');
        }

        public function down()
        {
                $this->forge->dropTable('module');
        }
}