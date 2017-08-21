<?php

include "MiddlewareClient.php";


$callback = function ($msg) {
    echo " [x] Received ", $msg, "\n";
};

$event_name = 'eth_transaction';
$client = 'ico';

$middleware = new MiddlewareClient();
$middleware->createListener('localhost', 32769, 'guest', 'guest', $event_name, $client);
