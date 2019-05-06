<?php
    class Product {
        //Product properties
        private $id;
        private $name;
        private $description;
        private $isActive;
        private $category;
        private $price;
        private $dateTimeCreated;
        private $dateTimeUpdated;
        private $activeFromDate;
        private $expirationDate;
        
        private $productVariations; //Supposed to contain ProductVariation array

        function __construct($product) {
            //Database tables are using the snake case convention. Objects are using the camel case convention.
            //Set Product properties
            $this->id = $product->id;
            $this->name = $product->name;
            $this->description = $product->description;
            $this->isActive = $product->is_active;
            $this->category = $product->category;
            $this->price = $product->price;
            $this->dateTimeCreated = $product->date_time_created;
            $this->dateTimeUpdated = $product->date_time_updated;
            $this->activeFromDate = $product->active_from_date;
            $this->expirationDate = $product->expiration_date;
        }

        //Database tables is using the snake case convention.
        // public function setAllProperties($product){
        //     //Set Product properties
        //     $this->id = $product->id;
        //     $this->name = $product->name;
        //     $this->description = $product->description;
        //     $this->isActive = $product->is_active;
        //     $this->category = $product->category;
        //     $this->price = $product->price;
        //     $this->dateTimeCreated = $product->date_time_created;
        //     $this->dateTimeUpdated = $product->date_time_updated;
        //     $this->activeFromDate = $product->active_from_date;
        //     $this->expirationDate = $product->expiration_date;
        // }

        //Getters and setters
        public function getId(){
            return $this->id;
        }

        public function setId($newId) {
            $this->id = $newId;
        }

        public function getName(){
            return $this->name;
        }

        public function setName($newName) {
            $this->name = $newName;
        }

        public function getInStock(){
            return $this->inStock;
        }

        public function setInStock($newInStock) {
            $this->inStock = $newInStock;
        }

        public function getPrice(){
            return $this->price;
        }

        public function setPrice($newPrice) {
            $this->price = $newPrice;
        }

        public function getDescripton(){
            return $this->description;
        }

        public function setDescription($newDescription) {
            $this->description = $newDescription;
        }

        public function isActive(){
            return $this->isActive;
        }

        public function setActive($newIsActive) {
            $this->isActive = $newIsActive;
        }

        public function getCategory(){
            return $this->category;
        }

        public function setCategory($newCategory) {
            $this->category = $newCategory;
        }

        public function getDateTimeCreated(){
            return $this->dateTimeCreated;
        }

        public function setDateTimeCreated($newDateTimeCreated) {
            $this->dateTimeCreated = $newDateTimeCreated;
        }

        public function getDateTimeUpdated(){
            return $this->dateTimeUpdated;
        }

        public function setDateTimeUpdated($newDateTimeUpdated) {
            $this->dateTimeUpdated = $newDateTimeUpdated;
        }

        public function getActiveFromDate(){
            return $this->activeFromDate;
        }

        public function setActiveFromDate($newActiveFromDate) {
            $this->activeFromDate = $newActiveFromDate;
        }

        public function getExpirationDate(){
            return $this->expirationDate;
        }

        public function setExpirationDate($newExpirationDate) {
            $this->expirationDate = $newExpirationDate;
        }

        public function getProductVariations(){
            return $this->productVariations;
        }

        public function setProductVariations($newProductVariations) {
            $this->productVariations = $newProductVariations;
        }
    }