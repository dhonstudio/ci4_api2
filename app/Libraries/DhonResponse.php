<?php

namespace App\Libraries;

date_default_timezone_set('Asia/Jakarta');

use App\Models\ApiaddressModel;
use App\Models\ApiendpointModel;
use App\Models\ApientityModel;
use App\Models\ApilogModel;
use App\Models\ApisessionModel;
use App\Models\ApiusersModel;
use CodeIgniter\Cookie\Cookie;
use CodeIgniter\HTTP\Response;
use DateTime;

class DhonResponse
{
    /**
     * Set authorization.
     * 
     * @var boolean
     */
    protected $basic_auth = false;

    /**
     * Initialize api_users.
     * 
     * @var int[]
     */
    protected $api_user = [
        'id_user' => 1,
        'level' => 4
    ];

    /**
     * Send a response.
     */
    protected $response;

    /**
     * Set add-on message reponse.
     * 
     * @var string
     */
    protected $message;

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
     * Connect to api_users model.
     */
    protected $apiusersModel;

    /**
     * Connect to api_address model.
     */
    protected $apiaddressModel;

    /**
     * Connect to api_entity model.
     */
    protected $apientityModel;

    /**
     * Connect to api_session model.
     */
    protected $apisessionModel;

    /**
     * Connect to api_endpoint model.
     */
    protected $apiendpointModel;

    /**
     * Connect to api_log model.
     */
    protected $apilogModel;

    /**
     * Load DhonRequest library.
     */
    protected $dhonrequest;

    /**
     * Get a request.
     */
    protected $request;

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
     * Initialize model.
     */
    public $model;

