<?php

include "api/getCollection.php";
include "api/addFilter.php";

/**
 * Class MiddlewareClient
 * @description - entry point
 * @param host - the api host
 */
class MiddlewareClient {

    private $HOST = '';

    function __construct($host) {
        $this->HOST = $host;
    }


    public function getEvents($collection, $query, $opts) {
        return getCollection($this->HOST, 'events', $collection, $query, $opts);
    }

    public function getTransactions($query, $opts) {
        return getCollection($this->HOST, 'transactions', null, $query, $opts);
    }

    public function addFilter($callback, $event, $filter){
        return addFilter($this->HOST, $callback, $event, $filter);
    }

}