<?php
session_start();
date_default_timezone_set('UTC');
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








<div class="container">
<div class="row">

<form method="post" id="form" action="makeOrder.php">
    <div class="input-field col s12 m12 l12">
    Дата заїзду:
<input type = 'date' id="date_from" name="date_from">
</div>
    <div class="input-field col s12 m12 l12">
        Дата виїзду:
<input type="date" onchange="setDays(event)" id="date_to" name="date_to">
    </div>

    <div class="input-field col s12 m12 l12">
Кількість спальних місць:
<input type="number" id="number_of_rooms" name="col_of_rooms">
</div>

    <div class="input-field col s12 m12 l12">
Кількість днів:
<input type="number" id = 'number_of_days'>



    <button class="btn waves-effect waves-light" type="submit" name="action" target="_blank">Пошук
        <i class="material-icons right">send</i>
    </button>
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
    function setDays(e){
        var p = document.getElementById("date_to").value;
        var p1 = document.getElementById("date_from").value;
        var date1 = new Date(p);
        var date2 = new Date(p1);
        var timeDiff = Math.abs(date1.getTime() - date2.getTime());
        var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
        document.getElementById("number_of_days").value=diffDays;
    }

    $(document).ready(function () {
        $(".modal").modal();
        $(".button-collapse").sideNav();

        $('select').material_select();
        Materialize.updateTextFields();
    });



</script>


<?php
echo"<select>
<option value='1' selected>lol</option>
<option value='2'>ku1</option>;
</select>";
?>


