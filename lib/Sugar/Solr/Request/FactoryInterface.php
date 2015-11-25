<?php

/**
 * PHP Solr Client
 *
 * @copyright Copyright (C) 2015 kazuhsat All Rights Reserved.
 */

namespace Sugar\Solr\Request;

/**
 * FactoryInterface
 *
 * @author kazuhsat <kazuhsat@gmail.com>
 */
implements FactoryInterface
{
    /**
     * create
     *
     * @param string $name request name
     * @return RequestInterface
     * @throws RquestException
     */
    public function create($name);
}
