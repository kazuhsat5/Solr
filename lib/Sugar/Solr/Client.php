<?php

namespace Sugar\Solr;

use Sugar\Solr\Request;
use Sugar\Solr\Transport;
use Sugar\Solr\Format;

/**
 * クライアントクラス
 * Solrクライアントサービス(ファサード)クラス
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
     * コア名
     *
     * @var
     */
    private $_core;

    /**
     * ポート番号
     *
     * @var
     */
    private $_port;

    /**
     * ファクトリインスタンス
     *
     * @var
     */
    private $_factory;

    /**
     * コンストラクタ
     *
     * @param string $host ホスト名
     * @param string $core コア名
     * @param integer $port ポート番号(デフォルト:8983)
     * @return void
     */
    public function __construct($host, $core, $port = 8983)
    {
        $this->_host = $host;
        $this->_core = $core;
        $this->_port = $port;

        $this->_factory = new Request\Factory($this, new Transport\Curl());
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
        return $this->_request('select', $query);
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
        return $this->_request('ping');
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
     * システム情報
     *
     * @return array
     * @throws ClientException
     */
    public function system()
    {
        return $this->_request('system');
    }

    /**
     * リクエスト
     *
     * @param string $type タイプ
     * @param array $query クエリ配列
     * @return array
     * @throws ClientException
     */
    private function _request($type, $query = [])
    {
        try {
            // SolrレスポンスをJSON形式で受け取りPHP配列で返却
            $query['wt'] = 'json';
            $this->_factory->create($type);
            return Format\Json::decode($this->_factory->request($query));
        } catch (Exception $e) {
            // 例外集約
            throw new ClientException($e->getMessage());
        }
    }

    public function getHost()
    {
        return $this->_host;
    }

    public function getCore()
    {
        return $this->_core;
    }

    public function getPort()
    {
        return (int) $this->_port;
    }

    public function setFactory(Request\FactoryInterface $factory)
    {
        $this->_factory = $factory;
    }
}
