<?php namespace App\Database\Migrations;

class CreateResearch extends \CodeIgniter\Database\Migration {

        public function up()
        {
                $this->forge->addField([
                        'id'          => [
                                'type'           => 'BIGINT',
                                'unsigned'       => TRUE,
                                'auto_increment' => TRUE
                        ],
                        'title'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '100',
                        ],
                        'abstract'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '350',
                        ],
                        // 'file'       => [
                        //         'type'           => 'VARCHAR',
                        //         'constraint'     => '200',
                        // ],
                        //  'approval_sheet'       => [
                        //         'type'           => 'VARCHAR',
                        //         'constraint'     => '200',
                        // ],
                        'keywords'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '250',
                        ],
                         'school_year'       => [
                                 'type'           => 'VARCHAR',
                                 'constraint'     => '50',
                        ],
                          'defense_date'       => [
                                'type'           => 'DATE',
                        ],
                        'date_submitted'       => [
                                'type'           => 'DATE',
                        ],
                        'adviser'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '50',
                        ],
                        'director'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '50',
                        ],
                        'paper_type'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '50',
                        ],
                        'file'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '255',
                        ],

                        'reason_for_denial'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '100',
                        ],
                        'research_status'       => [
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
                $this->forge->createTable('research');
        }

        public function down()
        {
                $this->forge->dropTable('research');
        }
}