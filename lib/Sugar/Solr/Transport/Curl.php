<?php

/**
 * PHP Solr Client
 *
 * @copyright Copyright (C) 2015 kazuhsat All Rights Reserved.
 */

namespace Sugar\Solr\Transport;

/**
 * cURL
 *
 * @author kazuhsat <kazuhsat@gmail.com>
 */
class Curl implements TransportInterface
{
    /**
     * get
     *
     * @param string $url URL
     * @return array
     * @throw TransportException
     */
    public function get($url)
    {
        $result = [];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);

        curl_close($ch);

        return $result;
    }

    /**
     * post
     *
     * @param string $url URL
     * @return array
     * @throw TransportException
     */
    public function post($url, $header = null, $data = null)
    {
        if (empty($header)) {
            throw new InvalidParameterException('');
        }

        if (empty($data)) {
            throw new InvalidParameterException('');
        }

        $result = [];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array($header));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $result = curl_exec($ch);

        curl_close($ch);

        return $result;
    }
}
