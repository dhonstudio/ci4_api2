<?php

namespace App\Controllers;

use App\Models\WebAdminModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class WebAdmin extends BaseController
{
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $this->dhonresponse->model = new WebAdminModel();

        $this->dhonresponse->basic_auth = false;
    }

    private function _crud_effect()
    {
        $effected = [
            'webadmin/getUserByUsername',
            'webadmin/getUserById',
        ];

        foreach ($effected as $key => $value) {
            $this->cache->deleteMatching(urlencode($value) . '*');
        }
    }

    public function insert()
    {
        $this->dhonresponse->method = 'POST';
        $this->dhonresponse->cache_crud = 1;
        $this->dhonresponse->id     = 'id_user';

        $this->_crud_effect();

        $this->dhonresponse->collect();
    }

    public function getUserByUsername()
    {
        $this->dhonresponse->method = 'GET';
        $this->dhonresponse->column = 'username';
        $this->dhonresponse->collect();
    }

    public function getUserById()
    {
        $this->dhonresponse->method = 'GET';
        $this->dhonresponse->column = 'id_user';
        $this->dhonresponse->collect();
    }

    public function getAllUsers()
    {
        $this->dhonresponse->basic_auth = false;
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
