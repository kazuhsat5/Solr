<?php

/**
 * PHP Solr Client
 *
 * @copyright Copyright (C) 2015 kazuhsat All Rights Reserved.
 */

namespace Sugar\Solr\Request;

use Sugar\Solr;
use Sugar\Solr\Transport;

/**
 * Factory Interface
 *
 * @author kazuhsat <kazuhsat555@gmail.com>
 */
interface FactoryInterface
{
    /**
     * create instance
     *
     * @param string $type リクエストタイプ
     * @return Factory
     */
    public function create($type);

    /**
     * execute request
     *
     * @param mixed $arg 引数
     * @return array
     */
    public function exec($arg);
}
