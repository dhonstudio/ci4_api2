<?php

namespace App\Models;

use CodeIgniter\Model;

class HitModel extends Model
{
    protected $table = 'dhonstudio_hit';
    protected $allowedFields = ['address', 'entity', 'session', 'source', 'page', 'created_at'];
}
