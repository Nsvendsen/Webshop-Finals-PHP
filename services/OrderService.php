<?php
    require_once '../config/Database.php';
    
    // Interface to ensure these methods are implemented.
    interface iOrderService {
        public function convertToOrderArray($order);
        public function getAllOrders(); //$userId
        public function getOrderById($orderId);
        public function createOrder($order);
        // public function changeOrderState($orderState, $orderId);
        // public function refundOrder($orderId);
    }

    class OrderService implements iOrderService {
        private $conn; // Contains database connection

        function __construct() {
            $db = new Database();//Instead of connection here, simply take conn as constructor parameter?
            $this->conn = $db->connect();
        }

        //Database tables are using the snake case convention. Objects are using the camel case convention.
        function convertToOrderArray($order) {
            //Set Order properties
            $orderArray = [
                'id' => $order->id,
                'orderState' => $order->order_state,
                //Changed
                'dateTimeCreated' => $order->date_time_created,
                'userId' => $order->user_id,
                'priceTotal' => $order->price_total
            ];
            return $orderArray;
        }

        // Order database functions
        function getAllOrders() { //$userId 
            if($this->conn) {
                $sql = 'SELECT * FROM orders';
                // $sql = 'SELECT orders.id, orders.payment_info_id, orders.order_state, orders.date_time_created, orders.user_id, order_lines.price, SUM(order_lines.price) as price_total 
                //         FROM orders INNER JOIN order_lines ON order_lines.order_id = orders.id 
                //         WHERE orders.user_id = 4 
                //         GROUP BY order_lines.id 
                //         ORDER BY orders.date_time_created DESC';

                // if($userId) { //userId is a query parameter.
                //     $sql = $sql . ' WHERE orders.user_id = ?';
                //     $stmt = $this->conn->prepare($sql);
                //     $success = $stmt->execute([$userId]); 
                // }
                // else {
                $stmt = $this->conn->prepare($sql);
                $success = $stmt->execute(); 
                // }
                if($success) {
                    $orders = $stmt->fetchAll();
                }
                // else {
                //     return $success;
                // }
            }
            return $orders;
        }

        //Get all orders for a user.
        function getAllOrdersForUser($userId) { 
            if($this->conn) {
                $sql = 'SELECT orders.id, orders.payment_info_id, orders.order_state, orders.date_time_created, orders.user_id, SUM(order_lines.price) as price_total 
                        FROM orders INNER JOIN order_lines ON order_lines.order_id = orders.id 
                        WHERE orders.user_id = ? 
                        GROUP BY orders.id 
                        ORDER BY orders.date_time_created DESC';
                $stmt = $this->conn->prepare($sql);
                $success = $stmt->execute([$userId]); 
                if($success) {
                    $orders = $stmt->fetchAll();
                }
            }
            return $orders;
        }

        function getOrderById($orderId) {
            if($this->conn) {
                //Use price_after_discount instead of price when discount is implemented.
                // $sql = 'SELECT orders.id, orders.payment_info_id, orders.order_state, orders.date_time_created, orders.user_id, SUM(order_lines.price) AS price_total
                // FROM (orders 
                // INNER JOIN order_lines ON orders.id = order_lines.order_id) 
                // WHERE orders.id = ?'; //Need to join to get total_price
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
                    ':payment_info_id' => $order['paymentInfoId'], 
                    ':user_id' => $order['userId']
                ]); //Named parameters

                if($success) {
                    $newOrderId = $this->conn->lastInsertId(); //Fetch the inserted object to get the object with an id.
                    return $this->getOrderById($newOrderId);
                }
                else {
                    return $success; //Returns false
                }
            }
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