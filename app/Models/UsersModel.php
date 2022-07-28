<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $DBGroup = 'project';
    protected $table = 'users';
    protected $useTimestamps = true;
    protected $primaryKey = 'id_user';
    protected $preventDuplicate = 'email';
    protected $allowedFields = ['email', 'password_hash'];
    protected $validationRules = [
        'email' => 'required',
        'password_hash' => 'required',
    ];
}
