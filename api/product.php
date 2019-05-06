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
    $productId = end($splitSlash); //Get last element in the array.

    $productService = new ProductService();
    $productVariationService = new ProductVariationService();

    if($requestMethod == 'GET') {
        if(is_numeric($productId)){ // Get one product.
            // $productResult = $productService->getProductById($productId);
            // $product = new Product($productResult);
            
            // $productVariationResult = $productVariationService->getProductVariationsByProductId($productId);
            // $variationArray = [];
            // foreach($productVariationResult as $variation){
            //     $productVariation = new ProductVariation($variation);
            //     array_push($variationArray, $productVariation);
            // }
            // $product->setProductVariations($variationArray);

            // echo json_encode($product);
            // return json_encode($product);

            $productResult = $productService->getProductById($productId);
            $product = $productService->convertToProductArray($productResult);
            
            $productVariationResult = $productVariationService->getProductVariationsByProductId($productId);
            $variationArray = [];
            foreach($productVariationResult as $variation){
                $productVariation = $productVariationService->convertToProductVariationArray($variation);
                array_push($variationArray, $productVariation);
            }
            $product['productVariations'] = $variationArray;
            // array_push($product, $variationArray);

            // print_r($productVariationResult);
            // print_r($variationArray);
            echo json_encode($product);
            return json_encode($product);
        }
        else { // Get all products.
            $result = $productService->getAllProducts();
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
        // echo var_dump($data);
        // $theProduct = new Product();
        // $theProduct->fromAngularToDatabase($data); //Set Product object properties.
        $result = $productService->createProduct($data); //$theProduct
        if($result) {
            echo json_encode($result); //Remove later?
            return json_encode($result);
        }
    }

    if($requestMethod == 'PUT') {
        if (is_numeric($productId)) {
            $request_body = file_get_contents('php://input');
            $data = json_decode($request_body);
            $result = $productService->updateProductById($data); //Id is also passed inside the object, so no need to pass $productId.
            return json_encode($result);
        }
    }

    if($requestMethod == 'DELETE') {
        if (is_numeric($productId)) {
            $result = $productService->deleteProductById($productId); //Id is also passed inside the object, so no need to pass $productId.
            return json_encode($result); 
        }
    }