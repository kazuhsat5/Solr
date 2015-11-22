<?php

/**
 * PHP Solr Client
 *
 * @copyright Copyright (C) 2015 kazuhsat All Rights Reserved.
 */

namespace Sugar\Solr;

use Sugar\Solr\Request;
use Sugar\Solr\Transport;
use Sugar\Solr\Format;

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
     * request factory
     *
     * @var
     */
    private $_request;

    /**
     * format
     *
     * @var
     */
    private $_format;

    /**
     * constructor
     *
     * @param string $host host
     * @param string $core core
     * @param integer $port port (default: 8983)
     * @param string $format format
     * @return void
     */
    public function __construct($host, $core, $port = 8983, $format = 'json')
    {
        $this->_host = $host;
        $this->_core = $core;
        $this->_port = $port;

        $this->_request = new Request\Factory($this, new Transport\Curl());

        $this->_format = $format;
    }

    /**
     * __call
     *
     * @param string $name method
     * @param array $arguments argumetns
     * @return array
     * @throws ClientException
     */
    public function __call($name, $arguments)
    {
        try {
            $arguments[0]['wt'] = $this->_format;

            return $this->_decode($this->_getData($name, $arguments[0]));
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

    /**
     * decode
     *
     * @param string $data data
     * @return array
     * @throws FormatException
     */
    private function _decode($data)
    {
        $class = 'Sugar\Solr\Format\\' . ucfirst($this->_format);
        if (!class_exists($class)) {
            throw new ClassNotFoundException(sprintf('class not found.[class=%s]', $class));
        }

        return $class::decode($data);
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

    public function setFormat($format)
    {
        $this->_format = $format;
    }
}
