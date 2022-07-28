<?php

namespace App\Models;

use CodeIgniter\Model;

class SourceModel extends Model
{
    protected $DBGroup = 'project';
    protected $table = 'dhonstudio_source';
    protected $primaryKey = 'id_source';
    protected $allowedFields = ['source'];
    protected $validationRules = [
        'source' => 'required',
    ];
}
