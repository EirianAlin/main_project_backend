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

$id_user = $data['id_user'];
$text = $data["text"];
$type = $data['type'];
$done = $data['done'] ? 1 : 0;

$mysqli_query = $connect->query( "INSERT INTO tasks ( `id_user`, `text`, `type`, `done`) VALUES ('$id_user', '$text', '$type', '$done')");

$result = [
	'text' => $data["text"],
	'id_user' => $data["id_user"],
	'type' => $data["type"],
	'done' => $data["done"],
	'id' => $connect->insert_id,
];

echo json_encode($result);
