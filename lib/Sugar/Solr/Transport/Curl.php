<?php

namespace Sugar\Solr\Transport;

/**
 * cURLクラス
 *
 * @author kazuhsat <kazuhsat@gmail.com>
 */
class Curl extends Transport
{
    /**
     * 実行
     *
     * @param string $url URL
     * @return array
     * @throw TransportException cURL実行失敗時
     */
    public static function exec($url)
    {
        $result = [];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);

        $errno = curl_error($ch);

        curl_close($ch);

        if (curl_errno($ch)) {
            throw new TransportException(sprintf('curl error.[url=%s][errno=%d]',
                $url, curl_error($ch)));
        }

        return $result;
    }
}
