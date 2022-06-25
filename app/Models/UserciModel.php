<?php

namespace App\Models;

use CodeIgniter\Model;

class UserciModel extends Model
{
    protected $DBGroup = 'project';
    protected $table = 'user_ci';
    protected $useTimestamps = true;
}
