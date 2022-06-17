<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ResumeOrganizationalExperience extends Migration
{
    public function up()
    {
        $fields = [
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'position' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true
            ],
            'organization_name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true
            ],
            'start_date' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'end_date' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'untill_now' => [
                'type'           => 'ENUM',
                'constraint'     => ['yes', 'no'],
                'default'        => 'no',
            ],
            'about' => [
                'type' => 'TEXT',
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ]
        ];
        $this->forge->addField($fields);
        //primary key
        $this->forge->addKey('id', TRUE);
        //nama tabel
        $this->forge->createTable('resume_organizational_experiences');
    }

    public function down()
    {
        //
    }
}
