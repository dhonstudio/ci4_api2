<?php

namespace App\Libraries;

use App\Models\ApiusersModel;
use CodeIgniter\HTTP\Response;

class DhonResponse
{
    /**
     * Connect to api_users model.
     */
    protected $apiusersModel;

    /**
     * Get a request.
     */
    protected $request;

    /**
     * Send a response.
     */
    protected $response;

    /**
     * Set authorization.
     * 
     * @var boolean
     */
    protected $basic_auth = true;

    /**
     * Initialize api_users.
     * 
     * @var mixed[]
     */
    protected $api_user = [
        'level' => 4
    ];

    /**
     * Return total result from response.
     * 
     * @var int
     */
    protected $total;

    /**
     * Return result from response.
     * 
     * @var mixed
     */
    protected $data;

    /**
     * Set add-on message reponse.
     * 
     * @var string
     */
    protected $message;

    /**
     * Initialize model.
     */
    public $model;

    /**
     * Set request method.
     * 
     * @var string
     */
    public $method;

    /**
     * Set column name to search where.
     * 
     * @var string
     */
    public $column;

    /**
     * Set username to verify password.
     * 
     * @var string
     */
    public $username;

    /**
     * Set password to verify password.
     * 
     * @var string
     */
    public $password;

    public function __construct()
    {
        $this->apiusersModel = new ApiusersModel();

        $this->request  = service('request');
        $this->response = service('response');
        $this->response->setHeader('Content-type', 'application/json');

        // Set if need custom restrictions.
        $this->response->setHeader('Access-Control-Allow-Origin', '*');

        $this->response->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Collect data from db.
     *
     * @return void
     */
    public function collect()
    {
        $this->basic_auth ? $this->_basic_auth() : false;

        if ($this->api_user['level'] > 0) {
            if ($this->method == 'GET') {
                $value      = $this->request->getGet($this->column);
                $result     = $this->model->where($this->column, $value)->first();

                $this->data = $result;
            } else if ($this->method == 'PASSWORD_VERIFY') {
                $username   = $this->request->getGet($this->username);
                $password   = $this->request->getGet($this->password);

                $user       = $this->model->where($this->username, $username)->first();
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

        $this->_send();
    }

    private function _basic_auth()
    {
        if (isset($_SERVER['PHP_AUTH_USER'])) {
            $this->api_user = $this->apiusersModel->where('username', $_SERVER['PHP_AUTH_USER'])->first();
            if ($this->api_user) {
                $match = password_verify($_SERVER['PHP_AUTH_PW'], $this->api_user['password']);
                if ($match) {
                } else {
                    $this->response->setStatusCode(Response::HTTP_UNAUTHORIZED);
                    $this->_send();
                }
            } else {
                $this->response->setStatusCode(Response::HTTP_UNAUTHORIZED);
                $this->_send();
            }
        } else {
            $this->response->setStatusCode(Response::HTTP_UNAUTHORIZED);
            $this->_send();
        }
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
        exit;
    }
}
