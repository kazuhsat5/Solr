<?php

/**
 * PHP Solr Client
 *
 * @copyright Copyright (C) 2015 kazuhsat All Rights Reserved.
 */

namespace Sugar\Solr\Request;

/**
 * Ping
 *
 * @author kazuhsat <kazuhsat@gmail.com>
 */
class Ping extends Request
{
    /**
     * path
     *
     * @var
     */
    protected $_path = 'admin/ping';
}
