<?php

namespace Sugar\Solr\Request;

/**
 * updateクラス
 *
 * @author kazuhsat <kazuhsat@gmail.com>
 */
class Update extends Request
{
    /**
     * リクエスト名
     *
     * @var
     */
    protected $_request = 'update';


    // curl http://localhost:8983/solr/test/update/json?commit=true -H 'Content-type:application/json' -d '{"add" : {"doc" : {"id" : "6", "name" : "ito"}}}'

    /**
     * リクエスト
     */
    public function exec($query)
    {
        $this->_transport->setHeader($query['header']);
        $this->_transport->setData($query['document']);

        unset($document['document'];
        unset($document['header'];

       
    }
}
