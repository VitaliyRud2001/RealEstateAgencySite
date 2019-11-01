<?php
include "scripts/mysql-connect.php";
date_default_timezone_set('UTC');

$id = $_POST["id"];
$name = $_POST["name"];
$last_name = $_POST["last_name"];
$date_from = $_POST["date_from"];
$date_to = $_POST["date_to"];
$country_code = $_POST["country_code"];
$phone = $_POST["telephone"];




$obj = new mysql_connect("127.0.0.1","root","","vitafortuna_update");
$obj->connectToDatabase();

$stmt = mysqli_prepare($obj->conn,"INSERT INTO users VALUES (NULL,?,?)");
$stmt->bind_param("ss",$name,$last_name);
$stmt->execute();
$id_auto_incremented = $stmt->insert_id;
$stmt = mysqli_prepare($obj->conn,"INSERT INTO phones_users VALUES (NULL,?,?,?)");
$stmt->bind_param("iii",$id_auto_incremented,$country_code,$phone);
$stmt->execute();
$stmt = mysqli_prepare($obj->conn,"INSERT INTO terms VALUES(NULL,?,?,?,?)");
$stmt->bind_param("iiii",$id,$id_auto_incremented,$date_from,$date_to);
$stmt->execute();
$stmt->close();

$obj->closeConnection();
?>