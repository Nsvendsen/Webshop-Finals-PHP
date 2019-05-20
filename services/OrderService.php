<?php
    require_once '../config/Database.php';
    
    // Interface to ensure these methods are implemented.
    interface iOrderService {
        public function convertToOrderArray($order);
        public function getAllOrders();
        public function getOrderById($orderId);
        public function createOrder($order);
        // public function refundOrder($orderId);
    }

    class OrderService implements iOrderService {
        private $conn; // Contains database connection

        function __construct() {
            $db = new Database();//Instead of connection here, simply take conn as constructor parameter?
            $this->conn = $db->connect();
        }

        //Database tables are using the snake case convention. Objects are using the camel case convention.
        // function convertToOrderArray($order) {
        //     //Set Order properties
        //     $orderArray = [
        //         'id' => $order->id,
        //         'orderState' => $order->orderState
        //     ];
        //     return $orderArray;
        // }

        // Get order ready to be sent to user.
        function convertToOrderArray($order, $orderLines) {
            //Set Order properties
            $orderArray = [
                'id' => $order->id,
                'orderState' => $order->orderState,
                'orderLines' => $orderLines
            ];
            return $orderArray;
        }

        // Order database functions
        function getAllOrders() { 
            if($this->conn) {
                $sql = 'SELECT * FROM orders';
                $stmt = $this->conn->prepare($sql);
                $success = $stmt->execute(); 
                if($success) {
                    $orders = $stmt->fetchAll();
                }
                // else {
                //     return $success;
                // }
            }
            return $orders;
        }

        function getOrderById($orderId) {
            if($this->conn) {
                $sql = 'SELECT * FROM orders WHERE id = ? LIMIT 1';
                $stmt = $this->conn->prepare($sql);
                $success = $stmt->execute([$orderId]);
                if($success) { // true or false
                    $order = $stmt->fetch();
                }
            }
            return $order;
        }

        function createOrder($order) {
            if($this->conn) {
                $sql = 'INSERT INTO orders (payment_info_id, user_id) VALUES (:payment_info_id, :user_id)'; 
                $stmt = $this->conn->prepare($sql);
                $success = $stmt->execute([
                    ':payment_info_id' => $order->paymentInfoId, 
                    // ':order_state' => $order->orderState, 
                    ':user_id' => $order->userId
                ]); //Named parameters

                if($success) {
                    $newOrderId = $this->conn->lastInsertId(); //Fetch the inserted object to get the object with an id.
                    return $this->getOrderById($newOrderId);
                }
            }
            // return $newOrder;
        }

        function changeOrderState($orderState, $orderId) {
            if($this->conn) {
                $sql = 'UPDATE products SET order_state = ? WHERE id = ?';
                $stmt = $this->conn->prepare($sql);
                $success = $stmt->execute([$orderState, $orderId]);
                if($success) {
                    return $success;
                }
            }
        }
    }