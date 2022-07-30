<?php

namespace App\Models;

use CodeIgniter\Model;

class WebAdminModel extends Model
{
    protected $DBGroup = 'project';
    protected $table = 'web_admin';
    protected $useTimestamps = true;
    protected $primaryKey = 'id_user';
    protected $preventDuplicate = 'username';
    protected $allowedFields = ['username', 'fullName', 'password_hash', 'auth_key'];
    protected $validationRules = [
        'username' => 'required',
        'fullName' => 'required',
        'password_hash' => 'required',
        'auth_key' => 'required',
    ];
}
