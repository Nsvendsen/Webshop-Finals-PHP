<?php
    class Order {
        private $conn;
        private $table = 'items';

        //Order properties
        private $id;
        private $orderState;

        //Getters and setters
        public function getId(){
            return $this->id;
        }

        public function setId($newId) {
            $this->id = $newId;
        }

        public function getOrderState(){
            return $this->orderState;
        }

        public function setOrderState($newOrderState) {
            $this->orderState = $newOrderState;
        }
    }