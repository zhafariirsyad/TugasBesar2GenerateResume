<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnsToResumePersonalInformationsTable extends Migration
{
    public function up()
    {
        $fields = [
            'profession' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'address' => [
                'type' => 'TEXT',
                'null' => true,
            ]
        ];

        $this->forge->addColumn('resume_personal_informations', $fields);
    }

    public function down()
    {
        //
    }
}
