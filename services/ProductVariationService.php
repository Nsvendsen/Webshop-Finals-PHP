<?php
    require_once '../config/Database.php';
    
    // Interface to ensure these methods are implemented.
    interface iProductVariationService {
        public function convertToProductVariationArray($productVariation);
        public function getProductVariationsByProductId($productId);
        public function getProductVariationById($productVariationId);
        public function createProductVariation($productVariation);
        public function deleteProductVariationById($productVariationId);
        // public function updateProductVariationById($productVariation);
    }

    class ProductVariationService implements iProductVariationService {
        private $conn; // Contains database connection

        function __construct() {
            $db = new Database();
            $this->conn = $db->connect();
        }

        function convertToProductVariationArray($productVariation){
            //Set ProductVariation properties
            $variationArray = [
                'id' => $productVariation->id,
                'sku' => $productVariation->sku,
                'inStock' => $productVariation->in_stock,
                'size' => $productVariation->size
            ];
            return $variationArray;
        }

        // ProductVariation database functions
        function getProductVariationsByProductId($productId) {
            if($this->conn) {
                $sql = 'SELECT * FROM product_variations WHERE product_id = ?';
                $stmt = $this->conn->prepare($sql);
                $success = $stmt->execute([$productId]);
                if($success) {
                    $productVariations = $stmt->fetchAll();
                    // return $productVariations;
                }
                // else {
                //     return $success;
                // }
            }
            return $productVariations;
        }

        function getProductVariationById($productVariationId) {
            if($this->conn) {
                $sql = 'SELECT * FROM product_variations WHERE id = ? LIMIT 1';
                $stmt = $this->conn->prepare($sql);
                $success = $stmt->execute([$productVariationId]);
                if($success) {
                    $productVariation = $stmt->fetch();
                }
            }
            return $productVariation;
        }

        function createProductVariation($productVariation) {
            if($this->conn) {
                $sql = 'INSERT INTO product_variations (in_stock, sku, product_id, size) VALUES (:in_stock, :sku, :product_id, :size)'; 
                $stmt = $this->conn->prepare($sql);
                $success = $stmt->execute([
                    ':in_stock' => $productVariation->inStock, 
                    ':sku' => $productVariation->sku, 
                    ':product_id' => $productVariation->productId,
                    ':size' => $productVariation->size
                ]); //Named parameters

                // $sql = 'INSERT INTO product_variations (in_stock, sku, product_id, size) VALUES (?, ?, ?, ?)'; //size
                // $stmt = $this->conn->prepare($sql);
                // $success = $stmt->execute([
                //     $productVariation->inStock, 
                //     $productVariation->sku, 
                //     $productVariation->productId,
                //     $productVariation->size
                // ]); //Positional parameters
                
                if($success) {
                    $newProductVariationId = $this->conn->lastInsertId(); //Fetch the inserted object to get the object with an id.
                    return $this->getProductVariationById($newProductVariationId);
                }
            }
            // return $newProduct;
        }

        function deleteProductVariationById($productVariationId) {
            if($this->conn) {
                $sql = 'DELETE FROM product_variations WHERE id = ? LIMIT 1'; //Positional parameters
                // $sql = 'DELETE FROM '.$this->tableName.' WHERE id = :id LIMIT 1'; //Named parameters
                $stmt = $this->conn->prepare($sql);
                $success = $stmt->execute([$productVariationId]); //Positional parameters
                // $success = $stmt->execute([':id' => $productVariationId]); //Named parameters
            }
            return $success; // true or false
        }

        // function updateProductVariationById($productVariation) {
        //     if($this->conn) {
        //         // $currentDateTime = date('Y-m-d H:i:s'); // Get current date.
        //         $sql = 'UPDATE '.$this->tableName.' SET name = ?, in_stock = ?, price = ?, description = ?, is_active = ?, category = ?, expiration_date = ?, date_time_updated = ? WHERE id = ?';
        //         $stmt = $this->conn->prepare($sql);
        //         $success = $stmt->execute([$product->name, $product->inStock, $product->price, $product->description, $product->isActive, $product->category, $product->expirationDate, $currentDateTime, $product->id]);//use $ in front of obj variables? Alternatively use named parameters or bindParam/bindValue.
        //         if($success) {
        //             // $updatedProduct = $stmt->fetch();
        //             return $success;
        //         }
        //     }
        //     // return $updatedProduct;
        // }
    }