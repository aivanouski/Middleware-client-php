<?php

include "MiddlewareClient.php";
include "helpers/bytes32.php";

$client = new MiddlewareClient("http://localhost:8081");

$query_event = $client->getEvents('transfer', json_decode('{"self": "0x096ee6177d6402979b5e3f17385c36231133c254"}'), null);
$query_tx = $client->getTransactions(json_decode('{"to": "0xffc8dae6f5797b1263b81d5e4d1fab5a94804923"}'), null);
$query_add_account = $client->addAccount("0xc3879b7e4833cb44b6e266eeebbf1d99d50ca48d");

var_dump($query_event);
var_dump($query_tx);
var_dump($query_add_account);

