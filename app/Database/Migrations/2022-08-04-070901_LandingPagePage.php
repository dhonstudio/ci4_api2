<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LandingPagePage extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_page' => [
                'type'           => 'INT',
                'auto_increment' => true,
            ],
            'webKey' => [
                'type'          => 'VARCHAR',
                'constraint'    => '32',
                'null'          => true,
            ],
            'pageKey' => [
                'type'          => 'VARCHAR',
                'constraint'    => '32',
                'null'          => true,
            ],
            'pageName' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => true,
            ],
            'created_at' => [
                'type'          => 'DATETIME',
            ],
            'updated_at' => [
                'type'          => 'DATETIME',
            ],
        ]);
        $this->forge->addKey('id_page', true);
        $this->forge->addKey('pageKey', false, true);
        $this->forge->createTable('landing_page_page');
    }

    public function down()
    {
        //
    }
}
