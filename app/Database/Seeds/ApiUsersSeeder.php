<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ApiUsersSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username'  => 'admin',
                'password'  => password_hash('admin', PASSWORD_DEFAULT),
                'level'     => 4
            ],
            [
                'username'  => 'no_access',
                'password'  => password_hash('admin', PASSWORD_DEFAULT),
                'level'     => 0
            ],
            [
                'username'  => 'only_get',
                'password'  => password_hash('admin', PASSWORD_DEFAULT),
                'level'     => 1
            ],
            [
                'username'  => 'only_getpost',
                'password'  => password_hash('admin', PASSWORD_DEFAULT),
                'level'     => 2
            ],
            [
                'username'  => 'only_getpostput',
                'password'  => password_hash('admin', PASSWORD_DEFAULT),
                'level'     => 3
            ],
        ];

        $this->db->table('api_users')->insertBatch($data);
    }
}
