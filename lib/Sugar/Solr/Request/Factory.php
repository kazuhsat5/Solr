<?php

/**
 * PHP Solr Client
 *
 * @copyright Copyright (C) 2015 kazuhsat All Rights Reserved.
 */

namespace Sugar\Solr\Request;

use Sugar\Solr;
use Sugar\Solr\Transport;

/**
 * Factory
 *
 * @author kazuhsat <kazuhsat555@gmail.com>
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
     * consturctor
     *
     * @param ClientInterface $client client
     * @param TransportInterface $transport transport
     * @return void
     */
    public function __construct(Solr\ClientInterface $client,
        Transport\TransportInterface $transport)
    {
        $this->_client = $client;
        $this->_transport = $transport;
    }

    /**
     * create instance
     *
     * @param string $type request type
     * @return Factory
     */
    public function create($type)
    {
        switch ($type) {
            case 'select':
                $this->_request = new Select($this->_client, $this->_transport);
                break;
            case 'update':
                $this->_request = new Update($this->_client, $this->_transport);
                break;
            case 'ping':
                $this->_request = new Ping($this->_client, $this->_transport);
                break;
            case 'extract':
                $this->_request = new Extract($this->_client, $this->_transport);
                break;
            case 'system':
                $this->_request = new System($this->_client, $this->_transport);
                break;
            default:
                throw new RequestException(sprintf('invalid type. [type=%s]', $type));
        }

        // using method chain
        return $this;
    }

    /**
     * execute request
     *
     * @param mixed $arg argument
     * @return array
     */
    public function exec($arg)
    {
        return $this->_request->exec($arg);
    }
}
