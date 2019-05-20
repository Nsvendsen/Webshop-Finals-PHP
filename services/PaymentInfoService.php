<?php
    require_once '../config/Database.php';
    
    // Interface to ensure these methods are implemented.
    interface iPaymentInfoService {
        public function createPaymentInfo($paymentInfo);
        public function getPaymentInfoById($paymentInfoId);
    }

    class PaymentInfoService implements iPaymentInfoService {
        private $conn; // Contains database connection

        function __construct() {
            $db = new Database();//Instead of connection here, simply take conn as constructor parameter?
            $this->conn = $db->connect();
        }

        function createPaymentInfo($paymentInfo) {
            if($this->conn) {
                $sql = 'INSERT INTO payment_info (first_name, last_name, address, email, phone_number, zip_code, country, card_number, card_expiration_date, cvc_number, user_id) 
                        VALUES (:first_name, :last_name, :address, :email, :phone_number, :zip_code, :country, :card_number, :card_expiration_date, :cvc_number, :user_id)'; 
                $stmt = $this->conn->prepare($sql);
                $success = $stmt->execute([
                    ':first_name' => $paymentInfo->firstName, 
                    ':last_name' => $paymentInfo->lastName,
                    ':address' => $paymentInfo->address,
                    ':email' => $paymentInfo->email,
                    ':phone_number' => $paymentInfo->phoneNumber,
                    ':zip_code' => $paymentInfo->zipCode,
                    ':country' => $paymentInfo->country,
                    ':card_number' => $paymentInfo->cardNumber,
                    ':card_expiration_date' => $paymentInfo->cardExpirationDate,
                    ':cvc_number' => $paymentInfo->cvcNumber,
                    ':user_id' => $paymentInfo->userId
                ]); //Named parameters

                if($success) {
                    $newPaymentInfoId = $this->conn->lastInsertId(); //Fetch the inserted object to get the object with an id.
                    return $this->getPaymentInfoById($newPaymentInfoId);
                }
            }
            // return $newPaymentInfo;
        }

        function getPaymentInfoById($paymentInfoId) {
            if($this->conn) {
                $sql = 'SELECT * FROM payment_info WHERE id = ? LIMIT 1';
                $stmt = $this->conn->prepare($sql);
                $success = $stmt->execute([$paymentInfoId]);
                if($success) { // true or false
                    $order = $stmt->fetch();
                }
            }
            return $order;
        }
    }