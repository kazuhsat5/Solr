<?php

namespace Sugar\Solr\Transport;

/**
 * Transport Interface
 *
 * @author kazuhsat <kazuhsat@gmail.com>
 */
interface TransportInterface
{
    /**
     * execute
     *
     * @param string $url URL
     * @return array
     */
    public function exec($url);
}
