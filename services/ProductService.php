<?php
    require_once '../config/Database.php';
    
    // Interface to ensure these methods are implemented.
    interface iProductService {
        public function convertToProductArray($product);
        public function getAllProducts();
        public function getProductById($productId);
        public function deleteProductById($productId);
        public function updateProductById($productId);
        public function getProductsByCategory($category);
    }

    class ProductService implements iProductService {
        private $conn; // Contains database connection

        function __construct() {
            $db = new Database();
            $this->conn = $db->connect();
        }

        //Database tables are using the snake case convention. Objects are using the camel case convention. 
        function convertToProductArray($product) {
            //Set Product properties
            $productArray = [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'isActive' => (int)$product->is_active, //Might fail
                'category' => $product->category,
                'price' => $product->price,
                'discountPercent' => $product->discount_percent,
                'dateTimeCreated' => $product->date_time_created,
                'dateTimeUpdated' => $product->date_time_updated,
                'activeFromDate' => $product->active_from_date,
                'expirationDate' => $product->expiration_date
            ];
            return $productArray;
        }

        // Product database functions
        function getAllProducts() { 
            if($this->conn) {
                $sql = 'SELECT * FROM products';
                $stmt = $this->conn->prepare($sql);
                $success = $stmt->execute(); 
                if($success) {
                    $products = $stmt->fetchAll();
                }
                // else {
                //     return $success;
                // }
            }
            return $products;
        }

        function getProductById($productId) {
            if($this->conn) {
                $sql = 'SELECT * FROM products WHERE id = ? LIMIT 1';
                $stmt = $this->conn->prepare($sql);
                $success = $stmt->execute([$productId]);
                if($success) { // true or false
                    $product = $stmt->fetch();
                }
            }
            return $product;
        }

        function createProduct($product){
            if($this->conn) {
                $sql = 'INSERT INTO products (name, price, description, is_active, category) VALUES (:name, :price, :description, :is_active, :category)'; 
                $stmt = $this->conn->prepare($sql);
                $success = $stmt->execute([
                    ':name' => $product->name, 
                    ':price' => $product->price, 
                    ':description' => $product->description, 
                    ':is_active'=> $product->isActive,
                    ':category' => $product->category
                    // ':active_from_date'=>$product->activeFromDate,
                    // ':expiration_date'=>$product->expirationDate
                
                ]); //Named parameters

                if($success) {
                    $newProductId = $this->conn->lastInsertId(); //Fetch the inserted object to get the object with an id.
                    return $this->getProductById($newProductId);
                }
            }
            // return $newProduct;
        }

        function deleteProductById($productId) {
            if($this->conn) {
                $sql = 'DELETE FROM products WHERE id = ? LIMIT 1'; //Positional parameters
                $stmt = $this->conn->prepare($sql);
                $success = $stmt->execute([$productId]); //Positional parameters
            }
            return $success; // true or false
        }

        function updateProductById($product) {
            if($this->conn) {
                // $currentDateTime = date('Y-m-d H:i:s'); // Get current date.
                // $sql = 'UPDATE products SET name = ?, price = ?, description = ?, is_active = ?, category = ? WHERE id = ?';
                // $stmt = $this->conn->prepare($sql);
                // $success = $stmt->execute([$product->name, $product->price, $product->description, $product->isActive, $product->category, $product->id]);//some things removed.

                $sql = 'UPDATE products SET name = :name, price = :price, description = :description, is_active = :is_active, category = :category WHERE id = :id';
                $stmt = $this->conn->prepare($sql);
                $success = $stmt->execute([
                    ':name' => $product->name, 
                    ':price' => $product->price, 
                    ':description' => $product->description, 
                    ':is_active' => $product->isActive, 
                    ':category' => $product->category, 
                    ':id' => $product->id
                ]);//some things removed.
                if($success) {
                    // $updatedProduct = $stmt->fetch();
                    return $success;
                }
            }
            // return $updatedProduct;
        }

        function getProductsByCategory($category) {
            if($this->conn) {
                $sql = 'SELECT * FROM '.$this->tableName.' WHERE category = ?';
                $stmt = $this->conn->prepare($sql);
                $success = $stmt->execute([$category]);
                if($success) {
                    $products = $stmt->fetchAll();
                }
            }
            return $products;
        }
    }