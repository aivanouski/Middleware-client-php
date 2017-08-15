<?php

include "MiddlewareClient.php";


$callback = function ($msg) {
    echo " [x] Received ", $msg, "\n";
};


$events = array(
    (object)array('event' => '0xb483afd3f4caedc6eebf44246fe54e38c95e3179a5ec9ea81740eca5b482d12e:0xc39b0962fcf4bb056f219a2ea0553f4a966398125c4854a6b320e7e0de5d6faa', 'callback' => $callback, 'client'=> time()),
    (object)array('event' => '0xb3294bd074de35198b8d5e18be6975d0c544650a', 'callback' => $callback, 'client'=> time())
);


$middleware = new MiddlewareClient();
$middleware->createListener('localhost', 32769, 'guest', 'guest', $events);
