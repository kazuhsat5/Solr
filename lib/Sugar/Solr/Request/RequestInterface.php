<?php

namespace Sugar\Solr\Request;

/**
 * リクエストインターフェース
 *
 * @author kazuhsat <kazuhsat@gmail.com>
 */
interface RequestInterface
{
    /**
     * リクエスト
     *
     * @param mixed $query クエリ配列
     * @return mixed
     */
    public function exec($query);
}
