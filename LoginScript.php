<?php
session_start();
if(!empty($_SESSION["identify"]) && !empty($_SESSION["http_user_agent"])){
    unset($_SESSION["identify"]);
    unset ($_SESSION["http_user_agent"]);
    header("Location:index.php");
    exit();
}else {
    include "scripts/mysql-connect.php";
    $obj = new mysql_connect("127.0.0.1","root","","vitafortuna_update");
    $obj->connectToDatabase();
    $login = $_POST["u"];
    $password = $_POST["p"];
     $stmt = mysqli_prepare($obj->conn,"SELECT ID_of_worker from workers_accounts where login=? and pass=?");
    $stmt->bind_param("ss",$login,$password);
    $stmt->bind_result($id);
    $stmt->execute();
    if($stmt->fetch()){
        $_SESSION["identify"]=true;
        $_SESSION["id_of_worker"] = $id;
        $_SESSION["http_user_agent"] = md5($_SERVER["HTTP_USER_AGENT"]);
        header("Location:index.php");
        exit();
    }else{
        header("Location:login.php?succes=0");
        exit();
    }



    /*if($stmt->num_rows > 0){
      $boo=true;
        $_SESSION["identify"]=true;
        $_SESSION["id_of_worker"] = $id_of_worker;
        $_SESSION["http_user_agent"] = md5($_SERVER["HTTP_USER_AGENT"]);
        echo "Succes!";
       header("Location:index.php");
       exit();
    }else{
   echo "xui!";
    }*/
}




