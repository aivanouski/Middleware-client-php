<?php

function toQuery($criteria, $options) {

    $result = array(
        transformCriteria($criteria),
        transformOptions($options)
    );

    return join(array_filter($result), "&");

}


function transformOptions($options) {

    $result = array();

    foreach ($options as $key => $value) {

        if ($key === 'fields') {
            $fields = join(array_keys((array)$value), ",");
            array_push($result, $key . '=' . $fields);
        }


        if ($key === 'sort') {
            $sort = array();
            foreach ($value as $item_key => $item_val) {
                array_push($sort, $item_val === 1 ? $item_key : '-' . $item_key);
            }

            array_push($result, $key . '=' . join($sort, ","));
        }


        if ($key === 'skip' || $key === 'limit') {
            array_push($result, $key . '=' . $value);
        }


    }


    return join($result, '&');

}


function transformCriteria($criteria) {

    $result = array();

    foreach ($criteria as $key => $value) {
        if (is_object($value)) {
            $res = comparatorToQuery($key, $value);
            if ($res) {
                array_push($result, $res);
            }
        } else {
            array_push($result, $key . '=' . $value);
        }
    }


    return join($result, '&');

}


function comparatorToQuery($key, $value) {

    $object = new stdClass();
    $object->{'$exists'} = function () use ($value, $key) {
        printf('inside');
        return $value->{'$exists'} ? $key : '!' . $key;
    };
    $object->{'$in'} = function () use ($value, $key) {
        return $key . '=' . join($value->{'$in'}, ",");
    };
    $object->{'$nin'} = function () use ($value, $key) {
        return $key . '!=' . join($value->{'$nin'}, ",");
    };
    $object->{'$gt'} = function () use ($value, $key) {
        return $key . ">" . $value->{'$gt'};
    };
    $object->{'$gte'} = function () use ($value, $key) {
        return $key . ">=" . $value->{'$gte'};
    };
    $object->{'$lt'} = function () use ($value, $key) {
        return $key . "<" . $value->{'$lt'};
    };
    $object->{'$lte'} = function () use ($value, $key) {
        return $key . "<=" . $value->{'$lte'};
    };


    foreach ($value as $item_key => $item) {
        if ($object->{$item_key}) {
            return $object->{$item_key}->__invoke();
        }
    }

}