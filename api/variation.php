<?php
    // require_once '../services/ProductService.php';
    require_once '../services/ProductVariationService.php';

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

    $requestMethod = $_SERVER['REQUEST_METHOD']; //For example: GET
    $requestURI = $_SERVER['REQUEST_URI']; //Webshop-Finals-PHP/api/variation/1  1 is just an example.
    $splitSlash = explode("/", $requestURI); //Split the string at every slash and create array. In this example: [Webshop-Finals-PHP, api, variation, 1]
    $productVariationId = end($splitSlash); //Get last element in the array.

    // $productService = new ProductService();
    $productVariationService = new ProductVariationService();

    if($requestMethod == 'GET') {
        if(is_numeric($productVariationId)) { // Get one product variation.
            $productVariationResult = $productVariationService->getProductVariationById($productVariationId); //Get product variation from the database.
            $productVariation = $productVariationService->convertToProductVariationArray($productVariationResult); //Convert attribute names to camel case.

            echo json_encode($productVariation);
            return json_encode($productVariation); //Convert from php array to json
        }
    }

    if($requestMethod == 'POST') {
        // https://stackoverflow.com/questions/9597052/how-to-retrieve-request-payload
        $request_body = file_get_contents('php://input'); //Get form data.
        $data = json_decode($request_body); //Convert from json to php array.
        
        $result = $productVariationService->createProductVariation($data); //Create product in the database.
        if($result) {
            $productVariation = $productVariationService->convertToProductVariationArray($result); //Convert attribute names to camel case.
            echo json_encode($productVariation); //Remove later?
            return json_encode($productVariation); //Convert from php array to json.
        }
    }

    if($requestMethod == 'PUT') {
        if (is_numeric($productVariationId)) {
            $request_body = file_get_contents('php://input'); //Get form data.
            $data = json_decode($request_body); //Convert from json to php array.
            $result = $productVariationService->updateProductById($data); //Update product variation in the database.
            //Make if $result?
            return json_encode($result); //Convert from php array to json.
        }
    }

    if($requestMethod == 'DELETE') {
        if (is_numeric($productVariationId)) {
            $result = $productVariationService->deleteProductById($productVariationId); //Delete product variation in the database.
            return json_encode($result); //Convert from php array to json.
        }
    }