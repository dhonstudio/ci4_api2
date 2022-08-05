<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LandingPageContent extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_content' => [
                'type'           => 'INT',
                'auto_increment' => true,
            ],
            'pageKey' => [
                'type'          => 'VARCHAR',
                'constraint'    => '32',
                'null'          => true,
            ],
            'contentName' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => true,
            ],
            'contentValue' => [
                'type'          => 'VARCHAR',
                'constraint'    => '5000',
                'null'          => true,
            ],
            'contentType' => [
                'type'          => 'VARCHAR',
                'constraint'    => '10',
                'null'          => true,
            ],
            'contentAccept' => [
                'type'          => 'VARCHAR',
                'constraint'    => '100',
                'null'          => true,
            ],
            'created_at' => [
                'type'          => 'DATETIME',
            ],
            'updated_at' => [
                'type'          => 'DATETIME',
            ],
        ]);
        $this->forge->addKey('id_content', true);
        $this->forge->createTable('landing_page_content');
    }

    public function down()
    {
        $this->forge->dropTable('landing_page_content');
    }
}
