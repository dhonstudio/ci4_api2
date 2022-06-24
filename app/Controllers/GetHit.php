<?php

namespace App\Controllers;

use App\Libraries\DhonRequest;
use App\Libraries\DhonResponse;
use App\Models\AddressModel;
use App\Models\EntityModel;
use App\Models\HitModel;
use App\Models\PageModel;
use App\Models\SessionModel;
use App\Models\SourceModel;

class GetHit extends BaseController
{
    protected $dhonresponse;
    protected $dhonrequest;
    protected $request;
    protected $addressModel;
    protected $entityModel;
    protected $sessionModel;
    protected $sourceModel;
    protected $pageModel;
    protected $hitModel;

    public function __construct()
    {
        $this->dhonresponse = new DhonResponse;
        $this->dhonrequest  = new DhonRequest;
        $this->request      = service('request');

        $this->addressModel = new AddressModel();
        $this->entityModel  = new EntityModel();
        $this->sessionModel = new SessionModel();
        $this->sourceModel  = new SourceModel();
        $this->pageModel    = new PageModel();
        $this->hitModel     = new HitModel();
    }

    public function curl(string $url)
    {
        return json_decode($this->client->get($url)->getJSON());
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

    public function postHit()
    {
        $this->dhonresponse->model  = new HitModel();
        $this->dhonresponse->method = 'POST';
        $this->dhonresponse->id     = 'id_hit';
        $this->dhonresponse->collect();
    }

    public function getAddressByIP()
    {
        $this->dhonresponse->model = new AddressModel();
        $this->dhonresponse->method = 'GET';
        $this->dhonresponse->column = 'ip_address';
        $this->dhonresponse->collect();
    }

    public function postAddress()
    {
        $this->dhonresponse->model  = new AddressModel();
        $this->dhonresponse->method = 'POST';
        $this->dhonresponse->id     = 'id_address';
        $this->dhonresponse->collect();
    }

    public function getAllEntities()
    {
        $this->dhonresponse->model = new EntityModel();
        $this->dhonresponse->collect();
    }

    public function postEntity()
    {
        $this->dhonresponse->model  = new EntityModel();
        $this->dhonresponse->method = 'POST';
        $this->dhonresponse->id     = 'id';
        $this->dhonresponse->collect();
    }

    public function getSessionByCookie()
    {
        $this->dhonresponse->model = new SessionModel();
        $this->dhonresponse->method = 'GET';
        $this->dhonresponse->column = 'session';
        $this->dhonresponse->collect();
    }

    public function postSession()
    {
        $this->dhonresponse->model  = new SessionModel();
        $this->dhonresponse->method = 'POST';
        $this->dhonresponse->id     = 'id_session';
        $this->dhonresponse->collect();
    }

    public function getSourceByReferer()
    {
        $this->dhonresponse->model = new SourceModel();
        $this->dhonresponse->method = 'GET';
        $this->dhonresponse->column = 'source';
        $this->dhonresponse->collect();
    }

    public function postSource()
    {
        $this->dhonresponse->model  = new SourceModel();
        $this->dhonresponse->method = 'POST';
        $this->dhonresponse->id     = 'id_source';
        $this->dhonresponse->collect();
    }

    public function getPageByUri()
    {
        $this->dhonresponse->model = new PageModel();
        $this->dhonresponse->method = 'GET';
        $this->dhonresponse->column = 'page';
        $this->dhonresponse->collect();
    }

    public function postPage()
    {
        $this->dhonresponse->model  = new PageModel();
        $this->dhonresponse->method = 'POST';
        $this->dhonresponse->id     = 'id_page';
        $this->dhonresponse->collect();
    }
}
