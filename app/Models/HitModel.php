<?php

namespace App\Models;

use CodeIgniter\Model;

class HitModel extends Model
{
    protected $DBGroup = 'project';
    protected $table = 'dhonstudio_hit';
    protected $primaryKey = 'id_hit';
    protected $allowedFields = ['address', 'entity', 'session', 'source', 'page', 'created_at'];
    protected $validationRules = [
        'address' => 'required',
        'entity' => 'required',
        'session' => 'required',
        'source' => 'required',
        'page' => 'required',
        'created_at' => 'required',
    ];
}
