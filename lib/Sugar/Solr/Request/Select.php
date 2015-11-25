<?php

/**
 * PHP Solr Client
 *
 * @copyright Copyright (C) 2015 kazuhsat All Rights Reserved.
 */

namespace Sugar\Solr\Request;

/**
 * Select
 *
 * @author kazuhsat <kazuhsat@gmail.com>
 */
class Select extends Request
{
    /**
     * phth
     *
     * @var
     */
    protected $_path = 'select';

    /**
     * execute
     *
     * @param array $arguments arguments
     * @return array
     */
    public function exec(array $arguments = [])
    {
        if (!is_array($arguments[0])) {
            throw new RequestException(sprintf('invalid first argument. [argument=%s]', $arguments[0]));
        }

        return $this->_get($arguments[0]);
    }
}
