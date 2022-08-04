<?php

namespace App\Models;

use CodeIgniter\Model;

class LandingPagePageModel extends Model
{
    protected $DBGroup = 'project';
    protected $table = 'landing_page_page';
    protected $useTimestamps = true;
    protected $primaryKey = 'id_page';
    protected $allowedFields = ['webKey', 'pageName'];
    protected $validationRules = [
        'webKey' => 'required',
        'pageName' => 'required',
    ];
}
