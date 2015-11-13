<?php

namespace Sugar\Solr;

use Sugar\Solr\Request;
use Sugar\Solr\Transport;

/**
 * クライアントクラス
 *
 * @author kazuhsat <kazuhsat@gmail.com>
 */
class Client implements ClientInterface
{
    /**
     * ホスト名
     *
     * @var
     */
    private $_host;

    /**
     * ポート番号
     *
     * @var
     */
    private $_port;

    /**
     * コア名
     *
     * @var
     */
    private $_core;

    /**
     * コンストラクタ
     *
     * @param string $host ホスト名
     * @param string $core コア名
     * @param integer $port ポート番号(デフォルトで8983)
     * @return void
     */
    public function __construct($host, $core, $port = 8983)
    {
        $this->_host = $host;
        $this->_core = $core;
        $this->_port = $port;
    }

    /**
     * ドキュメントの検索
     *
     * @param array $query クエリ配列
     */
    public function select(array $query)
    {
        $this->_request('select', $query);
    }

    /**
     * リクエスト
     *
     * @param string $type リクエスト
     * @param array $query クエリ配列
     * @return void
     */
    private function _request($type, array $query)
    {
        switch ($type) {
            case 'select':
                $request = new Request\Select($this, new Transport\Curl());
            break;
        }

        $request->exec($query);
    }

    // getter
    public function getHost()
    {
        return $this->_host;
    }
    public function getPort()
    {
        return $this->_port;
    }
    public function getCore()
    {
        return $this->_core;
    }
}
