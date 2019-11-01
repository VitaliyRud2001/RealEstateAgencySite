<?php
session_start();
date_default_timezone_set('UTC');
if($_SESSION["identify"]!=true || md5($_SERVER["HTTP_USER_AGENT"])!=$_SESSION["http_user_agent"]){
    header("Location:index.php");
    exit();
}else {
    require_once "scripts/mysql-connect.php";
    $id_of_worker = $_SESSION["id_of_worker"];
}
$id_of_object = $_POST["id_of_objects"];
$col_of_rooms = $_POST["rooms"];
$col_of_floors = $_POST["floors"];
$col_of_sleepPlaces = $_POST["sleep_places"];
$price = $_POST["price"];
$street = $_POST["id_of_street"];
$district = $_POST["id_of_district"];
$obj = new mysql_connect("127.0.0.1","root","","vitafortuna_update");
$obj->connectToDatabase();
$stmt = mysqli_prepare($obj->conn,"UPDATE objects SET  price= ?,ID_discrict=?,ID_street=?,sleep_places=?,rooms=?,floors=?  WHERE ID=?");
$stmt->bind_param("iiiiiii",$price,$district,$street,$col_of_sleepPlaces,$col_of_rooms,$col_of_floors,$id_of_object);
if($stmt->execute()){
  $stmt->close();
    $obj->closeConnection();
    header("Location:resultPage.php");
}

?>