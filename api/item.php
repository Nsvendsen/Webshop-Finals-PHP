<?php
    require_once '../services/ItemService.php';
    include_once '../models/Item.php'; 

    //Headers
    // header("Access-Control-Allow-Origin: localhost:4200"); //Change to localhost:4200 or * or {$_SERVER['HTTP_ORIGIN']}
    
    // header('Access-Control-Allow-Origin: *');
    // header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
    // header('Access-Control-Allow-Headers: token, Content-Type');
    // header('Content-Type: application/json');
    // //Add http status 200 OK header
    // header("HTTP/1.1 200 OK");


    // //Might need to set more headers: https://stackoverflow.com/questions/8719276/cors-with-php-headers
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
        header('Access-Control-Allow-Headers: token, Content-Type');
        header('Access-Control-Max-Age: 1728000');
        header('Content-Length: 0');
        header('Content-Type: text/plain');
        die();
    }
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    /* Some things to consider:
        How do we make the actual endpoints? Use the _POST['nameOfInputField'] object?
        What is the difference between URI and URL?
        How do we use the model?
    */

    $requestMethod = $_SERVER['REQUEST_METHOD']; //For example: GET
    // echo $requestMethod; //Check request method by viewing response in network tab inside chrome.
    $requestURI = $_SERVER['REQUEST_URI']; //Webshop-Finals-PHP/api/item/1  1 is just an example.
    $splitSlash = explode("/", $requestURI); //Split the string at every slash and create array. In this example: [Webshop-Finals-PHP, api, item, 1]
    $itemId = end($splitSlash); //Get last element in the array.
    // $query = parse_url($requestURI, PHP_URL_QUERY); //Query params wont work using above approach!
    // var_dump(parse_url($requestURI, PHP_URL_PATH));

    $itemService = new ItemService();

    if($requestMethod == 'GET') {
        if(is_numeric($itemId)){ // Get one item.
            $result = $itemService->getItemById($itemId);
            echo json_encode($result);
            return json_encode($result);
        }
        else { // Get all items.
            $result = $itemService->getAllItems();
            // $result = array_values($result);
            echo json_encode($result);
            return json_encode($result);
        }
    }

    if($requestMethod == 'POST') {
        // if(isset($_POST['submit'])) {    
        //     $name = $_POST["name"];
        // }
        
        // https://stackoverflow.com/questions/9597052/how-to-retrieve-request-payload
        $request_body = file_get_contents('php://input');
        // echo print_r($request_body);
        $data = json_decode($request_body);
        // echo print_r($data);
        // $theItem = new Item();
        // $theItem->fromAngularToDatabase($data); //Set Item object properties.
        $result = $itemService->createItem($data); //$theItem
        if($result) {
            echo json_encode($result); //Remove later?
            return json_encode($result);
        }
    }

    if($requestMethod == 'PUT') {
        if (is_numeric($itemId)) {
            $request_body = file_get_contents('php://input');
            $data = json_decode($request_body);
            $result = $itemService->updateItemById($data); //Id is also passed inside the object, so no need to pass $itemId.
            return json_encode($result);
        }
    }

    if($requestMethod == 'DELETE') {
        if (is_numeric($itemId)) {
            $result = $itemService->updateItemById($itemId); //Id is also passed inside the object, so no need to pass $itemId.
            return json_encode($result); 
        }
    }

    /* Pseudocode
    $itemService = new ItemService();

    //Endpoint GET 
    function getItems(){
        return $itemService.getAllItems();
    }

    //Endpoint GET one item localhost/item/1
    function getOneItem(){
        return $itemService.getItemById($pathparam);
    }
    */