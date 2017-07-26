<?php

function addFilter($host, $callback, $event, $filter){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $host . "/events/listener");
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,
        "callback=". $callback);
    curl_setopt($ch, CURLOPT_POSTFIELDS,
        "event=". $event);
    curl_setopt($ch, CURLOPT_POSTFIELDS,
        "filter=". $filter);
    $data = curl_exec($ch);
    curl_close($ch);
    return json_decode($data);

};