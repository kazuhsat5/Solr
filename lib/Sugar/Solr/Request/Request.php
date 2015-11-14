<?php

namespace Sugar\Solr\Request;

use Sugar\Solr;
use Sugar\Solr\Transport;

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
     * @param mixed $query クエリ配列
     * @return mixed
     */
    abstract public function exec($query);

    /**
     * リクエスト先URLを生成する
     *
     * @param array $query クエリ配列
     * @return string
     */
    protected function _createUrl(array $query)
    {
        return sprintf('http://%s:%s/solr/%s/%s?%s', $this->_client->getHost(),
            $this->_client->getPort(), $this->_client->getCore(), $this->_request, http_build_query($query));
    }

    /**
     * URLアクセス
     *
     * @param string $url URL
     * @return array
     */
    protected function getData($url)
    {
        return $this->_transport->exec($url);
    }
}
