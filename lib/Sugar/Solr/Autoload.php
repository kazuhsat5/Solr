<?php

/**
 * PHP Solr Client
 *
 * @copyright Copyright (C) 2015 kazuhsat All Rights Reserved.
 */

namespace Sugar\Solr;

/**
 * Autoloader
 *
 * @author kazuhsat <kazuhsat5@gmail.com>
 */
class Autoloader
{
    /**
     * base directory
     *
     * @var
     */
    private $_dir;

    /**
     * constructor
     *
     * @param string $dir base directory(default: current directory)
     * @return void
     */
    public function __construct($dir = __DIR__)
    {
        $this->_dir = $dir;
    }

    /**
     * register
     *
     * @param string $dir base directory(default: current directory)
     * @return void
     */
    public function register($dir = __DIR__)
    {
        spl_autoload_register(array(new self($dir), 'autoload'), true, false);
    }

    /**
     * autoload
     *
     * @param string $className class name
     * @return void
     */
    public function autoload($className)
    {
        $className = ltrim($className, '\\');
        $fileName  = '';
        $namespace = '';
        if ($lastNsPos = strrpos($className, '\\')) {
            $namespace = substr($className, 0, $lastNsPos);
            $className = substr($className, $lastNsPos + 1);
            $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
        }
        $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

        require $this->_dir . '/' . $fileName;
    }
}
