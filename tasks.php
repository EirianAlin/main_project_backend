<?php
	session_start();

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

    $id_user = $data["id_user"];

    $mysqli_login = mysqli_query($connect, "SELECT * FROM tasks WHERE id_user = '$id_user'");

    $result = [];

    while ($row = $mysqli_login->fetch_assoc()) {
  		array_push($result, $row);
}




	echo json_encode($result);