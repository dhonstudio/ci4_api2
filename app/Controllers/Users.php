<?php

namespace App\Controllers;

use App\Models\UsersModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Users extends BaseController
{
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $this->dhonresponse->model = new UsersModel();
    }

    public function getAllUsers()
    {
        $this->dhonresponse->basic_auth = false;
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
