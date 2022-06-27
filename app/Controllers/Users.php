<?php

namespace App\Controllers;

use App\Libraries\DhonResponse;
use App\Models\UsersModel;

class Users extends BaseController
{
    protected $dhonresponse;

    public function __construct()
    {
        $this->dhonresponse = new DhonResponse;
        $this->dhonresponse->model = new UsersModel();
    }

    public function getAllUsers()
    {
        $this->dhonresponse->collect();
    }

    public function getUserByEmail()
    {
        $this->dhonresponse->method = 'GET';
        $this->dhonresponse->column = 'email';
        $this->dhonresponse->collect();
    }

    public function insert()
    {
        $this->dhonresponse->method = 'POST';
        $this->dhonresponse->id     = 'id_user';
        $this->dhonresponse->collect();
    }

    public function passwordVerify()
    {
        $this->dhonresponse->method     = 'PASSWORD_VERIFY';
        $this->dhonresponse->username   = 'email';
        $this->dhonresponse->password   = 'password_hash';
        $this->dhonresponse->collect();
    }
}
