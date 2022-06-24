<?php

namespace App\Models;

use CodeIgniter\Model;

class PageModel extends Model
{
    protected $DBGroup = 'project';
    protected $table = 'dhonstudio_page';
    protected $allowedFields = ['page'];
    protected $validationRules = [
        'page' => 'required',
    ];
}
