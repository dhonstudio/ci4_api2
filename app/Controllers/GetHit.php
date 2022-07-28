<?php

namespace App\Controllers;

use Assets\Ci4_libraries\DhonRequest;
use App\Models\AddressModel;
use App\Models\EntityModel;
use App\Models\HitModel;
use App\Models\PageModel;
use App\Models\SessionModel;
use App\Models\SourceModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class GetHit extends BaseController
{
    protected $dhonrequest;
    protected $request;
    protected $addressModel;
    protected $entityModel;
    protected $sessionModel;
    protected $sourceModel;
    protected $pageModel;
    protected $hitModel;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $this->addressModel = new AddressModel();
        $this->entityModel  = new EntityModel();
        $this->sessionModel = new SessionModel();
        $this->sourceModel  = new SourceModel();
        $this->pageModel    = new PageModel();
        $this->hitModel     = new HitModel();
    }

    public function index()
    {
        $address = $this->request->getPost('address');
        $addresses = $this->addressModel->where('ip_address', $address)->first();
        $id_address = $addresses ? $addresses['id_address'] : $this->addressModel->insert(['ip_address' => $address, 'ip_info' => $this->dhonrequest->curl("http://ip-api.com/json/{$address}")]);

        $entity = $this->request->getPost('entity');
        $entities = $this->entityModel->where('entity', $entity)->first();
        $id_entity = $entities ? $entities['id'] : $this->entityModel->insert(['entity' => $entity]);

        $session = $this->request->getPost('session');
        $sessions = $this->sessionModel->where('session', $session)->first();
        $id_session = $sessions ? $sessions['id_session'] : $this->sessionModel->insert(['session' => $session]);

        $source = $this->request->getPost('source');
        $sources = $this->sourceModel->where('source', $source)->first();
        $id_source = $sources ? $sources['id_source'] : $this->sourceModel->insert(['source' => $source]);

        $page = $this->request->getPost('page');
        $pages = $this->pageModel->where('page', $page)->first();
        $id_page = $pages ? $pages['id_page'] : $this->pageModel->insert(['page' => $page]);

        $this->hitModel->insert([
            'address' => $id_address,
            'entity' => $id_entity,
            'session' => $id_session,
            'source' => $id_source,
            'page' => $id_page,
            'created_at' => $this->request->getPost('created_at')
        ]);
    }
}
