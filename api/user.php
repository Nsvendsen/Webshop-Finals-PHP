<?php
require_once '../services/UserService.php';

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
    header('Access-Control-Allow-Headers: token, Content-Type');
    header('Access-Control-Max-Age: 1728000');
    header('Content-Length: 0');
    header('Content-Type: text/plain');
    die();
}
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestURI = $_SERVER['REQUEST_URI'];
$splitSlash = explode("/", $requestURI);
$userId = end($splitSlash);

$userService = new UserService();

if($requestMethod == 'GET') {
    if(is_numeric($userId)){
        $result = $userService->getUserById($userId);
        //Convert values to camel case before returning?
        echo json_encode($result);
        return json_encode($result);
    }else{
        $result = $userService->getAllUsers();
        //Convert values to camel case before returning?
        echo json_encode($result);
        return json_encode($result);
    }
}

if($requestMethod == 'POST') {
    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body);
    $result = $userService->createUser($data);
    //Convert values to camel case before returning?
    if($result) {
        echo json_encode($result);
        return json_encode($result);
    }
}
if($requestMethod == 'PUT') {
    if (is_numeric($userId)) {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body);
        $result = $userService->updateUserById($data);
        return json_encode($result);
    }
}
if($requestMethod == 'DELETE') {
    if (is_numeric($userId)) {
        $result = $userService->deleteUserById($data);
        return json_encode($result);
    }
}