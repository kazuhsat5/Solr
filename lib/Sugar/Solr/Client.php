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
     * リクエストファクトリインスタンス
     *
     * @var
     */
    private $_factory;

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

        // リクエストファクトリインスタンス生成
        $this->_factory = new Request\RequestFactory(new Transport\Curl());
    }

    /**
     * ドキュメントの検索
     *
     * @param array $query クエリ配列
     * @return array
     * @throws ClientException
     */
    public function select(array $query)
    {
        return $this->_factory->request('select', $this, $query);
    }

    /**
     * ドキュメントの追加・更新
     *
     * @param string $document ドキュメント(XML, JSON文字列)
     * @return array
     * @throws ClientException
     */
    public function update($document)
    {
    }

    /**
     * ヘルスチェック
     *
     * @return array
     * @throws ClientException
     */
    public function ping()
    {
    }

    /**
     * バイナリファイルのアップロード
     *
     * @return array
     * @throws ClientException
     */
    public function extract()
    {
    }

    /**
     * スレッドダンプ
     *
     * @return array
     * @throws ClientException
     */
    public function threads()
    {
    }

    /**
     * システム情報
     *
     * @return array
     * @throws ClientException
     */
    public function system()
    {
    }

    // accessor
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
