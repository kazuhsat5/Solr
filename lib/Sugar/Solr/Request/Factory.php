<?php

/**
 * PHP Solr Client
 *
 * @copyright Copyright (C) 2015 kazuhsat All Rights Reserved.
 */

namespace Sugar\Solr\Request;

/**
 * Factory
 *
 * @author kazuhsat <kazuhsat@gmail.com>
 */
class Factory implements FactoryInterface
{
    /**
     * client
     *
     * @var
     */
    private $_client;

    /**
     * transport
     *
     * @var
     */
    private $_transport;

    /**
     * request
     *
     * @var
     */
    private $_request;

    /**
     * constructor
     *
     * @param ClientInterface    $client    client
     * @param TransportInterface $transport transport
     * @return void
     */
    public function __construct(Solr\ClientInterface $client, Transport\TransportInterface $transport)
    {
        $this->_client    = $client;
        $this->_transport = $transport = $transport;
    }

    /**
     * create
     *
     * @param string $name request name
     * @return RequestInterface
     * @throws RequestException
     */
    public function create($name)
    {
        $class = ucfirst($name);
        if (!class_exists($class)) {
            throw new RequestException(sprintf('class not found. [class=%s]', $name));
        }

        return new $class($this->_client, $this->_transport);
    }
}
