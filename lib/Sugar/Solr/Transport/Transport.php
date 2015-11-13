<?php

namespace Sugar\Solr\Transport;

/**
 * トランスポート基底クラス
 *
 * @author kazuhsat <kazuhsat@gmail.com>
 */
abstract class Transport implements TransportInterface
{
    /**
     * 実行
     *
     * @param string $url URL
     * @return array
     */
    abstract public static function exec($url);
}
