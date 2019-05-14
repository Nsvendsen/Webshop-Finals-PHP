<?php
    require_once '../services/ProductService.php';
    require_once '../services/ProductVariationService.php';
    // require_once '../services/ProductVariationAttributeService.php';

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

    $pService = new ProductService();
    $pvService = new ProductVariationService();
    // $pvaService = new ProductVariationAttributeService();

    if($requestMethod == 'GET') {
        if(is_numeric($productId)){ // Get one product, all its variants and attributes.
            $productResult = $pService->getProductById($productId); //Get product from the database.
            $product = $pService->convertToProductArray($productResult); //Convert attribute names to camel case.
            
            $pvResult = $pvService->getProductVariationsByProductId($productId); //Get all variations for the product.
            $pvArray = []; //Empty array to contain the product variations.
            foreach($pvResult as $variation) { //Loop through the variations.
                // Get product_images instead of attributes, but use same approach?
                // $pvaResult = $pvaService->getProductVariationAttributesByProductVariationId($variation->id); //Get all attributes for the variation.
                // $pvaArray = []; //Empty array to contain the product variation attributes.
                // foreach($pvaResult as $attribute) { //Loop through the attributes.
                //     $productVariationAttribute = $pvaService->convertToProductVariationAttributeArray($attribute); //Convert attribute names to camel case.
                //     array_push($pvaArray, $productVariationAttribute); //Add to array.
                // }

                $productVariation = $pvService->convertToProductVariationArray($variation); //Convert attribute names to camel case.
                // $productVariation['productVariationAttributes'] = $pvaArray; //Add the attribute array to the variation.
                array_push($pvArray, $productVariation); //Add to array.
            }
            $product['productVariations'] = $pvArray; //Add the variation array to the product.

            echo json_encode($product);
            return json_encode($product); //Convert from php array to json
        }
        else { // Get all products but not their variants.
            $result = $pService->getAllProducts(); //Get all products.

            $productArray = []; //Empty array to contain the products.
            foreach($result as $prod) { //Loop through the products.
                $product = $pService->convertToProductArray($prod); //Convert attribute names to camel case.
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
        // echo print_r($data);
        $resultProd = $pService->createProduct($data); //Create product in the database.
        if($resultProd) {
            $product = $pService->convertToProductArray($resultProd); //Convert attribute names to camel case.
            $productVar = $data->productVariations[0];
            $productVar->productId = $resultProd->id;
            $resultProdVar = $pvService->createProductVariation($productVar);//Create product variation in the database. Only one element in the array. Alternatively use data->inStock etc.
            $productVarArray = $pvService->convertToProductVariationArray($resultProdVar);
            $product['productVariations'] = [];
            array_push($product['productVariations'], $productVarArray);
            echo json_encode($product); //Remove later?
            return json_encode($product); //Convert from php array to json.
        }
    }

    if($requestMethod == 'PUT') {
        if (is_numeric($productId)) {
            $request_body = file_get_contents('php://input'); //Get form data.
            $data = json_decode($request_body); //Convert from json to php array.
            $result = $pService->updateProductById($data); //Update product in the database.
            //Make if $result?
            return json_encode($result); //Convert from php array to json.
        }
    }

    if($requestMethod == 'DELETE') {
        if (is_numeric($productId)) {
            $result = $pService->deleteProductById($productId); //Delete product in the database.
            return json_encode($result); //Convert from php array to json.
        }
    }