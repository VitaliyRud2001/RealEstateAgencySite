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


?>
<!DOCTYPE html>
<html>
<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection"/>
    <meta charset="utf-8"/>
    <link type="text/css" rel="stylesheet" href="css.css"/>
    <!--Let browser know website is optimized for mobile-->
    <link rel="stylesheet" href="css/site.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body>


<nav>
    <div class="nav-wrapper">
        <div class="container">
            <a href="#" class="brand-logo">Віта-Фортуна</a>
            <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
                <li><a ref="sass.html">Головна</a></li>

                <?php
                if($_SESSION["identify"]==true) echo "
                 <li><a href='showMyObjects.php'>Мої об'єкти</a></li>
                  <li><a href=\"checkOrders.php\">Замовлення</a></li>
                 <li><a href=\"login.inc.php\">Вихід</a></li>";

                else echo "<li><a href=\"login.php\">Вхід</a></li>";
                ?>
            </ul>
            <ul class="side-nav" id="mobile-demo">
                <li><a ref="sass.html">Головна</a></li>
                <li><a href="google.com">Контакти</a></li>
                <?php
                if($_SESSION["identify"]==true) echo "
                 <li><a href='showMyObjects.php'>Мої обьєкти</a></li>
                  <li><a href=\"checkOrders.php\">Замовлення</a></li>
                 <li><a href=\"login.inc.php\">Вихід</a></li>";
                else echo "<li><a href=\"login.php\">Вхід</a></li>";
                ?>
                ?>
            </ul>
        </div>
    </div>
</nav>

<main>
    <?php
    $obj = new mysql_connect("127.0.0.1","root","","vitafortuna_update");
    $obj->connectToDatabase();
    $obj->query("SELECT objects.ID,objects.rooms,objects.floors,objects.sleep_places,objects.price,
districts.district_name,
streets.street_name
from objects
INNER JOIN districts on districts.ID=objects.ID_discrict
INNER JOIN streets  on streets.ID=objects.ID_street
where objects.ID_of_worker=$id_of_worker");/*
    $col[1]-кімнатна в.$col[6] $col[2] поверх $col[3] спальних місць<br>Ціна
               $col[4] гривень*/
    $rows = mysqli_num_rows($obj->query);
    for($i = 0;$i<$rows;$i++){
        $col = mysqli_fetch_row($obj->query);
        echo "
<div id='$col[0]' class='modal'>
<div class='modal-content'>
<h4> характеристика об'єкта </h4>
<p>
Вулиця - $col[6]<br>
Район - $col[5] <br>
Поверх $col[2] <br>
кі-сть спальних місць $col[3]<br>
Ціна за добу $col[4] грн.
</p>
</div>
<div class=\"modal-footer\">
      <a href=\"#!\" class=\"modal-action modal-close waves-effect waves-green btn-flat\">Закрити</a>
      <a href='Edit.php?id=$col[0]'>Редагувати</a>
    </div>

</div>



<div class='row'>
<div class='col s12 m4 offset-m4'>
<div class='card blue-grey darken-1'>
<div class='card-content white-text'>
<span class='card-title'>в.$col[6]</span>
<p> $col[1]-кімнатна в.$col[6] $col[2] поверх $col[3] спальних місць<br>Ціна
               $col[4] гривень</p>

</div>
<div class='card-action'>
<a class=\"modal-trigger\" href=\"#$col[0]\">Повна характеристика</a>
<a href='showOrAddphotos.php?id=$col[0]'>Фотографії</a>

</div>
</div>
</div>
</div>



";
    }
$obj->closeConnection();
    ?>


</main>

<footer class="page-footer">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h5 class="white-text">Віта-Фортуна</h5>
                Бажаєте зв'язатися з нами? <a class="waves-effect waves-light btn modal-trigger" href="#modal2">Зворотній звязок</a>
            </div>
            <div class="col l4 offset-l2 s12">
                <h5 class="white-text"></h5>
                <ul>
                    <li><a class="grey-text text-lighten-3" href="#!">Facebook</a></li>
                    <li><a class="grey-text text-lighten-3" href="#!">Google</a></li>
                    <li><a class="grey-text text-lighten-3" href="#!">Instagram</a></li>
                    <li><a class="grey-text text-lighten-3" href="#!">Новин нерухомості у Львові</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            © 1998-2018 Віта-Фортуна
        </div>
    </div>
</footer>
</body>
</html>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
<script>
    $(document).ready(function(){
        $('.modal').modal();
        $(".button-collapse").sideNav();
        $('select').material_select();
        Materialize.updateTextFields();
    });

</script>