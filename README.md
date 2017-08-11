# Middleware REST client API

The rest API client for middleware, written in php.

### Usage

```
include "MiddlewareClient.php";

$client = new MiddlewareClient("http://localhost:8081");

$query = $client->getEvents('done', json_decode('{"self": "0x096ee6177d6402979b5e3f17385c36231133c254"}'), null);

var_dump($query);
/** {"_id":"59633b0518bc760f8cb3ebeb","self":"0x096ee6177d6402979b5e3f17385c36231133c254",
"hash":"0x3252c96731e23412d8847e9fca3ec7988fe985f2717e33520eb5bfc18ca49282".. */
```

### Signatures

##### new MiddlewareClient(<address>).getEvent(event_name, query, opts);
Return all records from the speicified event's collection

| param | description|
| ------ | ------ |
| event_name   | name of event (required)
| query | query of request (optional)
| opts | options (limit, offset, sort) (optional)


##### new MiddlewareClient(<address>).addFilter(event, filter);
Create a new filter for events (events on amqp are emitted when certain emitted event on smart contract meet specified in filter conditions). Here is an exmaple of filter:
```
$query_filter = $client->addFilter("transfer", json_decode('{"to": "'0xffc8dae6f5797b1263b81d5e4d1fab5a94804923'"}'));
```



| param | description|
| ------ | ------ |
| event | event's name
| filter | an object with conditions

This request will return event_id - which is unique. You can use it for registration on amqp or deregister purpose. 


##### new MiddlewareClient(<address>).removeFilter(event_id);

Remove filter:
```
$query_filter = $client->removeFilter("0xb483afd3f4caedc6eebf44246fe54e38c95e3179a5ec9ea81740eca5b482d12e:0xc39b0962fcf4bb056f219a2ea0553f4a966398125c4854a6b320e7e0de5d6faa");
```



| param | description|
| ------ | ------ |
| event_id | event's id

##### new MiddlewareClient(<address>).getTransactions(query, opts);
Return all records from the speicified event's collection

| param | description|
| ------ | ------ |
| query | query of request (optional)
| opts | options (limit, offset, sort) (optional)


##### new MiddlewareClient().createListener(host, port, user, password, events);
Create a daemon, which listens for events via amqp interface. Here is an example, of how to declare events:
```
$events = array(
    (object)array('event' => '0xb483afd3f4caedc6eebf44246fe54e38c95e3179a5ec9ea81740eca5b482d12e:0xc39b0962fcf4bb056f219a2ea0553f4a966398125c4854a6b320e7e0de5d6faa', 'callback' => $callback, 'client'=> time()),
    (object)array('event' => '0x52c6bc4d1b831437a82f7a217244b8c24081dad521d2919e2763693654978507:0x579e539bc6aa4dbe228bc2a28c792ffdb6dbbe80099a25717d2f2570841b572e', 'callback' => $callback, 'client'=> time())
);
```
Where event - is event_id, callback - is a funtction, which will be called on new event with data passed to it as a first argument. Client - is a unique name (in this case - it's a timestamp).


| param | description|
| ------ | ------ |
| host | rabbitmq host
| port | rabbitmq port
| user | rabbitmq user
| password | rabbitmq password
| events | an array of events



License
----

MIT