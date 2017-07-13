<?php

function addAccount($host, $address){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $host . "/account");
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,
        "address=". $address);
    $data = curl_exec($ch);
    curl_close($ch);
    return json_decode($data);

};