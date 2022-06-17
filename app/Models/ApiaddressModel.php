<?php

namespace App\Models;

use CodeIgniter\Model;

class ApiaddressModel extends Model
{
    protected $table = 'api_address';
    protected $allowedFields = ['ip_address', 'ip_info'];
}
