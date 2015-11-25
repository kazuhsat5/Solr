<?php

/**
 * PHP Solr Client
 *
 * @copyright Copyright (C) 2015 kazuhsat All Rights Reserved.
 */

namespace Sugar\Solr\Transport;

/**
 * FileGetContents
 *
 * @author kazuhsat <kazuhsat@gmail.com>
 */
class FileGetContents implements TransportInterface
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
        $result = @file_get_contents($url);
        if (is_null($http_response_header) || count($http_response_header) > 0) {
            $status = explode(' ', $http_response_header[0]);

            throw new TransportException(sprintf('file_get_contents error. [status=%s]', $status[1]));
        }

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
        $opts['http'] = [
            'method'  => 'POST',
            'header'  => $header,
            'content' => $data
        ];

        $context = stream_context_create($opts);
        $result = @file_get_contents($url, false, $context);

        if (is_null($http_response_header) || count($http_response_header) > 0) {
            $status = explode(' ', $http_response_header[0]);

            throw new TransportException(sprintf('file_get_contents error. [status=%s]', $status[1]));
        }

        return $result;
    }
}
