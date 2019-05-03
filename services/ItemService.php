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

        function createItem($item){
            if($this->conn) {
                // $dateTimeCreated = date('Y-m-d H:i:s'); // Get current date.
                // $sql = 'INSERT INTO items (name, in_stock, price, description, category) VALUES (?, ?, ?, ?, ?)';
                $sql = 'INSERT INTO items (name, in_stock, price, description, is_active, category, expiration_date) VALUES (:name, :in_stock, :price, :description, :is_active, :category, :expiration_date)'; 
                $stmt = $this->conn->prepare($sql);
                // Approach 1
                // $success = $stmt->execute([
                //     $item->name, 
                //     $item->inStock, 
                //     $item->price, 
                //     $item->description, 
                //     // $item->$isActive, 
                //     $item->category 
                //     // $item->$expirationDate, 
                //     // $currentDateTime
                // ]);//Positional parameters. use $ in front of obj variables? Alternatively use named parameters or bindParam/bindValue.

                // Approach 2
                $success = $stmt->execute([
                    ':name' => $item->name, 
                    ':in_stock' => $item->inStock, 
                    ':price' => $item->price, 
                    ':description' => $item->description, 
                    ':is_active'=> $item->isActive,
                    ':category' => $item->category,
                    ':expiration_date'=>$item->expirationDate
                    // ':date_time_created'=>$dateTimeCreated //Datetime is now created automatically 
                ]); //Named parameters

                // Approach 3
                // $stmt->bindParam();
                // $success = $stmt->execute(); //Named parameters

                if($success) {
                    $newItemId = $this->conn->lastInsertId(); //Fetch the inserted object to get the object with an id.
                    return $this->getItemById($newItemId);
                }
            }
            // return $newItem;
        }

        function deleteItemById($itemId) {
            if($this->conn) {
                // $sql = 'DELETE FROM '.$this->tableName.' WHERE id = ? LIMIT 1'; //Positional parameters
                $sql = 'DELETE FROM '.$this->tableName.' WHERE id = :id LIMIT 1'; //Named parameters
                $stmt = $this->conn->prepare($sql);
                // $success = $stmt->execute([$itemId]); //Positional parameters
                $success = $stmt->execute([':id'=>$itemId]); //Named parameters
            }
            return $success; // true or false
        }

        function updateItemById($item) {
            if($this->conn) {
                $currentDateTime = date('Y-m-d H:i:s'); // Get current date.
                $sql = 'UPDATE '.$this->tableName.' SET name = ?, in_stock = ?, price = ?, description = ?, is_active = ?, category = ?, expiration_date = ?, date_time_updated = ? WHERE id = ?';
                $stmt = $this->conn->prepare($sql);
                $success = $stmt->execute([$item->$name, $item->$inStock, $item->$price, $item->$description, $item->$isActive, $item->$category, $item->$expirationDate, $currentDateTime, $item->$id]);//use $ in front of obj variables? Alternatively use named parameters or bindParam/bindValue.
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