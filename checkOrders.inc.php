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
$id_of_object = $_GET["id"];
$id_of_term = $_GET["termsId"];

$id_of_user = $_GET["user"];
$fromDate;
$toDate;
$obj = new mysql_connect("127.0.0.1","root","","vitafortuna_update");
$obj->connectToDatabase();
$stmt = mysqli_prepare($obj->conn,"SELECT from_date,to_date from terms where ID=?");
$stmt->bind_result($fromDate,$toDate);
$stmt->bind_param("i",$id_of_term);
$stmt->execute();
$stmt->fetch();
$stmt->close();


$stmt1 = mysqli_prepare($obj->conn,"INSERT INTO orders VALUES(NULL,?,?,?,?)");
$stmt1->bind_param("iiii",$id_of_object,$id_of_user,$fromDate,$toDate);
$stmt1->execute();
$stmt1->close();

$stmt2 = mysqli_prepare($obj->conn,"DELETE FROM terms where ID=?");
$stmt2->bind_param("i",$id_of_term);
$stmt2->execute();
$stmt2->close();

$obj->closeConnection();
header("Location:resultPage.php?status=$succes");
exit();
?>

