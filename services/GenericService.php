<?php
    require_once '../config/Database.php';
    
    /** 
     * This php document is experimental and should not be used.
    */
    // Interface to ensure these methods are implemented.
    interface iGenericService {
        public function getAll();
        public function getById($id);
        public function deleteById($id);
        public function updateById($id);
    }

    class GenericService implements iGenericService {
        private $tableName;
        private $conn; // Contains database connection

        function __construct($nameOfTable) {
            $db = new Database();
            $this->conn = $db->connect(); //Instead of connection here, simply take conn as constructor parameter?
            $this->tableName = $nameOfTable;
        }

        // Generic database functions that can be used on all models.
        function getAll() {
            if($this->conn & $this->tableName) {
                $sql = 'SELECT * FROM '.$this->tableName;
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();
                $objects = $stmt->fetchAll();
            }
            return $objects;
        }

        function getById($id) {
            if($this->conn & $this->tableName) {
                $sql = 'SELECT * FROM '.$this->tableName.' WHERE id = ?';
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([$id]);
                $items = $stmt->fetchAll();
            }
            return $items;
        }

        function deleteById($id) {
            if($this->conn & $this->tableName) {
                $sql = 'SELECT * FROM '.$this->tableName.' WHERE id = ?';
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([$id]);
                $items = $stmt->fetchAll();
            }
            return $items;
        }

        function updateById($id) {
            //Cannot be generic?
        }
    }