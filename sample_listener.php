<?php

include "MiddlewareClient.php";


$callback = function ($msg) {
    echo " [x] Received ", $msg, "\n";
};


$events = array(
    (object)array('event' => '0x52c6bc4d1b831437a82f7a217244b8c24081dad521d2919e2763693654978507:0x579e539bc6aa4dbe228bc2a28c792ffdb6dbbe80099a25717d2f2570841b572e', 'callback' => $callback, 'client'=> time()),
    (object)array('event' => '0x52c6bc4d1b831437a82f7a217244b8c24081dad521d2919e2763693654978507:0x579e539bc6aa4dbe228bc2a28c792ffdb6dbbe80099a25717d2f2570841b572e', 'callback' => $callback, 'client'=> time())
);


$middleware = new MiddlewareClient();
$middleware->createListener('localhost', 32769, 'guest', 'guest', $events);
