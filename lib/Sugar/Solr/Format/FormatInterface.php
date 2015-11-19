<?php

namespace Sugar\Solr\Format;

/**
 * フォーマットインターフェース
 *
 * @author kazuhsat <kazuhsat555@gmail.com>
 */
interface FormatInterface
{
    public static function decode($string);
}
