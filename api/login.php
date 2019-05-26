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

    $requestMethod = $_SERVER['REQUEST_METHOD']; //For example: GET

    $userService = new UserService();

    // https://security.stackexchange.com/questions/147188/is-it-bad-practice-to-use-get-method-as-login-username-password-for-administrato use post for login attempt
    if($requestMethod == 'POST') { 
        $request_body = file_get_contents('php://input'); //Get form data.
        $loginInfo = json_decode($request_body); //Convert from json to php array.

        $resultUser = $userService->login($loginInfo); //Try to find user with the entered username and password.
        if($resultUser) {
            $user = $userService->convertToUserArray($resultUser); //Convert attribute names to camel case.
            if(!$user){
                // header("HTTP/1.1 404 NOT FOUND");
                http_response_code(401); //Error code 401 Unauthorized if login failed.
            }
            else {
                echo json_encode($user); 
                return json_encode($user); //Convert from php array to json.
            }
        }
    }