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

    $out = [
      'error' => false,
      'message' => "Login Succesful!",
      'name' => null,
      'id_user' => '',
   ];

$email = $data["email"];
$password = $data['password'];

if ($email && $password) {
   $mysqli_login = mysqli_query($connect, "SELECT * FROM users WHERE email = '$email' and password = '$password'");
   // var_dump($mysqli_login);

   if ($mysqli_login->num_rows <= 0) {
      $out['error'] = true;
      $out['message'] = "Вы не зарегистрированы!";
   } 
   else {
      while ($row = mysqli_fetch_assoc($mysqli_login)) {
      $out['name'] = $row["name"];
      $out['id_user'] = $row["id"];
      $out['surname'] = $row["surname"];
      }
   }
   
} else {
   $out['error'] = true;
   $out['message'] = "Введите логин и пароль!";
}

// $connect->close();

echo json_encode($out);
die();


