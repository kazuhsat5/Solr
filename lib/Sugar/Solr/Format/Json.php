<?php

namespace Sugar\Solr\Format;

/**
 * JSONクラス
 *
 * @author kazuhsat <kazuhsat555@gmail.com>
 */
class Json implements FormatInterface
{
    /**
     * デコード
     *
     * @param string $string 文字列
     * @return array
     * @throw FormatException デコードに失敗した場合
     */
    public static function decode($string)
    {
        $result = json_decode($string, true);
        if (is_null($result)) {
            throw new FormatException('Failed to decode JSON.');
        }

        return $result;
    }
}
