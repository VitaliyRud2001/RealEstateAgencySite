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
    $obj->query("SELECT objects.ID,
     objects.price,
     objects.sleep_places,
     objects.rooms,
     objects.floors,
     streets.street_name,
     districts.district_name,
     terms.ID,
     terms.from_date,
     terms.to_date,
     users.ID,
     users.name,
     users.last_name,
     phones_users.phone_number,
     Country_Phones.code
     from objects
     INNER JOIN streets ON objects.ID_street = streets.ID
     INNER JOIN districts ON objects.ID_discrict = districts.ID
     INNER JOIN terms ON terms.ID_of_object = objects.ID
     INNER JOIN users ON terms.ID_of_client = users.ID
     INNER JOIN phones_users ON phones_users.ID_of_user = users.ID
     INNER JOIN Country_Phones ON Country_Phones.ID = phones_users.ID_countryCode
     WHERE objects.ID_of_worker = $id_of_worker;");
   $nums = mysqli_num_rows($obj->query);
    for($i = 0;$i<$nums;$i++){
        $row = mysqli_fetch_row($obj->query);
        include "scripts/formatDate.php";

      echo  "
<div id='$row[0]' class='modal'>
<div class='modal-content'>
<h4> характеристика об'єкта </h4>
<p>
Вулиця - $row[5]<br>
Район - $row[6] <br>
Поверх $row[4] <br>
Кі-сть кімнат $row[3]<br>
кі-сть спальних місць $row[2]<br>
Ціна за добу $row[1] грн.
</p>
</div>
<div class=\"modal-footer\">
      <a href=\"#!\" class=\"modal-action modal-close waves-effect waves-green btn-flat\">Закрити</a>
    </div>

</div>";



        echo "
<div class='row'>
<div class='col s12 m7 offset-m3'>
<div class='card blue-grey darken-1'>
<div class='card-content white-text'>
<span class='card-title'>Замовлено:</span>
<p>
$row[3] кім. вул. $row[5] район $row[6] $row[4] пов. $row[2] сп.
<br>
На термін:
<br>Від $fullDateFrom до $fullDateTo ($countOfDays діб)
<br>
Клієнт : $row[11] $row[12]<br>
телефон +$row[14]$row[13]
</p>
</div>
<div class='card-action'>
<a class=\"modal-trigger\" href=\"#$row[0]\">повна характеристика</a>
<a href='checkOrders.inc.php?id=$row[0]&termsId=$row[7]&user=$row[10]'>Бронювати</a>
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