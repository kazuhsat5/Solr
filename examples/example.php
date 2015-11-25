<?php

require_once './bootstrap.php';

use Sugar\Solr;

define('HOST', 'localhost');
define('CORE', 'test');
define('PORT', 8983);

$client = new Solr\Client(HOST, CORE, PORT);

// select
echo $client->select(['q' => 'name:sato']) . PHP_EOL;

// update
//echo $client->update(['document' => '{"add" : {"doc" : {"id" : "12", "name" : "kikuchi"}}}']) . PHP_EOL;

// admin/ping
//echo client->ping() . PHP_EOL;

// admin/system
//echo $client->system() . PHP_EOL;
