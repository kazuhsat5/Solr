<?php

require_once './bootstrap.php';

use Sugar\Solr;

define('HOST', 'localhost');
define('CORE', 'test');
define('PORT', 8983);

$client = new Solr\Client(HOST, CORE, PORT);

// select
echo print_r($client->select(['q' => 'name:sato']), true) . PHP_EOL;

// update
//echo $client->update(['document' => '{"add" : {"doc" : {"id" : "12", "name" : "kikuchi"}}}']) . PHP_EOL;

// admin/ping
//echo print_r($client->ping(), true) . PHP_EOL;

// admin/system
//echo print_r($client->system(), true) . PHP_EOL;
