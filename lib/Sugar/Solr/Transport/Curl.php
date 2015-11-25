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
     * @throws TransportException
     */
    public static function get($url)
    {
        $result = [];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);

        $errno = curl_errno($ch);
        if ($errno !== 0) {
            curl_close($ch);
            throw new TransportException(sprintf('curl error. [errno=%s]', $errno));
        }

        curl_close($ch);

        return $result;
    }

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
    public static function post($url, $header, $data)
    {
        if (empty($header)) {
            throw new InvalidParameterException(sprintf('invalid parameter. [header=%s]', $header));
        }

        if (empty($data)) {
            throw new InvalidParameterException(sprintf('invalid parameter. [data=%s]', $data));
        }

        $result = [];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array($header));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $result = curl_exec($ch);

        $errno = curl_errno($ch);
        if ($errno !== 0) {
            curl_close($ch);
            throw new TransportException(sprintf('curl error. [errno=%s]', $errno));
        }

        curl_close($ch);

        return $result;
    }
}
