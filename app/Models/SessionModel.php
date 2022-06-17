<?php

namespace App\Models;

use CodeIgniter\Model;

class SessionModel extends Model
{
    protected $table = 'dhonstudio_session';
    protected $allowedFields = ['session'];
}
