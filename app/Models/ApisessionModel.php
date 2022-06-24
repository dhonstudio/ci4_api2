<?php

namespace App\Models;

use CodeIgniter\Model;

class ApisessionModel extends Model
{
    protected $DBGroup = 'project';
    protected $table = 'api_session';
    protected $allowedFields = ['session'];
}
