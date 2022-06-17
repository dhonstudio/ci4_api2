<?php

namespace App\Models;

use CodeIgniter\Model;

class AddressModel extends Model
{
    protected $table = 'dhonstudio_address';
    protected $allowedFields = ['ip_address', 'ip_info'];
}
