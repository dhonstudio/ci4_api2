<?php

namespace App\Models;

use CodeIgniter\Model;

class LandingPageContentModel extends Model
{
    protected $DBGroup = 'project';
    protected $table = 'landing_page_content';
    protected $useTimestamps = true;
    protected $primaryKey = 'id_content';
    protected $allowedFields = ['webKey', 'contentName', 'contentValue'];
    protected $validationRules = [
        'webKey' => 'required',
        'contentName' => 'required',
        'contentValue' => 'required',
    ];
}
