<?php
    // include_once '../models/Item.php'; 

    // // $item = new Item();
    // $person = array("name"=>"Jakob", "age"=>25);
    // if($person->$id){
    //     echo "ID";
    // }
    // else{
    //     echo "NO ID";
    // }


    // $item = new Item();

    // $item->setName("Jakob");
    // echo $item->name;

    $requestMethod = $_SERVER['REQUEST_METHOD'];
    $requestURI = $_SERVER['REQUEST_URI'];
    echo $requestURI . $requestMethod;
    

    // $query = parse_url($requestURI, PHP_URL_QUERY);
    // // echo $query;
    // parse_str($query, $output);
    // var_dump($output);

    // $arr = [1,2,3,4,5];
    // $etnummer = 1;
    // echo json_encode($arr);

    // echo $etnummer;

    // $arr2 = [
    //     'id' => 1, 
    //     'name' => 'sko',
    //     1,
    //     2,
    //     3
    // ];
    // echo json_encode($arr2);

    