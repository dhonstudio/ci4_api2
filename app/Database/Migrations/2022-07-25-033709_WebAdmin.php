<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class WebAdmin extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_user' => [
                'type'           => 'INT',
                'auto_increment' => true,
            ],
            'username' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
            ],
            'fullName' => [
                'type'          => 'VARCHAR',
                'constraint'    => '200',
            ],
            'auth_key' => [
                'type'          => 'VARCHAR',
                'constraint'    => '32',
            ],
            'password_hash' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
            ],
            'password_reset_token' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
                'null'          => true,
            ],
            'status' => [
                'type'          => 'SMALLINT',
                'constraint'    => '6',
                'default'       => '10',
            ],
            'created_at' => [
                'type'          => 'DATETIME',
            ],
            'updated_at' => [
                'type'          => 'DATETIME',
            ],
            'verification_token' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
                'null'          => true,
            ],
            'google_id' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => true,
            ],
            'google_name' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
                'null'          => true,
            ],
            'google_picture' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
                'null'          => true,
            ],
            'google_gender' => [
                'type'          => 'VARCHAR',
                'constraint'    => '20',
                'null'          => true,
            ],
            'google_link' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
                'null'          => true,
            ],
            'fb_id' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => true,
            ],
            'fb_name' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
                'null'          => true,
            ],
            'fb_picture' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
                'null'          => true,
            ],
        ]);
        $this->forge->addKey('id_user', true);
        $this->forge->addKey('username', false, true);
        $this->forge->createTable('web_admin');
    }

    public function down()
    {
        $this->forge->dropTable('web_admin');
    }
}
