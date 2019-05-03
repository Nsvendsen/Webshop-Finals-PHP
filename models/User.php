<?php
class User{

    //user properties
    private $id;
    private $firstName;
    private $lastName;
    private $address;
    private $zipCode;
    private $email;
    private $confirmedEmail;
    private $gender;

    public function fromAngularToDatabase($user){
        //Set Item properties
        $this->id = $user->$id;
        $this->firstName = $user->$firstName;
        $this->lastName = $user->$lastName;
        $this->address = $user->$address;
        $this->zipCode = $user->$zipCode;
        $this->email = $user->$email;
        $this->confirmedEmail = $user->$confirmedEmail;
        $this->gender = $user->$gender;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getZipCode()
    {
        return $this->zipCode;
    }

    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getConfirmedEmail()
    {
        return $this->confirmedEmail;
    }

    public function setConfirmedEmail($confirmedEmail)
    {
        $this->confirmedEmail = $confirmedEmail;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function setGender($gender)
    {
        $this->gender = $gender;
    }
}