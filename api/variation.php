<?php
    require_once '../services/ProductService.php';
    require_once '../services/ProductVariationService.php';
    require_once '../models/Product.php'; 
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
    $requestURI = $_SERVER['REQUEST_URI']; //Webshop-Finals-PHP/api/product/1  1 is just an example.
    $splitSlash = explode("/", $requestURI); //Split the string at every slash and create array. In this example: [Webshop-Finals-PHP, api, product, 1]
    $productVariationId = end($splitSlash); //Get last element in the array.

    $productService = new ProductService();
    $productVariationService = new ProductVariationService();

    if($requestMethod == 'GET') {
        if(is_numeric($productVariationId)) { // Get one product.
            $productVariationResult = $productVariationService->getProductById($productId); //Get product from the database.
            $product = $productService->convertToProductArray($productResult); //Convert attribute names to camel case.
            
            $productVariationResult = $productVariationService->getProductVariationsByProductId($productId); //Get all variations for the product.
            $variationArray = []; //Empty array to contain the product variations.
            foreach($productVariationResult as $variation) { //Loop through the variations.
                $productVariation = $productVariationService->convertToProductVariationArray($variation); //Convert attribute names to camel case.
                array_push($variationArray, $productVariation); //Add to array.
            }
            $product['productVariations'] = $variationArray; //Add the variation array to the product.

            echo json_encode($product);
            return json_encode($product); //Convert from php array to json
        }
        else { // Get all products.
            $result = $productService->getAllProducts(); //Get all products.

            $productArray = []; //Empty array to contain the products.
            foreach($result as $prod) { //Loop through the products.
                $product = $productService->convertToProductArray($prod); //Convert attribute names to camel case.
                array_push($productArray, $product); //Add to array.
            }
            echo json_encode($productArray);
            return json_encode($productArray); //Convert from php array to json
        }
    }

    if($requestMethod == 'POST') {
        // if(isset($_POST['submit'])) {    
        //     $name = $_POST["name"];
        // }
        
        // https://stackoverflow.com/questions/9597052/how-to-retrieve-request-payload
        $request_body = file_get_contents('php://input'); //Get form data.
        $data = json_decode($request_body); //Convert from json to php array.
        
        $result = $productService->createProduct($data); //Create product in the database.
        if($result) {
            $product = $productService->convertToProductArray($result); //Convert attribute names to camel case.
            echo json_encode($product); //Remove later?
            return json_encode($product); //Convert from php array to json.
        }
    }

    if($requestMethod == 'PUT') {
        if (is_numeric($productId)) {
            $request_body = file_get_contents('php://input'); //Get form data.
            $data = json_decode($request_body); //Convert from json to php array.
            $result = $productService->updateProductById($data); //Update product in the database.
            //Make if $result?
            return json_encode($result); //Convert from php array to json.
        }
    }

    if($requestMethod == 'DELETE') {
        if (is_numeric($productId)) {
            $result = $productService->deleteProductById($productId); //Delete product in the database.
            return json_encode($result); //Convert from php array to json.
        }
    }