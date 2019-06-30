<?php

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use function utils\restaurantInstanceToKVMap;
use function utils\KVMapToRestaurantInstance;

use Restaurant_service\RestaurantServiceClient;
use Restaurant_service\GetAllRestaurantRequest;
use Restaurant_service\Status\StatusCode;
use Restaurant_service\GetRestaurantRequest;
use Restaurant_service\AddRestaurantRequest;
use Restaurant_service\EditRestaurantRequest;
use Restaurant_service\DeleteRestaurantRequest;

require '../../vendor/autoload.php';
require '../utils/utils.php';

$client = new RestaurantServiceClient(
    (getenv("ENV") === "docker" ? "host.docker.internal" : "").":8080",
    [
        'credentials' => Grpc\ChannelCredentials::createInsecure(),
    ]
);

$app = new \Slim\App;
$app->get('/restaurants', function (Request $request, Response $response, array $args) {
    global $client;

    $call = $client->GetAllRestaurant(new GetAllRestaurantRequest());
    $rest_resp_generator = $call->responses();

    $rests = [];
    $status_msg = "";
    $fail_state = false;
    foreach ($rest_resp_generator as $rest_resp) {
        if ($rest_resp->getStatus()->getCode() === StatusCode::FAIL) {
            $status_msg = $rest_resp->getStatus()->getMessage();
            $fail_state = true;
            break;
        }
        $rests[] = restaurantInstanceToKVMap($rest_resp->getRestaurant());
    }

    $res = [
        "code" => $fail_state ? 202 : 200,
        "message" => $status_msg,
        "restaurants" => $rests
    ];

    return $response->withStatus($res["code"])->withJson($res);
});

$app->get('/restaurants/{res_id}', function (Request $request, Response $response, array $args) {
    global $client;

    $rest_req = new GetRestaurantRequest();
    try {
        $rest_req->setResId($args["res_id"]);
    } catch(exception $e) {
        return $response->withStatus(404)->withJson([
            "code" => 404,
            "message" => "Restaurant does not exist."
        ]);
    }

    list($rest_resp, $status) = $client->GetRestaurant($rest_req)->wait();
    $fail_state = $rest_resp->getStatus()->getCode() === StatusCode::FAIL;

    $res = [
        "code" => $fail_state ? 404 : 200,
        "message" => $rest_resp->getStatus()->getMessage(),
    ];

    if (!$fail_state) $res["restaurant"] = restaurantInstanceToKVMap($rest_resp->getRestaurant());

    return $response->withStatus($res["code"])->withJson($res);
});

$app->post('/restaurants', function (Request $request, Response $response, array $args) {
    global $client;

    $data = $request->getParsedBody();

    $r = KVMapToRestaurantInstance($data);
    $rest_req = new AddRestaurantRequest();
    $rest_req->setRestaurant($r);

    list($rest_resp, $status) = $client->AddRestaurant($rest_req)->wait();
    $fail_state = $rest_resp->getStatus()->getCode() === StatusCode::FAIL;

    $res = [
        "code" => $fail_state ? 404 : 201,
        "message" => $rest_resp->getStatus()->getMessage(),
    ];

    if (!$fail_state) $res["res_id"] = $rest_resp->getResId();

    return $response->withStatus($res["code"])->withJson($res);
});

$app->put('/restaurants/{res_id}', function (Request $request, Response $response, array $args) {
    global $client;

    $data = $request->getParsedBody();

    $r = KVMapToRestaurantInstance($data);
    try {
        $r->setResId($args["res_id"]);
    } catch(exception $e) {
        return $response->withStatus(404)->withJson([
            "code" => 404,
            "message" => "Restaurant does not exist."
        ]);
    }

    $rest_req = new EditRestaurantRequest();
    $rest_req->setRestaurant($r);

    list($rest_resp, $status) = $client->EditRestaurant($rest_req)->wait();
    $fail_state = $rest_resp->getStatus()->getCode() === StatusCode::FAIL;

    $res = [
        "code" => $fail_state ? 404 : 200,
        "message" => $rest_resp->getStatus()->getMessage(),
    ];

    return $response->withStatus($res["code"])->withJson($res);
});

$app->delete('/restaurants/{res_id}', function (Request $request, Response $response, array $args) {
    global $client;

    $rest_req = new DeleteRestaurantRequest();
    try {
        $rest_req->setResId($args["res_id"]);
    } catch(exception $e) {
        return $response->withStatus(404)->withJson([
            "code" => 404,
            "message" => "Restaurant does not exist."
        ]);
    }

    list($rest_resp, $status) = $client->DeleteRestaurant($rest_req)->wait();
    $fail_state = $rest_resp->getStatus()->getCode() === StatusCode::FAIL;
    
    $res = [
        "code" => $fail_state ? 404 : 200,
        "message" => $rest_resp->getStatus()->getMessage(),
    ];

    return $response->withStatus($res["code"])->withJson($res);
});

$app->get('/[{path:.*}]', function (Request $request, Response $response, array $args) {
    return $response->withStatus(404)->withJson([
        "code" => 404,
        "message" => "Invalid path"
    ]);
});

$app->run();

/**
 * POST:
 * curl -X POST -H "Content-type: application/json" -k -d '{
      "closing_time" : "23:00:00",
      "coordinates" : {
         "lat" : 42.123,
         "long" : 18.1321
      },
      "cost_for_two" : 500,
      "cuisines" : [
         "cafe"
      ],
      "name" : "imly",
      "opening_time" : "10:00",
      "rating" : 4.3
   }' http://demo-server.zomato.com/restaurants
 */