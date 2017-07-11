<?php

include "MiddlewareClient.php";

$client = new MiddlewareClient("http://localhost:8081");

$query = $client->getEvents('done', json_decode('{"self": "0x096ee6177d6402979b5e3f17385c36231133c254"}'), null);

var_dump($query);