<?php

namespace App\Models;

use CodeIgniter\Model;

class ApisessionModel extends Model
{
    protected $DBGroup = 'project';
    protected $table = 'api_session';
    protected $primaryKey = 'id_session';
    protected $allowedFields = ['session'];
}
