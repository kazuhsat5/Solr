<?php

namespace Sugar\Solr\Request;

use Sugar\Solr;

/**
 * ファクトリインターフェース
 *
 * @author kazuhsat <kazuhsat555@gmail.com>
 */
interface FactoryInterface
{
    /**
     * リクエスト
     *
     * @param ClientInterface $client クライアントインスタンス
     * @param string $type リクエストタイプ
     * @param array $query クエリ
     * @return array
     */
    public function request($type, Solr\ClientInterface $client, $query);
}
