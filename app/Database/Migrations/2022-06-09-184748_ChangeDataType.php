<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ChangeDataType extends Migration
{
    public function up()
    {
        $fields = array(
            'start_date' => array(
                    'type' => 'DATE',
            ),
            'end_date' => array(
                'type' => 'DATE',
            ),
        );
        $this->forge->modifyColumn('resume_educations', $fields);
        $this->forge->modifyColumn('resume_organizational_experiences', $fields);
        $this->forge->modifyColumn('resume_work_experiences', $fields);
    }

    public function down()
    {
        //
    }
}
