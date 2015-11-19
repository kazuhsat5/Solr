<?php

namespace Sugar\Solr\Request;

use Sugar\Solr;
use Sugar\Solr\Transport;

/**
 * ファクトリインターフェース
 *
 * @author kazuhsat <kazuhsat555@gmail.com>
 */
interface FactoryInterface
{
    /**
     * インスタンス生成
     *
     * @param string $type リクエストタイプ
     * @return Factory
     */
    public function create($type);

    /**
     * リクエスト
     *
     * @param mixed $arg 引数
     * @return array
     */
    public function request($arg);
}
