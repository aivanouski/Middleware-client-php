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


##### new MiddlewareClient(<address>).getTransactions(query, opts);
Return all records from the speicified event's collection

| param | description|
| ------ | ------ |
| query | query of request (optional)
| opts | options (limit, offset, sort) (optional)

License
----

MIT