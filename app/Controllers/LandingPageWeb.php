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
        $this->landingPageWebModel = new LandingPageWebModel();

        $this->dhonresponse->basic_auth = false;
    }

    private function _crud_effect()
    {
        $effected = [
            'landingpageweb/getAll',
        ];

        foreach ($effected as $key => $value) {
            $this->cache->deleteMatching(urlencode($value) . '*');
        }
    }

    public function getAll()
    {
        if (!$this->cache_value) {
            $data = $this->landingPageWebModel->orderBy('created_at', 'DESC')->findAll();
            $this->total = count($data) == 0 ? [0] : count($data);
            $this->dhonresponse->data = $data == [] ? "Array()" : $data;
        }

        $this->dhonresponse->send();
        $this->dhonresponse->collect();
    }

    public function insert()
    {
        $this->dhonresponse->method = 'POST';
        $this->dhonresponse->cache_crud = 1;
        $this->dhonresponse->id     = 'id_web';

        $this->_crud_effect();

        $this->dhonresponse->collect();
    }
}
