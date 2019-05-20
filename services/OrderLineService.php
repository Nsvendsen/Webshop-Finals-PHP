<?php
    require_once '../config/Database.php';
    
    // Interface to ensure these methods are implemented.
    interface iOrderLineService {
        public function convertToOrderLineArray($orderLine);
        // public function getAllOrderLines();
        public function getOrderLinesForOrder($orderId);
        public function getOrderLineById($orderLineId);
        public function createOrderLine($orderLine);
    }

    class OrderLineService implements iOrderLineService {
        private $conn; // Contains database connection

        function __construct() {
            $db = new Database();//Instead of connection here, simply take conn as constructor parameter?
            $this->conn = $db->connect();
        }

        //Fix
        //Database tables are using the snake case convention. Objects are using the camel case convention. 
        function convertToOrderLineArray($orderLine) {
            //Set OrderLine properties
            $orderLineArray = [
                'id' => $orderLine->id,
                'productVariationId' => $orderLine->productVariationId, //Exclude this and add the object instead?
                // 'orderId' => $orderLine->orderId,
                'price' => $orderLine->price,
                'discountPercent' => $orderLine->discountPercent
            ];
            return $orderLineArray;
        }

        //Database tables are using the snake case convention. Objects are using the camel case convention. 
        function convertJoinedToCamelCase($joinedOrderLines) { //Joined orderlines consists of data from 3 tables: order_lines, product_variations and products.
            //Set joined OrderLine properties
            $orderLineArray = [ //No difference between camel case and snake case here!
                'id' => $orderLine->id,
                'price' => $orderLine->price,
                'sku' => $orderLine->sku,
                'size' => $orderLine->size,
                'name' => $orderLine->name,
            ];
            return $orderLineArray;
        }

        // // OrderLine database functions
        // function getAllOrderLines() { 
        //     if($this->conn) {
        //         $sql = 'SELECT * FROM order_lines';
        //         $stmt = $this->conn->prepare($sql);
        //         $success = $stmt->execute(); 
        //         if($success) {
        //             $orderLines = $stmt->fetchAll();
        //         }
        //         // else {
        //         //     return $success;
        //         // }
        //     }
        //     return $orderLines;
        // }

        // OrderLine database functions
        function getOrderLinesForOrder($orderId) { 
            if($this->conn) {
                //What should orderline contain? This returns a list of orderlines which consists of data from 3 tables.
                $sql = 'SELECT order_lines.id, order_lines.price, product_variations.sku, product_variations.size, products.name
                        FROM ((order_lines 
                        INNER JOIN product_variations ON order_lines.product_variation_id = product_variations.id) 
                        INNER JOIN products ON product_variations.product_id = products.id) 
                        WHERE order_lines.order_id = ?';
                $stmt = $this->conn->prepare($sql);
                $success = $stmt->execute([$orderId]); 
                if($success) {
                    $orderLines = $stmt->fetchAll();
                }
            }
            return $orderLines;
        }

        function getOrderLineById($orderLineId) {
            if($this->conn) {
                $sql = 'SELECT * FROM order_lines WHERE id = ? LIMIT 1';
                $stmt = $this->conn->prepare($sql);
                $success = $stmt->execute([$orderLineId]);
                if($success) { // true or false
                    $orderLine = $stmt->fetch();
                }
            }
            return $orderLine;
        }

        function createOrderLine($orderLine) {
            if($this->conn) {
                $sql = 'INSERT INTO order_lines (product_variation_id, order_id, price, discount_percent) 
                        VALUES (:product_variation_id, :order_id, :price, :discount_percent)'; 
                // $sql = 'INSERT INTO order_lines (product_variation_id, order_id, price, discount_percent) VALUES (?, ?, ?, ?)'; //Positional parameters
                $stmt = $this->conn->prepare($sql);
                $success = $stmt->execute([
                    ':product_variation_id' => $orderLine['productVariationId'], 
                    ':order_id' => $orderLine['orderId'],
                    ':price' => $orderLine['price'],
                    ':discount_percent' => $orderLine['discountPercent']
                ]); //Named parameters

                // $success = $stmt->execute([
                //     $orderLine['productVariationId'], 
                //     $orderLine['orderId'],
                //     $orderLine['price'],
                //     $orderLine['discountPercent']
                // ]); //Positional parameters

                if($success) {
                    $newOrderLineId = $this->conn->lastInsertId(); //Fetch the inserted object to get the object with an id.
                    return $this->getOrderLineById($newOrderLineId);
                }
            }
            // return $newOrderLine;
        }
    }