<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Hit extends Migration
{
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
        $this->forge->createTable('dhonstudio_address');

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
        $this->forge->createTable('dhonstudio_entity');

        $this->forge->addField([
            'id_page' => [
                'type'           => 'INT',
                'auto_increment' => true,
            ],
            'page' => [
                'type'          => 'VARCHAR',
                'constraint'    => '100',
                'null'          => true,
            ],
        ]);
        $this->forge->addKey('id_page', true);
        $this->forge->addKey('page', false, true);
        $this->forge->createTable('dhonstudio_page');

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
        $this->forge->createTable('dhonstudio_session');

        $this->forge->addField([
            'id_source' => [
                'type'           => 'INT',
                'auto_increment' => true,
            ],
            'source' => [
                'type'          => 'VARCHAR',
                'constraint'    => '200',
                'null'          => true,
            ],
        ]);
        $this->forge->addKey('id_source', true);
        $this->forge->addKey('source', false, true);
        $this->forge->createTable('dhonstudio_source');

        $this->forge->addField([
            'id_hit' => [
                'type'           => 'INT',
                'auto_increment' => true,
            ],
            'address' => [
                'type'  => 'INT',
                'null'  => true,
            ],
            'entity' => [
                'type'  => 'INT',
                'null'  => true,
            ],
            'session' => [
                'type'  => 'INT',
                'null'  => true,
            ],
            'source' => [
                'type'  => 'INT',
                'null'  => true,
            ],
            'page' => [
                'type'  => 'INT',
                'null'  => true,
            ],
            'stamp' => [
                'type'  => 'INT',
            ],
            'created_at' => [
                'type'      => 'DATETIME',
            ],
        ]);
        $this->forge->addKey('id_hit', true);
        $this->forge->addKey('address');
        $this->forge->addKey('entity');
        $this->forge->addKey('session');
        $this->forge->addKey('source');
        $this->forge->addKey('page');
        $this->forge->addForeignKey('address', 'dhonstudio_address', 'id_address', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('entity', 'dhonstudio_entity', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('session', 'dhonstudio_session', 'id_session', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('source', 'dhonstudio_source', 'id_source', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('page', 'dhonstudio_page', 'id_page', 'CASCADE', 'CASCADE');
        $this->forge->createTable('dhonstudio_hit');
    }

    public function down()
    {
        $this->forge->dropTable('dhonstudio_address');
        $this->forge->dropTable('dhonstudio_entity');
        $this->forge->dropTable('dhonstudio_session');
        $this->forge->dropTable('dhonstudio_source');
        $this->forge->dropTable('dhonstudio_page');
        $this->forge->dropTable('dhonstudio_hit');
    }
}
