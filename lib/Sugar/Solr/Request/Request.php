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
     * @param Client $client Client
     * @param Transport $transport Transport
     * @return void
     */
    public function __construct(Solr\Client $client, Transport\Transport $transport)
    {
        $this->_client = $client;
        $this->_transport = $transport;
    }

    /**
     * exec
     *
     * @param array $query params
     * @return mixed
     * @throw RequestException
     */
    public function exec(array $params)
    {
    var_dump($params);
        var_dump($this->_createUrl($params));
        $result = $this->_transport->exec($this->_createUrl($params));
        if ($result === false) {
            throw new RequestException(printf('failed getting response.[url=%s]', $url));
        }

        return $result;
    }

    /**
     * create URL
     *
     * @see _decode()
     * @param array $params parameters
     * @return string JSON
     */
    protected function _createUrl(array $params)
    {
        $url = sprintf(self::BASE_URL, $this->_client->getHost(),
            $this->_client->getPort(), $this->_client->getCore(), $this->_path);

        return $url . '?' . http_build_query($params);
    }
}
