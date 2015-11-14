<?php

namespace Sugar\Solr\Request;

use Sugar\Solr;

/**
 * Updateクラス
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

    /**
     * リクエスト
     *
     * @param string $document ドキュメント(XML, JSON形式文字列)
     * @return mixed
     */
    public function exec($document)
    {
        if (is_string($document)) {
            throw new RequestException('Invalid parameter type.');
        }

    }
}
