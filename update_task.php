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

$id = $data["id"];
$done = $data["done"] ? 1 : 0;

$mysqli_login = mysqli_query($connect, "UPDATE  tasks SET done = '$done' WHERE id = '$id'");




