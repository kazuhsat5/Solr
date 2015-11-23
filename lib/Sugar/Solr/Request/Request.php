<?php

/**
 * PHP Solr Client
 *
 * @copyright Copyright (C) 2015 kazuhsat All Rights Reserved.
 */

namespace Sugar\Solr\Request;

use Sugar\Solr;
use Sugar\Solr\Transport;
use Sugar\Solr\Format;

/**
 * Request
 *
 * @author kazuhsat <kazuhsat@gmail.com>
 */
abstract class Request implements RequestInterface
{
    /**
     * base url
     *
     * @constant
     */
    const BASE_URL = 'http://%s:%s/solr/%s/%s';

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
     * @param array $params parameters
     * @param string $data post data(default: null)
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
     * @param array $arguments
     * @return array
     */
     /*
    public function exec(array $arguments) {
        var_dump('test');
    }
    */

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
        return $this->_transport->post($this->_createUrl($params), 'Content-type    :application/json', $data);
    }

    /**
     * create URL
     *
     * @see _decode()
     * @param array $params parameters
     * @return string JSON
     */
    private function _createUrl(array $params)
    {
        $url = sprintf(self::BASE_URL, $this->_client->getHost(),
            $this->_client->getPort(), $this->_client->getCore(), $this->_path);

        return $url . '?' . http_build_query($params);
    }
}
