<?php

include "MiddlewareClient.php";

$client = new MiddlewareClient("http://localhost:8081");

$query_event = $client->getEvents('done', json_decode('{"self": "0x096ee6177d6402979b5e3f17385c36231133c254"}'), null);
$query_tx = $client->getTransactions(json_decode('{"to": "0x62d0a3919435a7c10ae5e63c230a7c9da3b66e45"}'), null);
$query_acc = $client->addAccount("0x096ee6177d6402979b5e3f17385c36231133c254");

var_dump($query_event);
var_dump($query_tx);
var_dump($query_acc);

