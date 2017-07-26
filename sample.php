<?php

include "MiddlewareClient.php";
include "helpers/bytes32.php";

$client = new MiddlewareClient("http://localhost:8081");

$query_event = $client->getEvents('done', json_decode('{"self": "0x096ee6177d6402979b5e3f17385c36231133c254"}'), null);
$query_tx = $client->getTransactions(json_decode('{"to": "0x62d0a3919435a7c10ae5e63c230a7c9da3b66e45"}'), null);
$query_filter = $client->addFilter("0x096ee6177d6402979b5e3f17385c36231133c254", "transfer", json_decode('{"to": "0x62d0a3919435a7c10ae5e63c230a7c9da3b66e45", "symbol": '. bytes32('TIME')) .'}');

var_dump($query_event);
var_dump($query_tx);
var_dump($query_filter);

