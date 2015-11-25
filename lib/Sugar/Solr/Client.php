<?php

/**
 * PHP Solr Client
 *
 * @copyright Copyright (C) 2015 kazuhsat All Rights Reserved.
 */

namespace Sugar\Solr;

use Sugar\Solr\Transport;

/**
 * Client
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
     * factory
     *
     * @var
     */
    private $_factory;

    /**
     * constructor
     *
     * @param string  $host host
     * @param string  $core core
     * @param integer $port port (default: 8983)
     * @return void
     * @throws InvalidArgumentException
     */
    public function __construct($host, $core, $port = 8983)
    {
        $this->_host = $host;
        $this->_core = $core;
        $this->_port = $port;
        if (empty($host) || empty($core) || empty($port)) {
            throw new \InvalidArgumentException('invalid parameter.');
        }

        $this->_factory = new Request\Factory($this, new Transport\Curl());
    }

    /**
     * __call
     *
     * @param string $name      method
     * @param array  $arguments arguments
     * @return array
     * @throws ClientException
     */
    public function __call($name, $arguments)
    {
        try {
            return $this->_factory->create($name)->exec($arguments);
        } catch (Exception $e) {
            throw new ClientException($e->getMessage());
        }
    }

    public function setFactory(Request\FactoryInterface $factory)
    {
        $this->_factory = $factory;
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
}
