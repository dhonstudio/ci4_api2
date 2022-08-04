<?php

namespace App\Controllers;

use App\Models\LandingPagePageModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class LandingPagePage extends BaseController
{
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $this->dhonresponse->model = new LandingPagePageModel();

        $this->dhonresponse->basic_auth = true;
    }

    public function getAllByKey()
    {
        $this->dhonresponse->sort = true;
        $this->dhonresponse->method = 'GETALL';
        $this->dhonresponse->column = 'webKey';
        $this->dhonresponse->collect();
    }

    public function getByKey()
    {
        $this->dhonresponse->method = 'GET';
        $this->dhonresponse->column = 'pageKey';
        $this->dhonresponse->collect();
    }

    public function getAll()
    {
        $this->dhonresponse->collect();
    }
}
