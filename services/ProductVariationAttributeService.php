<?php
    require_once '../config/Database.php';
    
    // Interface to ensure these methods are implemented.
    interface iProductVariationAttributeService {
        public function convertToProductVariationAttributeArray($productVariationAttribute);
        public function getProductVariationAttributesByProductVariationId($productVariationId);
        public function getProductVariationAttributeById($productVariationAttributeId);
        public function createProductVariationAttribute($productVariationAttribute);
        public function deleteProductVariationAttributeById($productVariationAttributeId);
    }

    class ProductVariationAttributeService implements iProductVariationAttributeService {
        private $conn; // Contains database connection

        function __construct() {
            $db = new Database();//Instead of connection here, simply take conn as constructor parameter?
            $this->conn = $db->connect();
        }

        function convertToProductVariationAttributeArray($productVariationAttribute){
            //Set ProductVariationAttribute properties
            $attributeArray = [
                'id' => $productVariationAttribute->id,
                'name' => $productVariationAttribute->name,
                'value' => $productVariationAttribute->value
                // 'productVariationId' => $productVariationAttribute->product_variation_id
            ];
            return $attributeArray;
        }

        // ProductVariationAttribute database functions
        function getProductVariationAttributesByProductVariationId($productVariationId) {
            if($this->conn) {
                $sql = 'SELECT * FROM product_variation_attributes WHERE product_variation_id = ?';
                $stmt = $this->conn->prepare($sql);
                $success = $stmt->execute([$productVariationId]);
                if($success) {
                    $productVariationAttributes = $stmt->fetchAll();
                    // return $productVariations;
                }
                // else {
                //     return $success;
                // }
            }
            return $productVariationAttributes;
        }

        function getProductVariationAttributeById($productVariationAttributeId) {
            if($this->conn) {
                $sql = 'SELECT * FROM product_variation_attributes WHERE id = ? LIMIT 1';
                $stmt = $this->conn->prepare($sql);
                $success = $stmt->execute([$productVariationAttributeId]);
                if($success) {
                    $productVariationAttribute = $stmt->fetch();
                }
            }
            return $productVariationAttribute;
        }

        function createProductVariationAttribute($productVariationAttribute) {
            if($this->conn) {
                $sql = 'INSERT INTO product_variation_attributes (name, value) VALUES (:name, :value)'; 
                $stmt = $this->conn->prepare($sql);
                $success = $stmt->execute([
                    ':name' => $productVariationAttribute->name, 
                    ':value' => $productVariationAttribute->value
                ]); //Named parameters
                
                if($success) {
                    $newProductVariationAttributeId = $this->conn->lastInsertId(); //Fetch the inserted object to get the object with an id.
                    return $this->getProductVariationAttributeById($newProductVariationAttributeId);
                }
            }
            // return $newProduct;
        }

        function deleteProductVariationAttributeById($productVariationAttributeId) {
            if($this->conn) {
                $sql = 'DELETE FROM product_variation_attributes WHERE id = ? LIMIT 1'; //Positional parameters
                $stmt = $this->conn->prepare($sql);
                $success = $stmt->execute([$productVariationAttributeId]); //Positional parameters
            }
            return $success; // true or false
        }
    }