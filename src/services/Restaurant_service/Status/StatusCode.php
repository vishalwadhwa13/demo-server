<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: protos/restaurant.proto

namespace Restaurant_service\Status;

use UnexpectedValueException;

/**
 * Protobuf type <code>restaurant_service.Status.StatusCode</code>
 */
class StatusCode
{
    /**
     * Generated from protobuf enum <code>FAIL = 0;</code>
     */
    const FAIL = 0;
    /**
     * Generated from protobuf enum <code>SUCCESS = 1;</code>
     */
    const SUCCESS = 1;

    private static $valueToName = [
        self::FAIL => 'FAIL',
        self::SUCCESS => 'SUCCESS',
    ];

    public static function name($value)
    {
        if (!isset(self::$valueToName[$value])) {
            throw new UnexpectedValueException(sprintf(
                    'Enum %s has no name defined for value %s', __CLASS__, $value));
        }
        return self::$valueToName[$value];
    }


    public static function value($name)
    {
        $const = __CLASS__ . '::' . strtoupper($name);
        if (!defined($const)) {
            throw new UnexpectedValueException(sprintf(
                    'Enum %s has no value defined for name %s', __CLASS__, $name));
        }
        return constant($const);
    }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(StatusCode::class, \Restaurant_service\Status_StatusCode::class);

