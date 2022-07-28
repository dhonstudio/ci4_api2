<?php

namespace App\Models;

use CodeIgniter\Model;

class AddressModel extends Model
{
    protected $DBGroup = 'project';
    protected $table = 'dhonstudio_address';
    protected $primaryKey = 'id_address';
    protected $allowedFields = ['ip_address', 'ip_info'];
    protected $validationRules = [
        'ip_address' => 'required',
        'ip_info' => 'required',
    ];
}
