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
            $db = new Database();//Instead of connection here, simply take conn as constructor parameter?
            $this->conn = $db->connect();
        }

        //Database tables are using the snake case convention. Objects are using the camel case convention.
        function convertToProductArray($product) {
            //Set Product properties
            $productArray = [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'isActive' => $product->is_active,
                'category' => $product->category,
                'price' => $product->price,
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
                if($success) {
                    $product = $stmt->fetch();
                }
            }
            return $product;
        }

        function createProduct($product){
            if($this->conn) {
                // $dateTimeCreated = date('Y-m-d H:i:s'); // Get current date.
                // $sql = 'INSERT INTO products (name, in_stock, price, description, category) VALUES (?, ?, ?, ?, ?)';
                $sql = 'INSERT INTO products (name, in_stock, price, description, is_active, category) VALUES (:name, :in_stock, :price, :description, :is_active, :category)'; 
                $stmt = $this->conn->prepare($sql);
                $success = $stmt->execute([
                    ':name' => $product->name, 
                    ':in_stock' => $product->inStock, 
                    ':price' => $product->price, 
                    ':description' => $product->description, 
                    ':is_active'=> $product->isActive,
                    ':category' => $product->category,
                    ':expiration_date'=>$product->expirationDate
                    // ':date_time_created'=>$dateTimeCreated //Datetime is now created automatically 
                ]); //Named parameters
                
                // Approach 3
                // $stmt->bindParam();
                // $success = $stmt->execute(); //Named parameters

                if($success) {
                    $newProductId = $this->conn->lastInsertId(); //Fetch the inserted object to get the object with an id.
                    return $this->getProductById($newProductId);
                }
            }
            // return $newProduct;
        }

        function deleteProductById($productId) {
            if($this->conn) {
                // $sql = 'DELETE FROM '.$this->tableName.' WHERE id = ? LIMIT 1'; //Positional parameters
                $sql = 'DELETE FROM '.$this->tableName.' WHERE id = :id LIMIT 1'; //Named parameters
                $stmt = $this->conn->prepare($sql);
                // $success = $stmt->execute([$productId]); //Positional parameters
                $success = $stmt->execute([':id' => $productId]); //Named parameters
            }
            return $success; // true or false
        }

        function updateProductById($product) {
            if($this->conn) {
                $currentDateTime = date('Y-m-d H:i:s'); // Get current date.
                $sql = 'UPDATE '.$this->tableName.' SET name = ?, in_stock = ?, price = ?, description = ?, is_active = ?, category = ?, expiration_date = ?, date_time_updated = ? WHERE id = ?';
                $stmt = $this->conn->prepare($sql);
                $success = $stmt->execute([$product->name, $product->inStock, $product->price, $product->description, $product->isActive, $product->category, $product->expirationDate, $currentDateTime, $product->id]);//use $ in front of obj variables? Alternatively use named parameters or bindParam/bindValue.
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