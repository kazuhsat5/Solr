<?php

namespace Sugar\Solr\Request;

/**
 * selectクラス
 *
 * @author kazuhsat <kazuhsat@gmail.com>
 */
class Select extends Request
{
    /**
     * リクエスト名
     *
     * @var
     */
    protected $_request = 'select';

    /**
     * リクエスト
     *
     * @param array $query クエリ配列
     * @return mixed
     */
    public function exec(array $query)
    {
        $result = $this->getData($this->_createUrl($query));

        //$result = json_decode($result, true);

        var_dump($result);
    }
}
