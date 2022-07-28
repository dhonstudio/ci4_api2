<?php

namespace App\Models;

use CodeIgniter\Model;

class LandingPageWebModel extends Model
{
    protected $DBGroup = 'project';
    protected $table = 'landing_page_web';
    protected $useTimestamps = true;
    protected $primaryKey = 'id_web';
    protected $allowedFields = ['webKey', 'webName'];
    protected $validationRules = [
        'webKey' => 'required',
        'webName' => 'required',
    ];
}
