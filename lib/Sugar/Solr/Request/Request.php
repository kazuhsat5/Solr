<?php

namespace Sugar\Solr\Request;

use Sugar\Solr;
use Sugar\Solr\Transport;
use Sugar\Solr\Format;

/**
 * リクエスト基底クラス
 *
 * @author kazuhsat <kazuhsat@gmail.com>
 */
abstract class Request implements RequestInterface
{
    /**
     * リクエスト名
     *
     * @var
     */
    protected $_request;

    /**
     * クライアントインスタンス
     *
     * @var
     */
    protected $_client;

    /**
     * トランスポートインタスタンス
     *
     * @var
     */
    private $_transport;

    /**
     * コンストラクタ
     *
     * @param Client $client Clientクラス
     * @return void
     */
    public function __construct(Solr\Client $client, Transport\Transport $transport)
    {
        $this->_client = $client;

        $this->_transport = $transport;
    }

    /**
     * リクエスト
     *
     * @param array $query クエリ配列
     * @return mixed
     * @throw RequestException
     */
    public function exec($query)
    {
        $result = $this->_getData($this->_createUrl($query));
        if ($result === false) {
            throw new RequestException('');
        }

        return $result;
    }

    /**
     * リクエスト先URLを生成する
     *
     * @param array $query クエリ配列
     * @return string JSON文字列
     */
    protected function _createUrl(array $query = [])
    {
        $url = sprintf('http://%s:%s/solr/%s/%s', $this->_client->getHost(),
            $this->_client->getPort(), $this->_client->getCore(), $this->_request);

        // JSON形式でレスポンスを受け取る
        $query['wt'] = 'json';

        return $url .= '?' . http_build_query($query);
    }

    /**
     * データを取得する
     *
     * @param string $url URL
     * @return array
     */
    private function _getData($url)
    {
        return json_decode($this->_transport->exec($url), true);
    }
}
