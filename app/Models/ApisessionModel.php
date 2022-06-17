<?php

namespace App\Models;

use CodeIgniter\Model;

class ApisessionModel extends Model
{
    protected $table = 'api_session';
    protected $allowedFields = ['session'];
}
