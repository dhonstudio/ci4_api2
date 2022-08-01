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

        $this->dhonresponse->model      = new WebAdminModel();

        $this->dhonresponse->basic_auth = true;

        $this->dhonresponse->effected   = [
            'webadmin/getUserByUsername',
        ];
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

    public function insert()
    {
        $this->dhonresponse->method = 'POST';
        $this->dhonresponse->collect();
    }
}
