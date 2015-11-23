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
    protected $_path = 'update/json';


    // curl http://localhost:8983/solr/test/update/json?commit=true -H 'Content-type:application/json' -d '{"add" : {"doc" : {"id" : "6", "name" : "ito"}}}'

    /**
     * リクエスト
     */
    public function exec($query)
    {
        $data = $query['document'];
        unset($query['document']);

        return $this->_transport->exec($this->_createUrl($query), 'Content-type:application/json', $data);
    }
}
