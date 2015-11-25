<?php

/**
 * PHP Solr Client
 *
 * @copyright Copyright (C) 2015 kazuhsat All Rights Reserved.
 */

namespace Sugar\Solr;

use Sugar\Solr\Request;

/**
 * ClientInterface
 *
 * following list of method:
 *
 * @method array select(array $params)
 * @method array update($document)
 * @method array ping()
 * @method array system()
 *
 * @author kazuhsat <kazuhsat@gmail.com>
 */
interface ClientInterface
{
    /**
     * __call
     *
     * @param string $name      method
     * @param array  $arguments arguments
     * @return array
     * @throws ClientException
     */
    public function __call($name, $arguments);
}
