<?php

namespace App\Controllers;

use App\Models\LandingPageContentModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class LandingPageContent extends BaseController
{
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $this->dhonresponse->model = new LandingPageContentModel();

        $this->dhonresponse->basic_auth = true;
    }

    public function getAllByKey()
    {
        $this->dhonresponse->sort = true;
        $this->dhonresponse->method = 'GETALL';
        $this->dhonresponse->column = 'webKey';
        $this->dhonresponse->collect();
    }

    public function getAll()
    {
        $this->dhonresponse->collect();
    }

    public function edit()
    {
        $this->dhonresponse->method = 'PUT';
        $this->dhonresponse->collect();
    }
}
