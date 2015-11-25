<?php

/**
 * PHP Solr Client
 *
 * @copyright Copyright (C) 2015 kazuhsat All Rights Reserved.
 */

namespace Sugar\Solr\Transport;

/**
 * TransportInterface
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
     * @throws TransportException
     */
    public static function get($url);

    /**
     * post
     *
     * @param string $url    URL
     * @param string $header header
     * @param string $data   data
     * @return array
     * @throws InvalidParameterException
     * @throws TransportException
     */
    public static function post($url, $header, $data);
}
