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
     * コンストラクタ
     *
     * @param string $host ホスト名
     * @param string $core コア名
     * @param integer $port ポート番号(デフォルトで8983)
     * @return void
     */
    public function __construct($host, $core, $port = 8983);

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
