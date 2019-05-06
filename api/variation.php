<?php
    // require_once '../services/ProductService.php';
    require_once '../services/ProductVariationService.php';
    // require_once '../models/Product.php'; 
    require_once '../models/ProductVariation.php'; 

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
            
            //Change to load variationattributes & save them in the variation array. CODE NOT FINISHED
            // $productVariationResult = $productVariationService->getProductVariationsByProductId($productVariationId); //Get all variations for the product.
            // $variationArray = []; //Empty array to contain the product variations.
            // foreach($productVariationResult as $variation) { //Loop through the variations.
            //     $productVariation = $productVariationService->convertToProductVariationArray($variation); //Convert attribute names to camel case.
            //     array_push($variationArray, $productVariation); //Add to array.
            // }
            // $product['productVariations'] = $variationArray; //Add the variation array to the product.

            echo json_encode($productVariation);
            return json_encode($productVariation); //Convert from php array to json
        }
        // else { // Get all products variations. No scenario where we want to get all product variations. CODE NOT FINISHED
        //     $result = $productVariationService->getAllProductVariations(); //Get all product variations.

        //     $productVariationArray = []; //Empty array to contain the product variations.
        //     foreach($result as $prod) { //Loop through the products.
        //         $product = $productService->convertToProductArray($prod); //Convert attribute names to camel case.
        //         array_push($productArray, $product); //Add to array.
        //     }
        //     echo json_encode($productArray);
        //     return json_encode($productArray); //Convert from php array to json
        // }
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