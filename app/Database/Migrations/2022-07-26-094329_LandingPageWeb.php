<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LandingPageWeb extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_web' => [
                'type'           => 'INT',
                'auto_increment' => true,
            ],
            'id_user' => [
                'type'           => 'INT',
            ],
            'webKey' => [
                'type'          => 'VARCHAR',
                'constraint'    => '32',
                'null'          => true,
            ],
            'webName' => [
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
        $this->forge->addKey('id_web', true);
        $this->forge->addKey('id_user');
        $this->forge->addForeignKey('id_user', 'web_admin', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->createTable('landing_page_web');
    }

    public function down()
    {
        //
    }
}
