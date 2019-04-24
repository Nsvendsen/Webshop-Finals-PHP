<?php
    class Database {
        //Pros and cons between mysqli and PDO: https://stackoverflow.com/questions/13569/mysqli-or-pdo-what-are-the-pros-and-cons
        //https://stackoverflow.com/questions/2190737/what-is-the-difference-between-mysql-mysqli-and-pdo
        // DB Information
        private $host = 'localhost';
        private $db_name = 'Webshop';
        private $username = 'root';
        private $password = 'root';
        private $conn;

        // Database Connection
        public function connect() {
            $this->conn = null;
            try {
                $this->conn = new PDO('mysql:host=' . $this->host . ';dbname= ' . $this->db_name, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e) {
                echo 'Connection Error: ' . $e->getMessage();
            }
            return $this->conn;
        }
    }