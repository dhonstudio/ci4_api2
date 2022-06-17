<?php

namespace App\Controllers;

use App\Libraries\DhonResponse;
use App\Models\ApiaddressModel;
use App\Models\ApientityModel;

class ApiLog extends BaseController
{
    protected $collect;

    public function __construct()
    {
        $this->dhonresponse = new DhonResponse;
    }

    public function getAllApiAddresses()
    {
        $this->dhonresponse->model = new ApiaddressModel();
        $this->dhonresponse->collect();
    }

    public function postApiAddress()
    {
        $this->dhonresponse->model  = new ApiaddressModel();
        $this->dhonresponse->method = 'POST';
        $this->dhonresponse->id     = 'id_address';
        $this->dhonresponse->collect();
    }

    public function getAllApiEntities()
    {
        $this->dhonresponse->model = new ApientityModel();
        $this->dhonresponse->collect();
    }

    public function postApiEntity()
    {
        $this->dhonresponse->model  = new ApientityModel();
        $this->dhonresponse->method = 'POST';
        $this->dhonresponse->id     = 'id';
        $this->dhonresponse->collect();
    }
}
