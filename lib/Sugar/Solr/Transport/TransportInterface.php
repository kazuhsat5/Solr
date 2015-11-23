<?php

/**
 * PHP Solr Client
 *
 * @copyright Copyright (C) 2015 kazuhsat All Rights Reserved.
 */

namespace Sugar\Solr\Transport;

/**
 * Transport Interface
 *
 * @author kazuhsat <kazuhsat@gmail.com>
 */
interface TransportInterface
{
    /**
     * get
     *
     * @param string $url URL
     * @return array
     */
    public function get($url);

    /**
     * post
     *
     * @param string $url URL
     * @param string $header header
     * @param string $data data
     * @return array
     * @throw InvalidParameterException
     */
    public function post($url, $header = null, $data = null);
}
