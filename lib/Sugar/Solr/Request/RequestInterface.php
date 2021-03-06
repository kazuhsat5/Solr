<?php

/**
 * PHP Solr Client
 *
 * @copyright Copyright (C) 2015 kazuhsat All Rights Reserved.
 */

namespace Sugar\Solr\Request;

/**
 * RequestInterface
 *
 * @author kazuhsat <kazuhsat@gmail.com>
 */
interface RequestInterface
{
    /**
     * execute
     *
     * @param array $arguments arguments
     * @return array
     */
    public function exec(array $arguments = []);
}
