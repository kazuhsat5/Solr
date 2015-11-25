<?php

/**
 * PHP Solr Client
 *
 * @copyright Copyright (C) 2015 kazuhsat All Rights Reserved.
 */

namespace Sugar\Solr\Request;

/**
 * System
 *
 * @author kazuhsat <kazuhsat@gmail.com>
 */
class System extends Request
{
    /**
     * path
     *
     * @var
     */
    protected $_path = 'admin/system';

    /**
     * execute
     *
     * @param array $arguments arguments
     * @return array
     */
    public function exec(array $arguments = [])
    {
        return $this->_get($arguments);
    }
}
