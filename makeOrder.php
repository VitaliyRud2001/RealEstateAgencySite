
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
                <li><a href="badges.html">Про нас</a></li>
                <li><a href="collapsible.html">Послуги</a></li>
                <li><a href="google.com">Контакти</a></li>
                <?php
                if($_SESSION["identify"]==true) echo "<li><a href=\"login.inc.php\">Вихід</a></li>";
                else echo "<li><a href=\"login.php\">Вхід</a></li>";
                ?>
            </ul>
            <ul class="side-nav" id="mobile-demo">
                <li><a ref="sass.html">Головна</a></li>
                <li><a href="badges.html">Про нас</a></li>
                <li><a href="collapsible.html">Послуги</a></li>
                <li><a href="google.com">Контакти</a></li>
                <?php
                if($_SESSION["identify"]==true) echo "<li><a href=\"login.inc.php\">Вихід</a></li>";
                else echo "<li><a href=\"login.php\">Вхід</a></li>";
                ?>
            </ul>
        </div>
    </div>
</nav>

<main>



    <div class="container">
        <div class="row">



        <?php
        date_default_timezone_set('UTC');
        $date_from = strtotime(gmdate($_POST["date_from"]));
        $date_to = strtotime(gmdate($_POST["date_to"]));
$sleep_places = $_POST["col_of_rooms"];
$date_from+=1;
$date_to+=1;

        include "scripts/mysql-connect.php";
$obj = new mysql_connect("127.0.0.1","root","","vitafortuna_update");
$obj->connectToDatabase();




$smtp = mysqli_prepare($obj->conn,"SELECT objects.ID,objects.rooms,objects.floors,objects.sleep_places,objects.price,
workers.name,
districts.district_name,
streets.street_name
from objects
INNER JOIN workers on objects.ID_of_worker = workers.ID
INNER JOIN districts on districts.ID=objects.ID_discrict
INNER JOIN streets  on streets.ID=objects.ID_street
where objects.ID not in(select ID_of_object from orders where from_date between $date_from and $date_to or to_date between $date_from and $date_to)
and objects.sleep_places=?");
$smtp->bind_param("i",$sleep_places);
$smtp->bind_result($id_prepared,$rooms,$floors,$sleep_places_choosed,$price,$workerName,$district_name,
    $street_name);
$smtp->execute();


        while($smtp->fetch()){
            echo "
<div id='$id_prepared' class='modal'>
<div class='modal-content'>
<h4>Характеристика обьєкта</h4>
<p>
Вулиця - $street_name<br>
Район - $district_name <br>
Поверх - $floors<br>
Кіл-сть спальних місць - $sleep_places_choosed<br>
Ціна за добу - $price грн<br>
 <a class=\"waves - effect waves - light btn\" href='scripts/showphotos?id=$id_prepared'>Фотографії об.єкту</a>
</p>
</div>

<div class=\"modal-footer\">
      <a href=\"#!\" class=\"modal-action modal-close waves-effect waves-green btn-flat\">Закрити</a>
    </div>

</div>










 <div class=\"col s12 m7 offset-m2\">
        <div class=\"card-panel white hoverable \">
            <span class=\" black-text darken-4\">
              $rooms-кімнатна в.$street_name $floors поверх $sleep_places спальних місць<br>Ціна
               $price гривень
              <br>
              <a class=\"waves-effect waves-light btn\" href='bookObjects.php?id=$id_prepared & date_from=$date_from & date_to=$date_to'>Бронь</a> <br><br>
               <a class=\"waves-effect waves-light btn modal-trigger\" href=\"#$id_prepared\">Повна характеристика</a>
        </span>
        </div>
    </div>";
        }



$obj->closeConnection();
$smtp->close();
?>
            </div>
        </div>
            </main>
</body>
</html>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
<script>

    $(document).ready(function(){
        $('.modal').modal();
    });
    $(".button-collapse").sideNav();
    $('select').material_select();
    Materialize.updateTextFields();


</script>

