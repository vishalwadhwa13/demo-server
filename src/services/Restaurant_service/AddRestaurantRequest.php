<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protos/restaurant.proto

namespace Restaurant_service;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>restaurant_service.AddRestaurantRequest</code>
 */
class AddRestaurantRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>.restaurant_service.Restaurant restaurant = 1;</code>
     */
    private $restaurant = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Restaurant_service\Restaurant $restaurant
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Protos\Restaurant::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>.restaurant_service.Restaurant restaurant = 1;</code>
     * @return \Restaurant_service\Restaurant
     */
    public function getRestaurant()
    {
        return $this->restaurant;
    }

    /**
     * Generated from protobuf field <code>.restaurant_service.Restaurant restaurant = 1;</code>
     * @param \Restaurant_service\Restaurant $var
     * @return $this
     */
    public function setRestaurant($var)
    {
        GPBUtil::checkMessage($var, \Restaurant_service\Restaurant::class);
        $this->restaurant = $var;

        return $this;
    }

}
