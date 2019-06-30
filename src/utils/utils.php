<?php

namespace utils;

use \Google\Protobuf\Internal\RepeatedField;
use \Google\Protobuf\Internal\GPBType;

function arrayToRepeatedField($arr) {
    $rep_field = new RepeatedField(GPBType::STRING);
    foreach($arr as $elm) {
        $rep_field[] = $elm;
    }
    return $rep_field;
}

function restaurantInstanceToKVMap($rest) {
    $obj = [
        "res_id" => $rest->getResId(),
        "name" => $rest->getName(),
        "rating" => $rest->getRating(),
        "cuisines" => iterator_to_array($rest->getCuisines()->getIterator()),
        "cost_for_two" => $rest->getCostForTwo(),
        "opening_time" => $rest->getOpeningTime(),
        "closing_time" => $rest->getClosingTime(),
        "location" => [
            "lat" => $rest->getLocation()->getLat(),
            "long" => $rest->getLocation()->getLong()
        ]
    ];

    return $obj;
}

function KVMapToRestaurantInstance($map) {
    $data = [];
    if (isset($map["name"])) {
        $data["name"] = $map["name"];
    }
    if (isset($map["rating"])) {
        $data["rating"] = $map["rating"];
    }
    if (isset($map["cuisines"])) {
        $data["cuisines"] = arrayToRepeatedField($map["cuisines"]);
    }
    if (isset($map["cost_for_two"])) {
        $data["cost_for_two"] = $map["cost_for_two"];
    }
    if (isset($map["opening_time"])) {
        $data["opening_time"] = $map["opening_time"];
    }
    if (isset($map["closing_time"])) {
        $data["closing_time"] = $map["closing_time"];
    }
    if (isset($map["location"])) {
        $data["location"] = new \Restaurant_service\Restaurant\Location([
            "lat" => $map["coordinates"]["lat"],
            "long" => $map["coordinates"]["long"]
        ]);
    }
    
    $r = new \Restaurant_service\Restaurant($data);
    return $r;
}