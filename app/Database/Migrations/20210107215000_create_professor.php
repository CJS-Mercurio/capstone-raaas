<?php namespace App\Database\Migrations;

class CreateProfessor extends \CodeIgniter\Database\Migration {

        public function up()
        {
                $this->forge->addField([
                        'id'          => [
                                'type'           => 'BIGINT',
                                'unsigned'       => TRUE,
                                'auto_increment' => TRUE
                        ],
                        'f_code'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 50,
                        ],
                        'email'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 50,
                        ],
                         'password'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '60',
                        ],
                        'f_firstname'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '100',
                        ],
                        'f_middlename'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '100',
                        ],
                        'f_lastname'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '100',
                        ],
                         'f_birthdate'       => [
                                'type'           => 'DATE',
                        ],
                        'position'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '100',
                        ],
                        'f_status'       => [
                                'type'           => 'CHAR',
                                'constraint'     => '10',
                        ],
                        'f_contact'       => [
                                'type'           => 'INT',
                                'constraint'     => 20,
                        ],
                        'uniid' =>[
                            'type'      => 'VARCHAR',
                            'constraint'     => 32,
                        ],                        
                         'created_at datetime default current_timestamp',
                         'updated_at datetime default current_timestamp on update current_timestamp',

                ]);

                $this->forge->addKey('id', TRUE);
                $this->forge->createTable('professor');
        }

        public function down()
        {
                $this->forge->dropTable('professor');
        }
}