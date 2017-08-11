<?php

include "MiddlewareClient.php";
include "helpers/bytes32.php";

$client = new MiddlewareClient("http://localhost:8081");

//$query_event = $client->getEvents('done', json_decode('{"self": "0x096ee6177d6402979b5e3f17385c36231133c254"}'), null);
//$query_tx = $client->getTransactions(json_decode('{"to": "0xffc8dae6f5797b1263b81d5e4d1fab5a94804923"}'), null);
$query_filter = $client->addFilter("transfer", json_decode('{"symbol": "'. bytes32('TIME') .'"}'));
//$remove_filter = $client->removeFilter($query_filter->id);

//var_dump($query_event);
//var_dump($query_tx);
var_dump($query_filter);
//var_dump($remove_filter);

