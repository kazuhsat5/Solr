<?php

namespace Sugar\Solr;

use Sugar\Solr\Request;

/**
 * クライアントインターフェース
 *
 * @author kazuhsat <kazuhsat@gmail.com>
 */
interface ClientInterface
{
    /**
     * ドキュメントの検索
     *
     * @param array $query クエリ配列
     */
    public function select(array $query);

    // getter
    public function getHost();
    public function getPort();
    public function getCore();
}
