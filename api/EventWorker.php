<?php

require_once __DIR__ . '../../vendor/autoload.php';

class EventWorker {

    private $channel;

    function __construct($connection) {
        $this->channel = $connection->channel();
    }

    function listen($event, $consumer_id) {


        $queue_name = $event . ":" . $consumer_id;


        $this->channel->exchange_declare('events', 'direct', false, false, false);

        $this->channel->queue_declare($queue_name, false, true, false, false);
        $this->channel->queue_bind($queue_name, 'events', $event);


        $this->channel->basic_consume($queue_name, '', false, false, false, false, function ($msg) use ($event) {
            echo ' [x] ', $msg->delivery_info['routing_key'], ':', $msg->body, "\n";
            sleep(substr_count($msg->body, '.'));
            $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
            if ($event->callback)
                call_user_func($event->callback, $msg->body);

        });


        while (count($this->channel->callbacks)) {
            $this->channel->wait();
        }

    }
}