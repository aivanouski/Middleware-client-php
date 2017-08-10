<?php

require_once __DIR__ . '../../vendor/autoload.php';
use PhpAmqpLib\Message\AMQPMessage;

class EventWorker {

    private $channel;

    function __construct($connection) {
        $this->channel = $connection->channel();
    }

    function listen($events) {
        foreach ($events as $event) {

            $this->channel->queue_declare('events:register', false, true, false, false);

            $msg = new AMQPMessage(json_encode((object)array('id' => $event->event, 'client' => $event->client)),
                array('delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT)
            );

            $this->channel->basic_publish($msg, '', 'events:register');

            $this->channel->queue_declare('events:' . $event->event . '.' . $event->client, false, false, false, false);
            echo ' [*] Waiting for messages on ' . 'events:' . $event->event, "\n";

            $this->channel->basic_consume('events:' . $event->event . '.' . $event->client, '', false, false, false, false, function ($msg) use ($event) {
                sleep(substr_count($msg->body, '.'));
                $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
                if ($event->callback)
                    call_user_func($event->callback, $msg->body);

            });
        }


        while (count($this->channel->callbacks)) {
            $this->channel->wait();
        }

    }
}