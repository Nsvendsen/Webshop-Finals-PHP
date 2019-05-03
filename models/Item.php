<?php
    class Item {
        /**
         * We need to describe why we are using OOP. Does it make sense to do that?
         */
        // private $conn;
        // private $table = 'items';

        //Item properties
        private $id;
        private $name;
        private $inStock;
        private $price;
        private $description;
        private $isActive;
        private $category;
        private $dateTimeCreated;
        private $dateTimeUpdated;
        private $expirationDate;

        //Datebase tables is using the snake case convention.
        public function fromDatabaseToAngular($item){
            //Set Item properties
            $this->id = $item->$id;
            $this->name = $item->$name;
            $this->inStock = $item->$in_stock;
            $this->price = $item->$price;
            $this->description = $item->$description;
            $this->isActive = $item->$is_active;
            $this->category = $item->$category;
            $this->dateTimeCreated = $item->$date_time_created;
            $this->dateTimeUpdated = $item->$date_time_updated;
            $this->expirationDate = $item->$expiration_date;
        }

        //Angular and php models is using the camel case convention.
        public function fromAngularToDatabase($item){
            //Set Item properties
            $this->id = $item->$id;
            $this->name = $item->$name;
            $this->inStock = $item->$inStock;
            $this->price = $item->$price;
            $this->description = $item->$description;
            $this->isActive = $item->$isActive;
            $this->category = $item->$category;
            // $this->dateTimeCreated = $item->$dateTimeCreated;
            // $this->dateTimeUpdated = $item->$dateTimeUpdated;
            $this->expirationDate = $item->$expirationDate;
        }

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

        public function getExpirationDate(){
            return $this->expirationDate;
        }

        public function setExpirationDate($newExpirationDate) {
            $this->expirationDate = $newExpirationDate;
        }
    }