<?php
    class ProductVariation {
        //ProductVariation properties
        private $id;
        private $sku;
        private $inStock;
        private $discountPercent;
        
        // private $price;
        private $productVariationAttributes;

        //Datebase tables is using the snake case convention.
        public function fromDatabaseToAngular($productVariation){
            //Set ProductVariation properties
            $this->id = $productVariation->id;
            $this->sku = $productVariation->sku;
            $this->inStock = $productVariation->in_stock;
            $this->discountPercent = $productVariation->discount_percent;
            // $this->price = $productVariation->$price;
            // $this->productVariationAttributes = $productVariation->product_variation_attributes;
        }

        //Getters and setters
        public function getId(){
            return $this->id;
        }

        public function setId($newId) {
            $this->id = $newId;
        }

        public function getSku(){
            return $this->sku;
        }

        public function setSku($sku) {
            $this->sku = $newSku;
        }

        public function getInStock(){
            return $this->inStock;
        }

        public function setInStock($newInStock) {
            $this->inStock = $newInStock;
        }

        public function getDiscountPercent(){
            return $this->discountPercent;
        }

        public function setDiscountPercent($newDiscountPercent) {
            $this->discountPercent = $newDiscountPercent;
        }

        // public function getPrice(){
        //     return $this->price;
        // }

        // public function setPrice($newPrice) {
        //     $this->price = $newPrice;
        // }

        public function getProductVariationAttributes(){
            return $this->productVariationAttributes;
        }

        public function setProductVariationAttributes($newProductVariationAttributes){
            $this->productVariationAttributes = $newProductVariationAttributes;
        }
    }