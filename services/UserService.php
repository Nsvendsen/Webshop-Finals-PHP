<?php

require_once '../config/Database.php';

interface iUserService {
    public function convertToUserArray($user);
    public function login($loginInfo);
    public function getAllUsers();
    public function getUserById($profileId);
    public function deleteUserById($profileId);
    public function updateUserById($profileId);
    public function getUserByEmail($email); //Does this make sense?
}

class UserService implements iUserService {
    private $tableName = 'users';
    private $conn; // Contains database connection

    function __construct() {
        $db = new Database();//Instead of connection here, simply take conn as constructor parameter?
        $this->conn = $db->connect();
    }

    //Database tables are using the snake case convention. Objects are using the camel case convention. 
    function convertToUserArray($user) {
        //Set User properties
        $userArray = [
            'id' => $user->id,
            'firstName' => $user->first_name,
            'lastName' => $user->last_name,
            'address' => $user->address,
            'email' => $user->email,
            'confirmedEmail' => $user->confirmed_email,
            'password' => $user->password, //Dont send password back?
            'gender' => $user->gender,
            'dateTimeCreated' => $user->date_time_created,
            'role' => $user->role
        ];
        return $userArray;
    }

    function login($loginInfo){
        if($this->conn) {
            //Hash entered password and compare with database string?
            $sql = 'SELECT * FROM users WHERE email = ? AND password = ? LIMIT 1'; //make sure username or email is unique in the database.
            $stmt = $this->conn->prepare($sql);
            $success = $stmt->execute([$loginInfo->email, $loginInfo->password]);
            if($success){
                $user = $stmt->fetch();
                return $user;
            }
            else {
                return false; //$success;
            }
        }
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
            $sql = 'INSERT INTO users (first_name, last_name, address, zip_code, email, password, gender) VALUES (:first_name, :last_name, :address, :zip_code, :email, :password, :gender)';
            $stmt = $this->conn->prepare($sql);

            $success = $stmt->execute([
                ':first_name' => $user->firstName,
                ':last_name' => $user->lastName,
                ':address' => $user->address,
                ':zip_code' => $user->zipCode,
                ':email'=> $user->email,
                ':password'=> $user->password,
                ':gender'=>$user->gender //Role is missing. 
            ]);
            if($success) {
                $newUserId = $this->conn->lastInsertId();
                return $this->getUserById($newUserId);
            }
        }
    }
}