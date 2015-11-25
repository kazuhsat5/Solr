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
    private $_factory

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
        $this->setHost($host);
        $this->setCore($core);
        $this->setPort($port);

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
            $this->_factory->create($name)->exec($arguments);
        } catch (Exception $e) {
            throw new ClientException($e->getMessage());
        }
    }

    public function setHost($host)
    {
        if (empty($host)) {
            throw new \InvalidArgumentException(sprintf('invalid parameter. [host=%s]', $host));
        }

        $this->_host = $host;
    }

    public function setCore($core)
    {
        if (empty($core)) {
            throw new \InvalidArgumentException(sprintf('invalid parameter. [core=%s]', $core));
        }

        $this->_core = $core;
    }

    public function setPort($port)
    {
        if (empty($port) && ctype_digit($port)) {
            throw new \InvalidArgumentException(sprintf('invalid parameter. [port=%s]', $port));
        }

        $this->_port = (int) $port;
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
