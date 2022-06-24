<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Api extends Migration
{
    // protected $DBGroup = 'api';
    //~ cant use $DBGroup, so must change $defaultGroup in Database.php

    public function up()
    {
        $this->forge->addField([
            'id_address' => [
                'type'           => 'INT',
                'auto_increment' => true,
            ],
            'ip_address' => [
                'type'          => 'VARCHAR',
                'constraint'    => '50',
                'null'          => true,
            ],
            'ip_info' => [
                'type'          => 'VARCHAR',
                'constraint'    => '1500',
                'null'          => true,
            ],
        ]);
        $this->forge->addKey('id_address', true);
        $this->forge->addKey('ip_address', false, true);
        $this->forge->createTable('api_address');

        $this->forge->addField([
            'id_endpoint' => [
                'type'           => 'INT',
                'auto_increment' => true,
            ],
            'endpoint' => [
                'type'          => 'VARCHAR',
                'constraint'    => '500',
                'null'          => true,
            ],
        ]);
        $this->forge->addKey('id_endpoint', true);
        $this->forge->addKey('endpoint', false, true);
        $this->forge->createTable('api_endpoint');

        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'auto_increment' => true,
            ],
            'entity' => [
                'type'          => 'VARCHAR',
                'constraint'    => '1000',
                'null'          => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('entity', false, true);
        $this->forge->createTable('api_entity');

        $this->forge->addField([
            'id_session' => [
                'type'           => 'INT',
                'auto_increment' => true,
            ],
            'session' => [
                'type'          => 'VARCHAR',
                'constraint'    => '100',
                'null'          => true,
            ],
        ]);
        $this->forge->addKey('id_session', true);
        $this->forge->addKey('session', false, true);
        $this->forge->createTable('api_session');

        $this->forge->addField([
            'id_user' => [
                'type'           => 'INT',
                'auto_increment' => true,
            ],
            'username' => [
                'type'          => 'VARCHAR',
                'constraint'    => '100',
            ],
            'password' => [
                'type'          => 'VARCHAR',
                'constraint'    => '200',
            ],
            'level' => [
                'type'      => 'INT',
                'default'   => 0,
            ],
            'created_at' => [
                'type'  => 'DATETIME',
            ],
            'updated_at' => [
                'type'  => 'DATETIME',
            ],
        ]);
        $this->forge->addKey('id_user', true);
        $this->forge->addKey('username', false, true);
        $this->forge->createTable('api_users');

        $this->forge->addField([
            'id_log' => [
                'type'           => 'INT',
                'auto_increment' => true,
            ],
            'id_user' => [
                'type'  => 'INT',
            ],
            'address' => [
                'type'  => 'INT',
            ],
            'entity' => [
                'type'  => 'INT',
            ],
            'session' => [
                'type'  => 'INT',
            ],
            'endpoint' => [
                'type'  => 'INT',
            ],
            'action' => [
                'type'  => 'INT',
            ],
            'success' => [
                'type'  => 'INT',
            ],
            'error' => [
                'type'  => 'INT',
            ],
            'message' => [
                'type'          => 'VARCHAR',
                'constraint'    => '200'
            ],
            'created_at' => [
                'type'      => 'DATETIME',
            ],
        ]);
        $this->forge->addKey('id_log', true);
        $this->forge->addKey('id_user');
        $this->forge->addKey('address');
        $this->forge->addKey('entity');
        $this->forge->addKey('session');
        $this->forge->addKey('endpoint');
        $this->forge->addForeignKey('id_user', 'api_users', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('address', 'api_address', 'id_address', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('entity', 'api_entity', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('session', 'api_session', 'id_session', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('endpoint', 'api_endpoint', 'id_endpoint', 'CASCADE', 'CASCADE');
        $this->forge->createTable('api_log');
    }

    public function down()
    {
        $this->forge->dropTable('api_address');
        $this->forge->dropTable('api_endpoint');
        $this->forge->dropTable('api_entity');
        $this->forge->dropTable('api_session');
        $this->forge->dropTable('api_users');
        $this->forge->dropTable('api_log');
    }
}
