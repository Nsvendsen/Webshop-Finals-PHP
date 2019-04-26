<?php
    require_once '../services/ItemService.php';
    include_once '../models/Item.php';

    /* Some things to consider:
        How do we make the actual endpoints? Use the _POST['nameOfInputField'] object?
    */

    $requestMethod = $_SERVER['REQUEST_METHOD'];

    if($requestMethod == 'GET') {
        // if(isset($_POST['submit'])) {    
        //     $name = $_POST["name"];
        // }

        //TEST
        $testItem = new Item();
        $testItem->$name = "TEST";
        echo $testItem->$name;
    }

    if($requestMethod == 'POST') {

    }

    if($requestMethod == 'PUT') {

    }

    if($requestMethod == 'DELETE') {

    }

    /* Pseudocode
    $itemService = new ItemService();

    //Endpoint GET 
    function getItems(){
        return $itemService.getAllItems();
    }

    //Endpoint GET one item localhost/item/1
    function getOneItem(){
        return $itemService.getItemById($pathparam);
    }
    */