    /**
     * Set column name for id.
     * 
     * @var string
     */
    public $id;

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
        if ($this->basic_auth) $this->_basic_auth();
        else {
            $this->request  = service('request');

            if ($this->api_user['level'] > 0) {
                if ($this->method == 'GET') {
                    $value = $this->request->getGet($this->column);

                    if ($value) {
                        $result     = $this->model->where($this->column, $value)->first();

                        $this->data = $result == [] ? ["Array()"] : $result;
                    } else {
                        $this->response->setStatusCode(Response::HTTP_BAD_REQUEST);
                        $this->message = 'Require some variable to get';
                    }
                } else if ($this->method == 'POST') {
                    $data = [];
                    foreach ($this->model->allowedFields as $field) {
                        $data[$field] = $this->request->getPost($field);
                    }

                    $insert_id  = $this->model->insert($data);
                    $result     = $this->model->where($this->id, $insert_id)->first();

                    if ($result) {
                        $this->data = $result;
                    } else {
                        $this->response->setStatusCode(Response::HTTP_BAD_REQUEST);
                        $this->message = 'Require some filed to post';
                    }
                } else if ($this->method == 'PASSWORD_VERIFY') {
                    $username   = $this->request->getGet($this->username);
                    $password   = $this->request->getGet($this->password);

                    $user       = $this->model->where($this->username, $username)->first();
                    $this->data = password_verify($password, $user[$this->password]) ? true : [false];
                } else {
                    $result         = $this->model->findAll();

                    $this->total    = count($result) == 0 ? [0] : count($result);
                    $this->data     = $result == [] ? ["Array()"] : $result;
                }
            } else {
                $this->response->setStatusCode(Response::HTTP_METHOD_NOT_ALLOWED);
                $this->message = 'Authorization issue';
            }

            $this->_send();
        }
    }

    /**
     * Check authorization user.
     *
     * @return void
     */
    private function _basic_auth()
    {
        $this->apiusersModel = new ApiusersModel();

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

    /**
     * Send final response.
     *
     * @return void
     */
    private function _send()
    {
        $result['status']   = $this->response->getStatusCode();
        $result['response'] = $this->response->getReasonPhrase();
        $this->message ? $result['message'] = $this->message : false;
        $this->total ? ($result['total'] = $this->total == [0] ? 0 : $this->total) : false;
        $this->data ? ($this->data === [false] ? $result['data'] = false
            : ($result['data'] = $this->data == ["Array()"] ? [] : $this->data))
            : false;

        $this->response->setBody(json_encode($result, JSON_NUMERIC_CHECK));

        if (isset($_SERVER['HTTP_USER_AGENT'])) $this->_hit();
        $this->response->send();
    }

    /**
     * Get Hit for API requester.
     *
     * @return void
     */
    private function _hit()
    {
        $this->apiaddressModel  = new ApiaddressModel();
        $this->apientityModel   = new ApientityModel();
        $this->apisessionModel  = new ApisessionModel();
        $this->apiendpointModel = new ApiendpointModel();
        $this->apilogModel      = new ApilogModel();

        // api_address
        $ip_address =
            !empty($_SERVER["HTTP_X_CLUSTER_CLIENT_IP"]) ? $_SERVER["HTTP_X_CLUSTER_CLIENT_IP"]
            : (!empty($_SERVER["HTTP_X_CLIENT_IP"]) ? $_SERVER["HTTP_X_CLIENT_IP"]
                : (!empty($_SERVER["HTTP_CLIENT_IP"]) ? $_SERVER["HTTP_CLIENT_IP"]
                    : (!empty($_SERVER["HTTP_X_FORWARDED_FOR"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"]
                        : (!empty($_SERVER["HTTP_X_FORWARDED"]) ? $_SERVER["HTTP_X_FORWARDED"]
                            : (!empty($_SERVER["HTTP_FORWARDED_FOR"]) ? $_SERVER["HTTP_FORWARDED_FOR"]
                                : (!empty($_SERVER["HTTP_FORWARDED"]) ? $_SERVER["HTTP_FORWARDED"]
                                    : (!empty($_SERVER["REMOTE_ADDR"]) ? $_SERVER["REMOTE_ADDR"]
                                        : '::0'
                                    )))))));

        if (ENVIRONMENT !== 'development') {
            foreach (explode(',', $ip_address) as $ip) {
                $ip = trim($ip); // just to be safe

                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                    $ip_address = $ip;
                }
            }
        }

        $this->dhonrequest = new DhonRequest;

        $address    = $this->apiaddressModel->where('ip_address', $ip_address)->first();
        $id_address = empty($address) ? $this->apiaddressModel->insert([
            'ip_address'    => $ip_address,
            'ip_info'       => $this->dhonrequest->curl("http://ip-api.com/json/{$ip_address}")
        ]) : $address['id_address'];

        // api_entity
        $entity = isset($_SERVER['HTTP_USER_AGENT']) ? htmlentities($_SERVER['HTTP_USER_AGENT']) : 'REQUEST';

        $entities   = $this->apientityModel->findAll();
        $entity_key = array_search($entity, array_column($entities, 'entity'));
        $entity_av  = !empty($entities) ? ($entity_key > -1 ? $entities[$entity_key] : 0) : 0;
        $id_entity  = $entity_av === 0 ? $this->apientityModel->insert([
            'entity' => $entity,
        ]) : $entity_av['id'];

        // api_session
        $session_name   = 'DShC13v';
        $session_prefix = '__m-';
        $session_secure = false;

        if (isset($_SERVER['HTTP_USER_AGENT'])) {
            helper('text');
            helper('cookie');

            $session_value  = random_string('alnum', 32);
            $session_cookie = (new Cookie($session_name))
                ->withValue($session_value)
                ->withPrefix($session_prefix)
                ->withExpires(new DateTime('+2 hours'))
                ->withPath('/')
                ->withDomain('')
                ->withSecure($session_secure)
                ->withHTTPOnly(true)
                ->withSameSite(Cookie::SAMESITE_LAX);

            if (!get_cookie($session_prefix . $session_name) || get_cookie($session_prefix . $session_name) === '' || get_cookie($session_prefix . $session_name) === null) {
                set_cookie($session_cookie);
            } else {
                $session_value = get_cookie($session_prefix . $session_name);
            }
        } else {
            $session_value = "REQUEST";
        }

        $session   = $this->apisessionModel->where('session', $session_value)->first();
        $id_session = empty($session) ? $this->apisessionModel->insert([
            'session' => $session_value,
        ]) : $session['id_session'];

        // api_endpoint
        if ($_GET) {
            $get_join = [];
            foreach ($_GET as $key => $value) {
                array_push($get_join, $key . '=' . $value);
            }
            $get = '?' . implode('&', $get_join);
        } else {
            $get = '';
        }
        $endpoint = uri_string() . $get;

        $endpoints      = $this->apiendpointModel->where('endpoint', $endpoint)->first();
        $id_endpoint    = empty($endpoints) ? $this->apiendpointModel->insert([
            'endpoint' => $endpoint,
        ]) : $endpoints['id_endpoint'];

        // api_log
        $action = $this->method == 'GET' ? 2
            : ($this->method == 'POST' ? 3
                : ($this->method == 'PUT' ? 4
                    : ($this->method == 'DELETE' ? 5
                        : ($this->method == 'PASSWORD_VERIFY' ? 6 : 1))));

        $success    = $this->response->getStatusCode() == 200 ? 1 : 0;
        $error      = $this->response->getStatusCode() == 200 ? 0 : $this->response->getStatusCode();
        $message    = isset($this->message) ? $this->message : '';

        $this->apilogModel->insert([
            'id_user'       => $this->api_user['id_user'],
            'address'       => $id_address,
            'entity'        => $id_entity,
            'session'       => $id_session,
            'endpoint'      => $id_endpoint,
            'action'        => $action,
            'success'       => $success,
            'error'         => $error,
            'message'       => $message,
            'created_at'    => date('Y-m-d H:i:s', time())
        ]);
    }
}
