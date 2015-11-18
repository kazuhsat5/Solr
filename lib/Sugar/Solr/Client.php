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
        return $this->_request('update', $document);
    }

    /**
     * ヘルスチェック
     *
     * @return array
     * @throws ClientException
     */
    public function ping()
    {
        return $this->_request('update', []);
    }

    /**
     * バイナリファイルのアップロード
     *
     * @return array
     * @throws ClientException
     */
    public function extract()
    {
        return $this->_request('extract', []);
    }

    /**
     * スレッドダンプ
     *
     * @return array
     * @throws ClientException
     */
    public function threads()
    {
        return $this->_request('threads', []);
    }

    /**
     * システム情報
     *
     * @return array
     * @throws ClientException
     */
    public function system()
    {
        return $this->_request('system', []);
    }

    /**
     * リクエスト
     *
     * @param string $type リクエスト
     * @param mixed $query クエリ配列
     * @return void
     * @throws ClientException
     */
    private function _request($type, $query)
    {
        try {
            switch ($type) {
                case 'select':
                    $request = new Request\Select($this, new Transport\Curl());
                    break;
                case 'update':
                    $request = new Request\Update($this, new Transport\Curl());
                    break;
                case 'ping':
                    $request = new Request\Ping($this, new Transport\Curl());
                    break;
                case 'extract':
                    $request = new Request\Extract($this, new Transport\Curl());
                    break;
                case 'threads':
                    $request = new Request\Threads($this, new Transport\Curl());
                    break;
                case 'system':
                    $request = new Request\System($this, new Transport\Curl());
            }

            return $request->exec($query);
        } catch (Exception $e) {
            // すべての例外をClientExceptionに統一
            throw new ClientException($e->getMessage());
        }
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
