<?php

namespace App\Models;

use CodeIgniter\Model;

class LandingPageContentModel extends Model
{
    protected $DBGroup = 'project';
    protected $table = 'landing_page_content';
    protected $useTimestamps = true;
    protected $primaryKey = 'id_content';
    protected $allowedFields = ['pageKey', 'contentName', 'contentValue'];
    protected $validationRules = [
        'pageKey' => 'required',
        'contentName' => 'required',
        'contentValue' => 'required',
    ];
}
