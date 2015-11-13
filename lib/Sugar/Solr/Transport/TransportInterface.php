<?php

namespace Sugar\Solr\Transport;

/**
 * トランスポートインターフェース
 *
 * @author kazuhsat <kazuhsat@gmail.com>
 */
interface TransportInterface
{
    /**
     * 実行
     *
     * @param string $url URL
     * @return array
     */
    public static function exec($url);
}
