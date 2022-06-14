<?php

namespace App\Libraries;

use App\Models\ApiusersModel;
use CodeIgniter\HTTP\Response;

class DhonResponse
{
    protected $apiusersModel;
    protected $request;
    protected $response;
    protected $message;
    protected $total;
    protected $data;

    public $model;
    public $method;
    public $column;
    public $password;

    public function __construct()
    {
        $this->apiusersModel    = new ApiusersModel();

        $this->request  = service('request');
        $this->response = service('response');
        $this->response->setHeader('Content-type', 'application/json');
        $this->response->setHeader('Access-Control-Allow-Origin', '*');
        $this->response->setStatusCode(Response::HTTP_OK);
    }

    public function collect()
    {
        if (isset($_SERVER['PHP_AUTH_USER'])) {
            $api_user = $this->apiusersModel->where('username', $_SERVER['PHP_AUTH_USER'])->first();
            if ($api_user) {
                $match = password_verify($_SERVER['PHP_AUTH_PW'], $api_user['password']);
                if ($match) {
                    if ($api_user['level'] > 0) {
                        if ($this->method == 'GET') {
                            $value      = $this->request->getGet($this->column);
                            $result     = $this->model->where($this->column, $value)->first();

                            $this->data = $result;
                        } else if ($this->method == 'PASSWORD_VERIFY') {
                            $value      = $this->request->getGet($this->column);
                            $password   = $this->request->getGet($this->password);

                            $user       = $this->model->where($this->column, $value)->first();
                            $this->data = password_verify($password, $user[$this->password]) ? true : [false];
                        } else {
                            $result         = $this->model->findAll();

                            $this->total    = count($result);
                            $this->data     = $result;
                        }
                    } else {
                        $this->response->setStatusCode(Response::HTTP_METHOD_NOT_ALLOWED);
                        $this->message = 'Authorization issue';
                    }
                } else {
                    $this->response->setStatusCode(Response::HTTP_UNAUTHORIZED);
                }
            } else {
                $this->response->setStatusCode(Response::HTTP_UNAUTHORIZED);
            }
        } else {
            $this->response->setStatusCode(Response::HTTP_UNAUTHORIZED);
        }

        $this->_send();
    }

    private function _send()
    {
        $result['status']   = $this->response->getStatusCode();
        $result['response'] = $this->response->getReasonPhrase();
        $this->message ? $result['message'] = $this->message : false;
        $this->total ? $result['total'] = $this->total : false;
        $this->data ? ($this->data === [false] ? $result['data'] = false : $result['data'] = $this->data) : false;

        $this->response->setBody(json_encode($result, JSON_NUMERIC_CHECK));

        $this->response->send();
    }
}
