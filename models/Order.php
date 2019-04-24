<?php
    class Order {
        private $conn;
        private $table = 'orders';

        //Order properties
        private $id;
        private $orderState;
        private $paymentInfo;
        //private $orderLines;

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

        public function getPaymentInfo() {
            return $this->paymentInfo;
        }

        public function setPaymentInfo($newPaymentInfo) {
            $this->paymentInfo = $newPaymentInfo;
        }

        // public function getOrderLines() {
        //     return $this->orderLines;
        // }

        // public function setOrderLines($newOrderLines) {
        //     $this->orderLines = $newOrderLines;
        // }
    }