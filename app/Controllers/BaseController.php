<?php

namespace App\Controllers;

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
     * git assets path
     *
     * @var string
     */
    protected $git_assets = ENVIRONMENT == 'development' ? '/../../../assets/'
        : (ENVIRONMENT == 'testing' ? '/../../../../../assets/' : '/../../../../assets/');

    protected $dhonresponse;

    protected $cache;
    protected $cache_name;
    protected $cache_value;

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();

        require __DIR__ . $this->git_assets . 'ci4_libraries/DhonRequest.php';
        require __DIR__ . $this->git_assets . 'ci4_libraries/DhonResponse.php';
        $this->dhonresponse = new DhonResponse;

        //~ cache
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

        $this->cache        = $this->dhonresponse->cache        = \Config\Services::cache();
        $this->cache_name   = $this->dhonresponse->cache_name   = $endpoint;
        $cache_value        = $this->cache->get($this->cache_name);
        if ($cache_value) {
            $this->cache_value = $this->dhonresponse->cache_value = $cache_value;
        }
    }
}
