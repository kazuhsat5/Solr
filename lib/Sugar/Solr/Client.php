<?php

/**
 * PHP Solr Client
 *
 * @copyright Copyright (C) 2015 kazuhsat All Rights Reserved.
 */

namespace Sugar\Solr;

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
     * transport
     *
     * @var
     */
    private $_transport;

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

        // default: cURL
        $this->_transport = new Transport\Curl();
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
            $class = 'Sugar\Solr\Request\\' . ucfirst($name);
            if (!class_exists($class)) {
                throw new ClassNotFoundException(sprintf('class not found. [class=%s]', $class));
            }

            $request = new $class($this, $this->_transport);

            return $request->exec($arguments);
        } catch (Exception $e) {
            throw new ClientException($e->getMessage());
        }
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

    public function setTransport(Transport\TransportInterface $transport)
    {
        $this->_transport = $transport;
    }
}
