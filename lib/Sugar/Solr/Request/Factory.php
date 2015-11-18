<?php

namespace Sugar\Solr\Request;

use Sugar\Solr;
use Sugar\Solr\Transport;

/**
 * ファクトリ
 *
 * @author kazuhsat <kazuhsat555@gmail.com>
 */
class Factory implements FactoryInterface
{
    /**
     * トランスポートインスタンス
     *
     * @var
     */
    private $_transport;

    /**
     * コンストラクタ
     *
     * @param TransportInterface $transport トランスポートインスタンス
     * @return void
     */
    public function __construct(Transport\TransportInterface $transport)
    {
        $this->_transport = $transport;
    }

    /**
     * リクエスト
     *
     * @param ClientInterface $client クライアントインスタンス
     * @param string $type リクエストタイプ
     * @param array $query クエリ
     * @return array
     */
    public function request($type, Solr\ClientInterface $client, $query)
    {
        switch ($type) {
            case 'select':
                $request = new Select($client, $this->_transport);
                break;
            case 'update':
                $request = new Update($client, $this->_transport);
                break;
            case 'ping':
                $request = new Ping($client, $this->_transport);
                break;
            case 'extract':
                $request = new Extract($client, $this->_transport);
                break;
            case 'threads':
                $request = new Threads($client, $this->_transport);
                break;
            case 'system':
                $request = new System($client, $this->_transport);
        }

        return $request->exec($query);
    }
}
