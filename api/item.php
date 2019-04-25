<?php
    require_once '../services/ItemService.php';

    /* Some things to consider:
        How do we make the actual endpoints? Use the _POST['nameOfInputField'] object?
    */

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