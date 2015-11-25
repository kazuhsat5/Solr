<?php

/**
 * PHP Solr Client
 *
 * @copyright Copyright (C) 2015 kazuhsat All Rights Reserved.
 */

namespace Sugar\Solr\Request;

/**
 * Update
 *
 * @author kazuhsat <kazuhsat@gmail.com>
 */
class Update extends Request
{
    /**
     * path
     *
     * @var
     */
    protected $_path = 'update';

    /**
     * execute
     */
    public function exec(array $arguments)
    {
        if (is_string($arguments[0])) {
            throw new InvalidParameterException('');
        }

        return $this->_post($this->_createUrl($query), $arguments[0]);
    }
}
