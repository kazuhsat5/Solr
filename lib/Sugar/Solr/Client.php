<?php

/**
 * PHP Solr Client
 *
 * @copyright Copyright (C) 2015 kazuhsat All Rights Reserved.
 */

namespace Sugar\Solr;

use Sugar\Solr\Request;
use Sugar\Solr\Transport;

/**
 * Client Class
 *
 * @author kazuhsat <kazuhsat@gmail.com>
 */
class Client implements ClientInterface
{
    /**
     * host
     *
     * @var
     */
    private $_host;

    /**
     * core
     *
     * @var
     */
    private $_core;

    /**
     * port
     *
     * @var
     */
    private $_port;

    /**
     * request
     *
     * @var
     */
    private $_request;

    /**
     * constructor
     *
     * @param string $host host
     * @param string $core core
     * @param integer $port port (default: 8983)
     * @return void
     */
    public function __construct($host, $core, $port = 8983)
    {
        $this->_host = $host;
        $this->_core = $core;
        $this->_port = $port;

        $this->_request = new Request\Factory($this, new Transport\Curl());
    }

    /**
     * __call
     *
     * @param string $name method
     * @param array $arguments arguments
     * @return array
     * @throws ClientException
     */
    public function __call($name, $arguments)
    {
        try {
            $arguments[0]['wt'] = 'json';

            return json_decode($this->_getData($name, $arguments[0]), true);
        } catch (Exception $e) {
            throw new ClientException($e->getMessage());
        }
    }

    /**
     * get data
     *
     * @param string $reuqest request
     * @param mixed $params parameters
     * @return array
     * @throws RequestException
     */
    private function _getData($request, $params)
    {
        return $this->_request->create($request)->exec($params);
    }

    public function getHost()
    {
        return $this->_host;
    }

    public function getCore()
    {
        return $this->_core;
    }

    public function getPort()
    {
        return (int) $this->_port;
    }

    public function setFactory(Request\FactoryInterface $factory)
    {
        $this->_factory = $factory;
    }
}
