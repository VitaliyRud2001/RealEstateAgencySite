<?php
session_start();
date_default_timezone_set('UTC');
if($_SESSION["identify"]!=true || md5($_SERVER["HTTP_USER_AGENT"])!=$_SESSION["http_user_agent"]){
    header("Location:index.php");
    exit();
}else {
    require_once "scripts/mysql-connect.php";
    $id_of_worker = $_SESSION["id_of_worker"];
    $id_of_object = $_GET["id"];
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
                <li><a href="google.com">Контакти</a></li>
                <?php
                if($_SESSION["identify"]==true) echo "
                 <li><a href='showMyObjects.php'>Мої об'єкти</a></li>
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
                 <li><a href=\"login.inc.php\">Вихід</a></li>";
                else echo "<li><a href=\"login.php\">Вхід</a></li>";
                ?>
                ?>
            </ul>
        </div>
    </div>
</nav>

<main>
    <div class="row">
    <form action="Edit.inc.php" method="post" enctype="multipart/form-data">
        <?php
        $obj = new mysql_connect("127.0.0.1","root","","vitafortuna_update");
        $obj->connectToDatabase();


$smtp = mysqli_prepare($obj->conn,"SELECT objects.rooms,objects.floors,objects.sleep_places,objects.price,
workers.name,
districts.ID,
districts.district_name,
streets.ID,
streets.street_name
from objects
INNER JOIN workers on objects.ID_of_worker = workers.ID
INNER JOIN districts on districts.ID=objects.ID_discrict
INNER JOIN streets  on streets.ID=objects.ID_street
where objects.ID=?");
        $smtp->bind_param("i",$id_of_object);
        $smtp->bind_result($rooms,$floors,$sleep_places_choosed,$price,$workerName,$districtID,$district_name,$streetID,
            $street_name);
        $smtp->execute();
        $smtp->fetch();
        $smtp->close();

        $selectStreets = "<div class='input-field col s12 m4'>
       <select name='id_of_street'>
       <option value='$streetID' selected>$street_name</option>
        ";
        $obj->query("SELECT streets.ID,streets.street_name FROM streets");
        $nums = mysqli_num_rows($obj->query);

        for($i = 0;$i<$nums;$i++){
            $rows = mysqli_fetch_row($obj->query);
            if($rows[0]!=$streetID){
                $selectStreets.="<option value='$rows[0]'>$rows[1]</option>";
                }
        }
          $selectStreets.="</select>
             </div>";

        $selectDistricts = "<div class='input-field col s12 m4'>
  <select name='id_of_district'>
  <option value='$districtID' selected>$district_name</option>
";
        $obj->query("SELECT ID,district_name FROM districts");
        $nums = mysqli_num_rows($obj->query);

        for($i = 0;$i<$nums;$i++){
            $rows = mysqli_fetch_row($obj->query);
            if($rows[0]!=$districtID){
                $selectDistricts.="<option value='$rows[0]'>$rows[1]</option>";
            }
        }
        $selectDistricts.="
        </select>
        </div>
        ";
        $obj->closeConnection();

        echo "
<div class='input-field col s6 m4'>
<input id='col_of_rooms' placeholder='кіл-сть кімнат' type='number' name='rooms' value='$rooms'/>
<label for='col_of_rooms'>кількість кімнат</label>
</div>

<div class='input-field col s6 m4'>
<input type='number' id='col_of_floors' placeholder='Поверх' name='floors' value='$floors'/>
<label for='col_of_floors'>Поверх</label>
</div>

<div class='input-field col s6 m4'>
<input type='number' id='col_of_sleepPlaces' placeholder='Кіл-сть спальних місць' name='sleep_places' value='$sleep_places_choosed'/>
<label for='col_of_sleepPlaces'>Кіл-сть спальних місць</label>
</div>

<div class='input-field col s6 m4'>
<input type='number'  value='$price' placeholder='ціна' id='price' name='price'/>
<label for='price'>Ціна</label>
</div>
$selectStreets
$selectDistricts
<input type='hidden' name='id_of_objects' value=' $id_of_object'>
 <button class=\"btn waves-effect waves-light\" type=\"submit\" name=\"action\">Редагувати
    <i class=\"material-icons right\">send</i>
  </button>
";

        ?>
    </form>
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


    $(document).ready(function () {
        $(".modal").modal();
        $(".button-collapse").sideNav();

        $('select').material_select();
        Materialize.updateTextFields();
    });



</script>