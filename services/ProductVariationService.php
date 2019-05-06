<?php
    require_once '../config/Database.php';
    
    // Interface to ensure these methods are implemented.
    interface iProductVariationService {
        public function convertToProductVariationArray($productVariation);
        public function getProductVariationsByProductId($productId);
    }

    class ProductVariationService implements iProductVariationService {
        private $conn; // Contains database connection

        function __construct() {
            $db = new Database();//Instead of connection here, simply take conn as constructor parameter?
            $this->conn = $db->connect();
        }

        function convertToProductVariationArray($productVariation){
            //Set ProductVariation properties
            $productArray = [
                'id' => $productVariation->id,
                'sku' => $productVariation->sku,
                'inStock' => $productVariation->in_stock,
                'discountPercent' => $productVariation->discount_percent
            ];
            return $productArray;
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
    }