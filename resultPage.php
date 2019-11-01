<?php
$status = $_GET["status"];
switch($status){
    case true:
      echo "succes!";
        break;
    case false:
        echo "something wrong!";
        break;
}
?>