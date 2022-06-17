<?php

namespace App\Models;

use CodeIgniter\Model;

class ApilogModel extends Model
{
    protected $table = 'api_log';
    protected $allowedFields = ['id_user', 'address', 'entity', 'session', 'endpoint', 'action', 'success', 'error', 'message', 'created_at'];
}