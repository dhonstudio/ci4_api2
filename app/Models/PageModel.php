<?php

namespace App\Models;

use CodeIgniter\Model;

class PageModel extends Model
{
    protected $DBGroup = 'project';
    protected $table = 'dhonstudio_page';
    protected $primaryKey = 'id_page';
    protected $allowedFields = ['page'];
    protected $validationRules = [
        'page' => 'required',
    ];
}
