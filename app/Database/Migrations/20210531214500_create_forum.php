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
                        'start_posting' => [
                                'type'           => 'DATE',
                        ],
                        'end_posting' => [
                                'type'           => 'DATE',
                        ],
                        'forum_image' => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '50'
                        ],
                        'status' => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '10'
                        ],
                        'details' => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '300'

                        ],
                        'location' => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '300'

                        ],
                        'parameter' => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '300'

                        ],
                        'reason_for_disapproval' => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '300'

                        ],
                        'submitted_name' => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '100'

                        ],
                        'submitted_id' => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '10'

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
