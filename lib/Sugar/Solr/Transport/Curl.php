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
var_dump($result);
        curl_close($ch);

        return $result;
    }
}
