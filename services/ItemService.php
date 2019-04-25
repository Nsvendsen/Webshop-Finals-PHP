<?php
    // include '../models/Item.php'; //Gives warning if file is not found. add paranthesis?
    // require 'Item.php'; //Crashes if file is not found
    // include_once
    // require_once '../models/Item.php';
    require_once '../config/Database.php';
    
    // Interface to ensure these methods are implemented.
    interface iItemService {
        public function getAllItems();
        public function getItemById($itemId);
        public function deleteItemById($itemId);
        public function updateItemById($itemId);
        public function getItemsByCategory($category);
    }

    class ItemService implements iItemService {
        private $tableName = 'items';
        private $conn; // Contains database connection

        function __construct() {
            $db = new Database();//Instead of connection here, simply take conn as constructor parameter?
            $this->conn = $db->connect();
        }

        // Item database functions
        function getAllItems() {
            if($this->conn) {
                $sql = 'SELECT * FROM '.$this->tableName;
                $stmt = $this->conn->prepare($sql);
                $success = $stmt->execute();
                if($success){
                    $items = $stmt->fetchAll();
                }
            }
            return $items;
        }

        function getItemById($itemId) {
            if($this->conn) {
                $sql = 'SELECT * FROM '.$this->tableName.' WHERE id = ? LIMIT 1';
                $stmt = $this->conn->prepare($sql);
                $success = $stmt->execute([$itemId]);
                if($success){
                    $item = $stmt->fetch();
                }
            }
            return $item;
        }

        function deleteItemById($itemId) {
            if($this->conn) {
                $sql = 'DELETE FROM '.$this->tableName.' WHERE id = ? LIMIT 1';
                $stmt = $this->conn->prepare($sql);
                $success = $stmt->execute([$itemId]);
            }
            return $success; // true or false
        }

        function updateItemById($item) {
            if($this->conn) {
                $sql = 'UPDATE '.$this->tableName.' SET name = ?, in_stock = ?, price = ?, description = ?, is_active = ?, category = ?, expiration_date = ? WHERE id = ?';
                $stmt = $this->conn->prepare($sql);
                $success = $stmt->execute([$item->name, $item->inStock, $item->price, $item->description, $item->isActive, $item->category, $item->expirationDate], $item->id);//use $ in front of obj variables? Alternatively use named parameters.
                if($success) {
                    $updatedItem = $stmt->fetch();
                }
            }
            return $updatedItem;
        }

        function getItemsByCategory($category) {
            if($this->conn) {
                $sql = 'SELECT * FROM '.$this->tableName.' WHERE category = ?';
                $stmt = $this->conn->prepare($sql);
                $success = $stmt->execute([$category]);
                if($success) {
                    $items = $stmt->fetchAll();
                }
            }
            return $items;
        }
    }