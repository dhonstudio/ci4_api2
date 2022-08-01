<?php

namespace App\Controllers;

use App\Models\LandingPageWebModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class LandingPageWeb extends BaseController
{
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $this->dhonresponse->model = new LandingPageWebModel();

        $this->dhonresponse->basic_auth = true;

        $this->dhonresponse->effected   = [
            'landingpageweb/getAll',
        ];
    }

    public function getAllByUser()
    {
        $this->dhonresponse->sort = true;
        $this->dhonresponse->method = 'GETALL';
        $this->dhonresponse->column = 'id_user';
        $this->dhonresponse->collect();
    }

    public function getByKey()
    {
        $this->dhonresponse->method = 'GET';
        $this->dhonresponse->column = 'webKey';
        $this->dhonresponse->collect();
    }

    public function insert()
    {
        $this->dhonresponse->method = 'POST';
        $this->dhonresponse->collect();
    }
}
