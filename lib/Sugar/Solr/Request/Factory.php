<?php

namespace Sugar\Solr\Request;

use Sugar\Solr;
use Sugar\Solr\Transport;

/**
 * ファクトリクラス
 *
 * @author kazuhsat <kazuhsat555@gmail.com>
 */
class Factory implements FactoryInterface
{
    /**
     * クライアントインスタンス
     *
     * @var
     */
    private $_client;

    /**
     * トランスポートインスタンス
     *
     * @var
     */
    private $_transport;

    /**
     * リクエストインスタンス
     *
     * @var
     */
    private $_request;

    /**
     * コンストラクタ
     *
     * @param ClientInterface $client クライアントインスタンス
     * @param TransportInterface $transport トランスポートインスタンス
     * @return void
     */
    public function __construct(Solr\ClientInterface $client, Transport\TransportInterface $transport)
    {
        $this->_client = $client;
        $this->_transport = $transport;
    }

    /**
     * インスタンス生成
     *
     * @param string $type リクエストタイプ
     * @return Factory
     */
    public function create($type)
    {
        switch ($type) {
            case 'select':
                $this->_request = new Select($this->_client, $this->_transport);
                break;
            case 'update':
                $this->_request = new Update($this->_client, $this->_transport);
                break;
            case 'ping':
                $this->_request = new Ping($this->_client, $this->_transport);
                break;
            case 'extract':
                $this->_request = new Extract($this->_client, $this->_transport);
                break;
            case 'system':
                $this->_request = new System($this->_client, $this->_transport);
                break;
            default:
                throw new RequestException(sprintf('invalid type. [type=%s]', $type));
        }

        // メソッドチェーンでの利用を可とするために自class返却
        return $this;
    }

    /**
     * リクエスト
     *
     * @param array $query クエリ配列
     * @return array
     */
    public function request($query)
    {
        return $this->_request->exec($query);
    }
}
