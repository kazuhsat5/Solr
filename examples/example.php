<?php

require_once __DIR__ . '/bootstrap.php';

use Sugar\Solr;

$client = new Solr\Client('localhost', 'test', 8983);

$query = ['q' => 'name:sato'];
$client->select($query);
