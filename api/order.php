<?php
    require_once '../services/OrderService.php';
    require_once '../services/OrderLineService.php';
    require_once '../services/ProductService.php';
    require_once '../services/PaymentInfoService.php';

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

    $orderService = new OrderService();
    $orderLineService = new OrderLineService();
    $productService = new ProductService();
    $paymentInfoService = new PaymentInfoService();

    if($requestMethod == 'POST') { //arr: Order: {PaymentInfo(with userid), productsInBasket: [Product{ProductVariation}, Product{ProductVariation}]}
        $request_body = file_get_contents('php://input'); //Get form data.
        $order = json_decode($request_body); //Convert from json to php array. array or object?
        
        $paymentInfoResult = $paymentInfoService->createPaymentInfo($order->paymentInfo); //Save paymentinfo in the database.

        $orderToSave = [
            'paymentInfoId' => $paymentInfoResult->id, 
            'userId' => $paymentInfoResult->userId
        ]; 
        $orderResult = $orderService->createOrder($orderToSave); // Create new order in the database.
        // $orderConverted =  $orderService->convertToOrderArray($orderResult); //Convert attribute names to camel case

        $orderLineArray = []; //Is going to be added to the order.
        // Get products from database and use them instead of using the posted data.
        foreach($order->productsInBasket as $product) { //Loop through the products.
            $productFromDB = $productService->getProductById($product->id); //Get product from database to ensure the price is correct.
            $orderLineToSave = [
                'productVariationId' => $product->productVariations[0].id,
                'orderId' => $orderResult->orderId,
                'price' => $productFromDB->price, 
                'discountPercent' => $productFromDB->discountPercent
                // 'priceWithDiscount' =>
            ];
            
            $orderLineResult = $orderLineService->createOrderLine($orderLineToSave); // Save orderline in the database.
            $orderLineConverted = $orderLineService->convertToOrderLineArray($orderLineResult); //Convert attribute names to camel case
            array_push($orderLineArray, $orderLineConverted);
        }

        //Join orderline with productvariation and join productvariation with product.
        //What should orderline contain: id, price, discountPercent, name, description?, sku, inStock?, size
        $orderConverted = $orderService->convertToOrderArray($orderResult, $orderLineArray, $joinedProduct); //Convert attribute names to camel case
        // $orderConverted->orderLines = $orderLineArray;
        // $orderConverted['orderLines'] = $orderLineArray; //Use this
        echo $orderConverted;
        return json_encode($orderConverted);
    }