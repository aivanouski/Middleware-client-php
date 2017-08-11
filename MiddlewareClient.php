<?php

include "api/getCollection.php";
include "api/addFilter.php";
include "api/removeFilter.php";
include "api/EventWorker.php";

require_once __DIR__ . '../vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;


/**
 * Class MiddlewareClient
 * @description - entry point
 * @param host - the api host
 */
class MiddlewareClient {

    private $HOST = '';

    function __construct() {}

    function __construct1($host) {
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

    public function removeFilter($hash){
        return removeFilter($this->HOST, $hash);
    }


    public function createListener($host, $port, $user, $pass, $events){
        $connection = new AMQPStreamConnection($host, $port, $user, $pass);
        $worker = new EventWorker($connection);
        $worker->listen($events);
    }
}