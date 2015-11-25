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
 * Request
 *
 * @author kazuhsat <kazuhsat@gmail.com>
 */
abstract class Request implements RequestInterface
{
    /**
     * path
     *
     * @var
     */
    protected $_path;

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
     * constructor
     *
     * @param array  $params parameters
     * @param string $data   data(default: null)
     * @return array
     */
    public function __construct(Solr\ClientInterface $client, Transport\TransportInterface $transport)
    {
        $this->_client = $client;
        $this->_transport = $transport;
    }

    /**
     * execute
     *
     * @param array $arguments arguments
     * @return array
     */
    abstract public function exec(array $arguments = []);

    /**
     * _get
     *
     * @param array $query params
     * @return array
     * @throw RequestException
     */
    protected function _get(array $params = [])
    {
        $params['wt'] = 'json';

        return json_decode($this->_transport->get($this->_createUrl($params)), true);
    }

    /**
     * _post
     *
     * @param array $params parameters
     * @param string $data post data
     * @return array
     */
    protected function _post(array $params, $header, $data)
    {
        return json_decode($this->_transport->post($this->_createUrl($params), 'Content-type:application/json', $data), true);
    }

    /**
     * create URL
     *
     * @param array $params parameters
     * @return string
     */
    private function _createUrl(array $params = [])
    {
        $url = sprintf('http://%s:%s/solr/%s/%s', $this->_client->getHost(),
            $this->_client->getPort(), $this->_client->getCore(), $this->_path);

        if (empty($params)) {
            return $url;
        }

        return $url . '?' . http_build_query($params);
    }
}
