# DEMO SERVER
A simple server API written in PHP with Slim framework to interact with [restaurant-service](https://github.com/vishalwadhwa13/restaurant-service) over gRPC calls using protobuf. It provides multiple route to get data about restaurants.

## Routes
1. Add a restaurant: `POST /restaurants`
    
    Example:
    ```sh
    curl -X POST -H "Content-type: application/json" -k -d '{
      "coordinates" : {
         "lat" : 42.123,
         "long" : 18.1321
      },
      "cost_for_two" : 500, 
      "cuisines" : [
         "cafe"
      ],
      "name" : "bimly",
      "opening_time" : "10:00",
      "rating" : 2.3
   }' http://localhost:8888/restaurants 
    ```
2. Get a restaurant: `GET /restaurants/{res_id}`

    Example:
    ```sh
    curl http://localhost:8888/restaurants/2 
    ```
3. Edit a restaurant: `PUT /restaurants/{res_id}`

    Example:
    ```sh
    curl -X PUT -H "Content-type: application/json" -k -d '{
      "closing_time" : "23:00:00",
      "coordinates" : {
         "lat" : 42.123,
         "long" : 18.1321
      },
      "cost_for_two" : 1500,
      "cuisines" : [
         "cafe"
      ],
      "name" : "bimly",
      "opening_time" : "10:00",
      "rating" : 2.3
   }' http://localhost:8888/restaurants/15
    ```
4. Delete a restaurant: `DELETE /restaurants/{res_id}`

    Example:
    ```sh
    curl -X DELETE http://localhost:8888/restaurants/8
    ```
5. Get all restaurants: `GET /restaurants`

    Example:
    ```sh
    curl http://localhost:8888/restaurants
    ```

## Instructions
1. Build docker image with `make docker_build`.
2. Run the image with `docker run -it --name demo-server-api -p 8888:80 demo-server`.
3. Make sure that [restaurant-service](https://github.com/vishalwadhwa13/restaurant-service) is running on port `8080`.