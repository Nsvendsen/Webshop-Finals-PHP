<?php

require_once '../config/Database.php';

interface iUserService {
    public function getAllUsers();
    public function getUserById($profileId);
    public function deleteUserById($profileId);
    public function updateUserById($profileId);
    public function getUserByEmail($email); //giver denne mening?
}

class UserService implements iUserService {
    private $tableName = 'users';
    private $conn; // Contains database connection

    function __construct() {
        $db = new Database();//Instead of connection here, simply take conn as constructor parameter?
        $this->conn = $db->connect();
    }
    function getAllUsers(){
        if($this->conn) {
            $sql = 'SELECT * FROM '.$this->tableName;
            $stmt = $this->conn->prepare($sql);
            $success = $stmt->execute();
            if($success){
                $users = $stmt->fetchAll();
            }
        }
        return $users;
    }
    function getUserById($userId){
        if($this->conn) {
            $sql = 'SELECT * FROM '.$this->tableName.' WHERE id = ? LIMIT 1';
            $stmt = $this->conn->prepare($sql);
            $success = $stmt->execute([$userId]);
            if($success){
                $user = $stmt->fetch();
            }
        }
        return $user;
    }
    function deleteUserById($userId){
        if($this->conn) {
            $sql = 'DELETE FROM '.$this->tableName.' WHERE id = :id LIMIT 1'; //Named parameters
            $stmt = $this->conn->prepare($sql);
            $success = $stmt->execute([':id'=>$userId]); //Named parameters
        }
        return $success;
    }
    function updateUserById($user){
        if($this->conn) {
            $sql = 'UPDATE '.$this->tableName.' SET first_name = ?, last_name = ?, address = ?, zip_code = ?, email = ?, confirmed_email = ?, gender = ?  WHERE id = ?';
            $stmt = $this->conn->prepare($sql);
            $success = $stmt->execute([$user->$first_name, $user->$last_name, $user->$address, $user->$zip_code, $user->$email, $user->$confimed_email, $user->$gender, $user->$id]);//use $ in front of obj variables? Alternatively use named parameters or bindParam/bindValue.
            if($success) {
                $updatedUser = $stmt->fetch();
            }
        }
        return $updatedUser;
    }
    function getUserByEmail($email){
        if($this->conn) {
            $sql = 'SELECT * FROM '.$this->tableName.' WHERE email = ?';
            $stmt = $this->conn->prepare($sql);
            $success = $stmt->execute($email);
            if($success) {
                $user = $stmt->fetch();
            }
        }
        return $user;
    }
    function createUser($user){
        if($this->conn) {
            $sql = 'INSERT INTO users (first_name, last_name, address, zip_code, email, confirmed_email, gender) VALUES (:first_name, :last_name, :address, :zip_code, :email, :confirmed_email, :gender)';
            $stmt = $this->conn->prepare($sql);

            $success = $stmt->execute([
                ':first_name' => $user->firstName,
                ':last_name' => $user->lastName,
                ':address' => $user->address,
                ':zip_code' => $user->zipCode,
                ':email'=> $user->email,
                ':confirmed_email' => $user->confirmed_email,
                ':gender'=>$user->gender
            ]);
            if($success) {
                $newUserId = $this->conn->lastInsertId();
                return $this->getUserById($newUserId);
            }
        }
    }
}