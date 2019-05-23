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

    if($requestMethod == 'POST') {
        $request_body = file_get_contents('php://input'); //Get form data.
        $order = json_decode($request_body); //Convert from json to php array. array or object?
        
        // Replace last 4 digits of cardnumber with XXXX for security purposes?
        // Perhaps make this process a transaction to ensure all elements of the order are created.
        $paymentInfoResult = $paymentInfoService->createPaymentInfo($order->paymentInfo); //Save paymentinfo in the database.
        
        $orderToSave = [
            'paymentInfoId' => $paymentInfoResult->id, 
            'userId' => $order->userId
        ]; 
        $orderResult = $orderService->createOrder($orderToSave); // Create new order in the database.

        if($orderResult) {
            foreach($order->productsInBasket as $product) { //Loop through the products.
                $productFromDB = $productService->getProductById($product->id); //Get product from database to ensure the price is correct.
                $orderLineToSave = [
                    'productVariationId' => $product->productVariations[0]->id, 
                    'orderId' => $orderResult->id,
                    'price' => $productFromDB->price, 
                    'discountPercent' => $productFromDB->discountPercent
                    // 'priceWithDiscount' =>
                ];
                
                $orderLineResult = $orderLineService->createOrderLine($orderLineToSave); // Save orderline in the database.
            }

            //Get orderlines joined with product_variation and products from the database.
            $joinedOrderLines = $orderLineService->getOrderLinesForOrder($orderResult->id); 

            // $joinedOrderLinesConverted = $orderLineService->convertJoinedToCamelCase($joinedOrderLines); //Use this if values are added using snake case. Convert joinedOrderLines to camel case.
            $orderConverted = $orderService->convertToOrderArray($orderResult); //Convert attribute names to camel case.
            $orderConverted['orderLines'] = $joinedOrderLines; //Use joinedOrderLinesConverted if values are added using snake case. Set orderLine so they will be sent to the user along with the order.
            // $orderConverted['paymentInfo'] = $paymentInfoResult;

            echo json_encode($orderConverted);
            return json_encode($orderConverted);
        }
    }
    // if($requestMethod == 'GET') { //Gets all products. If queryparameter ?user=someUserId is present, all orders for that user will be returned.
    //     $userId = $_GET['user'];//Try to get user query parameter.
    //     $ordersToReturn = $orderService->getAllOrders($userId);

        // $ordersToReturn = [];
        // foreach($orders as $o) { //Loop through the products.
        //     $orderConverted = $orderService->convertToOrderArray($o); //Convert attribute names to camel case.
        //     array_push($ordersToReturn, $orderConverted);
        // }

        // echo json_encode($ordersToReturn);
        // return json_encode($ordersToReturn);
    // }