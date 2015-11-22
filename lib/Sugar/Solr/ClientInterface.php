<?php

/**
 * PHP Solr Client
 *
 * @copyright Copyright (C) 2015 kazuhsat All Rights Reserved.
 */

namespace Sugar\Solr;

use Sugar\Solr\Request;

/**
 * Client Interface
 *
 * following list of method:
 *
 * @method array select($params = [])
 * @method array update($document)
 * @method array extract($document)
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
     * @param string $name method
     * @param array $arguments argumetns
     * @return array
     * @throw ClientException
     */
    public function __call($name, $arguments);
}
