<?php
    class OrderLine {
        private $conn;
        private $table = 'order_lines';

        //Order properties
        private $id;
        private $addedToCart;
        private $refunded;
        private $refundedAt;
        private $order;
        private $item;

        /**
         * @return mixed
         */
        public function getConn()
        {
            return $this->conn;
        }

        /**
         * @param mixed $conn
         */
        public function setConn($conn)
        {
            $this->conn = $conn;
        }

        /**
         * @return string
         */
        public function getTable()
        {
            return $this->table;
        }

        /**
         * @param string $table
         */
        public function setTable($table)
        {
            $this->table = $table;
        }

        /**
         * @return mixed
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * @param mixed $id
         */
        public function setId($id)
        {
            $this->id = $id;
        }

        /**
         * @return mixed
         */
        public function getAddedToCart()
        {
            return $this->addedToCart;
        }

        /**
         * @param mixed $addedToCart
         */
        public function setAddedToCart($addedToCart)
        {
            $this->addedToCart = $addedToCart;
        }

        /**
         * @return mixed
         */
        public function getRefunded()
        {
            return $this->refunded;
        }

        /**
         * @param mixed $refunded
         */
        public function setRefunded($refunded)
        {
            $this->refunded = $refunded;
        }

        /**
         * @return mixed
         */
        public function getRefundedAt()
        {
            return $this->refundedAt;
        }

        /**
         * @param mixed $refundedAt
         */
        public function setRefundedAt($refundedAt)
        {
            $this->refundedAt = $refundedAt;
        }

        /**
         * @return mixed
         */
        public function getOrder()
        {
            return $this->order;
        }

        /**
         * @param mixed $order
         */
        public function setOrder($order)
        {
            $this->order = $order;
        }

        /**
         * @return mixed
         */
        public function getItem()
        {
            return $this->item;
        }

        /**
         * @param mixed $item
         */
        public function setItem($item)
        {
            $this->item = $item;
        }

        //Getters and setters
        
    }