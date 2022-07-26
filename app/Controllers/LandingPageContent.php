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

        $this->dhonresponse->basic_auth = false;
    }

    private function _crud_effect()
    {
        $effected = [
            'landingpagecontent/',
        ];

        foreach ($effected as $key => $value) {
            $this->cache->deleteMatching(urlencode($value) . '*');
        }
    }

    public function insert()
    {
        $this->dhonresponse->method = 'POST';
        $this->dhonresponse->cache_crud = 1;
        $this->dhonresponse->id     = 'id_content';

        $this->_crud_effect();

        $this->dhonresponse->collect();
    }
}
