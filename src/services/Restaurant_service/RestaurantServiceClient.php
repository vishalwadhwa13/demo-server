<?php
// GENERATED CODE -- DO NOT EDIT!

namespace Restaurant_service;

/**
 */
class RestaurantServiceClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * @param \Restaurant_service\AddRestaurantRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function AddRestaurant(\Restaurant_service\AddRestaurantRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/restaurant_service.RestaurantService/AddRestaurant',
        $argument,
        ['\Restaurant_service\AddRestaurantResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Restaurant_service\GetRestaurantRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function GetRestaurant(\Restaurant_service\GetRestaurantRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/restaurant_service.RestaurantService/GetRestaurant',
        $argument,
        ['\Restaurant_service\GetRestaurantResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Restaurant_service\EditRestaurantRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function EditRestaurant(\Restaurant_service\EditRestaurantRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/restaurant_service.RestaurantService/EditRestaurant',
        $argument,
        ['\Restaurant_service\EditRestaurantResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Restaurant_service\DeleteRestaurantRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function DeleteRestaurant(\Restaurant_service\DeleteRestaurantRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/restaurant_service.RestaurantService/DeleteRestaurant',
        $argument,
        ['\Restaurant_service\DeleteRestaurantResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Restaurant_service\GetAllRestaurantRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function GetAllRestaurant(\Restaurant_service\GetAllRestaurantRequest $argument,
      $metadata = [], $options = []) {
        return $this->_serverStreamRequest('/restaurant_service.RestaurantService/GetAllRestaurant',
        $argument,
        ['\Restaurant_service\GetRestaurantResponse', 'decode'],
        $metadata, $options);
    }

}
