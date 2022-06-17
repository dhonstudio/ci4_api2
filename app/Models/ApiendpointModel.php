<?php

namespace App\Models;

use CodeIgniter\Model;

class ApiendpointModel extends Model
{
    protected $table = 'api_endpoint';
    protected $allowedFields = ['endpoint'];
}
