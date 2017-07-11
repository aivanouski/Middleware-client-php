<?php

include "queryToMongo.php";

function getCollection($host, $namespace, $collection, $query, $opts){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $host .($namespace ? '/' . $namespace : '') . '/' . $collection . '?' . toQuery($query, $opts));
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $data = curl_exec($ch);
    curl_close($ch);
    return json_decode($data);

};