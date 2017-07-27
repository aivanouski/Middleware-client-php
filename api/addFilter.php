<?php

function addFilter($host, $callback, $event, $filter) {

    $ch = curl_init();

    $data = array("callback" => $callback, "event" => $event, "filter" => $filter);
    $data_string = json_encode($data);
    echo $data_string;


    curl_setopt($ch, CURLOPT_URL, $host . "/events/listener");
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string))
    );
    $data = curl_exec($ch);
    curl_close($ch);
    return json_decode($data);

}

;