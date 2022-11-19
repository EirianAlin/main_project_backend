<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$connect = mysqli_connect('127.0.0.1:3306', 'root', '', 'test') or die("Could not connect to the database");

 $body = file_get_contents('php://input');

    if (empty($body)) {
        return [];
    }

    $data = json_decode($body, true);

$name = $data["name"];
$surname = $data['surname'];
$email = $data['email'];
$password = $data['password'];
$password_repeat = $data['password_repeat'];

if ($password === $password_repeat) {
   mysqli_query($connect, "INSERT INTO users ( `name`, `surname`, `email`, `password`) VALUES ('$name', '$surname', '$email', '$password')");
}

echo json_encode(123);
