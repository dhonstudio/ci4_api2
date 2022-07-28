<?php

namespace App\Models;

use CodeIgniter\Model;

class ApiusersModel extends Model
{
    protected $DBGroup = 'project';
    protected $table = 'api_users';
    protected $primaryKey = 'id_user';
}
