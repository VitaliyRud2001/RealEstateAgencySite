<?php
session_start();
date_default_timezone_set('UTC');
if($_SESSION["identify"]!=true || md5($_SERVER["HTTP_USER_AGENT"])!=$_SESSION["http_user_agent"]){
    header("Location:index.php");
    exit();
}
    require_once "scripts/mysql-connect.php";
    include "scripts/getPictures.php";

    $id_of_worker = $_SESSION["id_of_worker"];
    $id_of_objects = $_GET["id"];
    $obj = new mysql_connect("127.0.0.1","root","","vitafortuna_update");
    $obj->connectToDatabase();
    $stmt = mysqli_prepare($obj->conn,"SELECT name_of_folder FROM objects where id=?");
    $stmt->bind_param("i",$id_of_objects);
    $stmt->bind_result($nameOfFolder);
    $stmt->execute();
    $stmt->fetch();
    echo $nameOfFolder;
    $picture = get_picture("database/sell/$nameOfFolder");
       foreach($picture as $key){
     echo "<img class=\"materialboxed\" width=\"650\" src='$key'>";
    }
  $obj->closeConnection();
  $stmt->close();


?>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
<script>


    $(document).ready(function(){
        $('.materialboxed').materialbox();
    });
    $(".button-collapse").sideNav();
    $('select').material_select();
    Materialize.updateTextFields();


</script>
