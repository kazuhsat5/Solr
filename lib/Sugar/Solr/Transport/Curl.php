<?php

namespace Sugar\Solr\Transport;

/**
 * cURL
 *
 * @author kazuhsat <kazuhsat@gmail.com>
 */
class Curl implements TransportInterface
{
    /**
     * execute
     *
     * @param string $url URL
     * @return array
     * @throw TransportException
     */
    public static function exec($url)
    {
        $result = [];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);

        curl_close($ch);

        return $result;
    }
}
