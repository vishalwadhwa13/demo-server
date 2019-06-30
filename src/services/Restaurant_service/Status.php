<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protos/restaurant.proto

namespace Restaurant_service;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>restaurant_service.Status</code>
 */
class Status extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>.restaurant_service.Status.StatusCode code = 1;</code>
     */
    private $code = 0;
    /**
     * Generated from protobuf field <code>string message = 2;</code>
     */
    private $message = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type int $code
     *     @type string $message
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Protos\Restaurant::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>.restaurant_service.Status.StatusCode code = 1;</code>
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Generated from protobuf field <code>.restaurant_service.Status.StatusCode code = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setCode($var)
    {
        GPBUtil::checkEnum($var, \Restaurant_service\Status_StatusCode::class);
        $this->code = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string message = 2;</code>
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Generated from protobuf field <code>string message = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setMessage($var)
    {
        GPBUtil::checkString($var, True);
        $this->message = $var;

        return $this;
    }

}

