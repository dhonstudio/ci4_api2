<?php

namespace App\Controllers;

use App\Libraries\DhonResponse;
use App\Models\AddressModel;
use App\Models\EntityModel;
use App\Models\HitModel;
use App\Models\PageModel;
use App\Models\SessionModel;
use App\Models\SourceModel;

class GetHit extends BaseController
{
    protected $collect;

    public function __construct()
    {
        $this->dhonresponse = new DhonResponse;
    }

    public function index()
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
