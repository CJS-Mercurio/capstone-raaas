<?php namespace App\Database\Migrations;

class CreateDocument extends \CodeIgniter\Database\Migration {

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
                        'file'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '100',
                        ],
                        'abstract'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '5000',
                        ],

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
                        'approval_sheet'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '200',
                        ],
                        'reason_for_denial'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '100',
                        ],
                        'research_status'       => [
                                'type'           => 'INT',
                                'constraint'     => 5,
                        ],
                        'privacy'       => [
                                'type'           => 'INT',
                                'constraint'     => 5,
                        ],
                        'course_id'       => [
                                'type'           => 'INT',
                                'constraint'     => 5,
                        ],
                        'category_id'       => [
                                'type'           => 'INT',
                                'constraint'     => 5,
                        ],
                        'document_type_id'       => [
                                'type'           => 'INT',
                                'constraint'     => 5,
                        ],
                        'slugs'       => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '12',
                        ],
                        'views'       => [
                                'type'           => 'INT',
                                'constraint'     => 5,
                        ],
                        'downloads'       => [
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
                $this->forge->createTable('document');
        }

        public function down()
        {
                $this->forge->dropTable('document');
        }
}
