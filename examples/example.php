<?php

define('HOST', 'localhost');
define('CORE', 'test');
define('PORT', 8983);

require_once './bootstrap.php';

use Sugar\Solr;

$client = new Solr\Client(HOST, CORE, PORT);

// select
var_dump($client->select(['q' => 'name:sato']));

// ping
//var_dump($client->ping());

//system
//var_dump($client->system());
