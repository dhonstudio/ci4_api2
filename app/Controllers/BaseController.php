<?php

namespace App\Controllers;

use Assets\Ci4_libraries\DhonRequest;
use Assets\Ci4_libraries\DhonResponse;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Git assets path.
     *
     * @var string
     */
    protected $git_assets = '/../../../assets/';

    /**
     * Enabler cache.
     *
     * @var boolean
     */
    protected $cache_on = false;

    /**
     * Enabler sqllite.
     *
     * @var boolean
     */
    protected $sqllite_on = false;

    /**
     * Dhon Studio library for connect API.
     * Run `git clone https://github.com/dhonstudio/ci4_libraries.git` in your git assets path.
     *
     * @var DhonRequest
     */
    protected $dhonrequest;

    /**
     * Dhon Studio library for send response.
     * Run `git clone https://github.com/dhonstudio/ci4_libraries.git` in your git assets path.
     *
     * @var DhonResponse
     */
    protected $dhonresponse;

    /**
     * Cache engine.
     *
     * @var \CodeIgniter\Cache\CacheInterface
     */
    protected $cache;

    /**
     * Cache name.
     *
     * @var string
     */
    protected $cache_name;

    /**
     * Cache value.
     */
    protected $cache_value;

    /**
     * SQLLite from cache engine.
     *
     * @var \CodeIgniter\Cache\CacheInterface
     */
    protected $sqllite;

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();

        $this->_initLibraries([
            'dhonrequest_version'   => "1.0.0",
            'dhonresponse_version'  => "1.0.0",
        ]);

        $this->_initCache();
        $this->_initSQLLite();
    }

    /**
     * Initialize additional libraries.
     */
    private function _initLibraries($params)
    {
        require __DIR__ . $this->git_assets . 'ci4_libraries/DhonRequest-' . $params['dhonrequest_version'] . '.php';
        $this->dhonrequest = new DhonRequest([
            'api_url'   => '',
            'api_auth'  => [],
        ]);

        require __DIR__ . $this->git_assets . 'ci4_libraries/DhonResponse-' . $params['dhonresponse_version'] . '.php';
        $this->dhonresponse = new DhonResponse();
        $this->dhonresponse->dhonrequest = $this->dhonrequest;
    }

    /**
     * Initialize cache if on.
     */
    private function _initCache()
    {
        if ($this->cache_on) {
            if ($_GET) {
                $get_join = [];
                foreach ($_GET as $key => $value) {
                    array_push($get_join, $key . '=' . $value);
                }
                $get = '?' . implode('&', $get_join);
            } else {
                $get = '';
            }
            $endpoint = urlencode(uri_string() . $get);

            $this->dhonresponse->cache_on   = $this->cache_on;
            $this->dhonresponse->cache      = $this->cache      = \Config\Services::cache();
            $this->dhonresponse->cache_name = $this->cache_name = $endpoint;
            $cache_value        = $this->cache->get($this->cache_name);
            if ($cache_value) {
                $this->dhonresponse->cache_value = $this->cache_value = $cache_value;
            }
        }
    }

    /**
     * Initialize sqllite if on.
     */
    public function _initSQLLite()
    {
        if ($this->sqllite_on) {
            $this->dhonresponse->sqllite_on = $this->sqllite_on;
            $this->dhonresponse->sqllite    = $this->sqllite    = \Config\Services::cache();
        }
    }
}
