<?php
date_default_timezone_set('UTC');
$id = $_GET["id"];
$date_from = $_GET["date_from"]-1;
$date_to = $_GET["date_to"]-1;
$gmdateFrom = gmdate("Y/m/d",$date_from);
$gmdateTo = gmdate("Y/m/d",$date_to);
include "scripts/mysql-connect.php";
$obj = new mysql_connect("127.0.0.1","root","","vitafortuna_update");
$obj->connectToDatabase();
$stmt = mysqli_prepare($obj->conn,"SELECT objects.rooms,objects.floors,objects.sleep_places,objects.price,
districts.district_name,
streets.street_name
from objects
INNER JOIN districts on districts.ID=objects.ID_discrict
INNER JOIN streets  on streets.ID=objects.ID_street
where objects.ID=?
");
$stmt->bind_param("i",$id);
$stmt->bind_result($rooms,$floors,$sleep_places_choosed,$price,$district_name, $street_name);
$stmt->execute();
$stmt->fetch();
$stmt->close();
$obj->query("SELECT * from Country_Phones");
$num = mysqli_num_rows($obj->query);

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
<div class="row">
    <div class="col">
   <form action="makeTerm.php" method="post">
   <div class="input-field col s12 m12">
       <input type="text" class="validate" id="name" name="name">
       <label for="name"> Ім'я</label>
   </div>
<div class="input-field col s12 m12">
    <input type="text" class="validate" id="last_name" name="last_name">
    <label for="last_name">Прізвище</label>
</div>


    <?php
    echo "<div class='input-field col s12 m6'>
<select name='country_code'>
<option value='' disabled selected>Оберіть код вашої країни</option>
";
    for($i = 0;$i<$num;$i++){
        $row = mysqli_fetch_row($obj->query);
   echo "<option value='$row[0]'>($row[1]) +$row[2]</option>";
    }
echo "</select>
</div>
<div class='input-field col s12 m6'>
<input type='number' id='telephone' name='telephone'>
<label for='telephone'>Номер телефону без коду оператора</label>
</div>
";

    echo "<input type='hidden' value='$id' name='id'>";
  echo "<div class=\"input-field col s12\">
          <textarea disabled id=\"textarea1\" class=\"materialize-textarea black-text\">$rooms кімнатна в.$street_name ($district_name) $floors поверх $sleep_places_choosed сп $price грн
Дата: $gmdateFrom - $gmdateTo
          </textarea>
          <label for=\"textarea1\" class='black-text'>Бронюється об'єкт</label>
        </div>

        <input type='hidden' value='$date_from' name='date_from'>
        <input type='hidden' value='$date_to' name='date_to'>

  <button class=\"btn waves-effect waves-light\" type=\"submit\" name=\"action\">Забронювати
    <i class=\"material-icons right\">send</i>
  </button>

        ";
$obj->closeConnection();
    ?>

</form>
    </div>
</div>


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
    });
    $(".button-collapse").sideNav();
    $('select').material_select();
    Materialize.updateTextFields();


</script>