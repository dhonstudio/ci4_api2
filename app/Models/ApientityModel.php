<?php

namespace App\Models;

use CodeIgniter\Model;

class ApientityModel extends Model
{
    protected $table = 'api_entity';
    protected $allowedFields = ['entity'];
}
