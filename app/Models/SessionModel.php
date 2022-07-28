<?php

namespace App\Models;

use CodeIgniter\Model;

class SessionModel extends Model
{
    protected $DBGroup = 'project';
    protected $table = 'dhonstudio_session';
    protected $primaryKey = 'id_session';
    protected $allowedFields = ['session'];
    protected $validationRules = [
        'session' => 'required',
    ];
}
