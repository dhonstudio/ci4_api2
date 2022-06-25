<?php

namespace App\Libraries;

class DhonRequest
{
    /**
     * CURL request.
     */
    protected $client;

    public function __construct()
    {
        $this->client   = \Config\Services::curlrequest();
    }

    /**
     * Request CURL to an URL.
     * 
     * @param string $url
     * 
     * @return mixed
     */
    public function curl(string $url)
    {
        return json_decode($this->client->get($url)->getJSON());
    }
}
