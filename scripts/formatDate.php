<?php
$dateFrom = $row[8];
$dateTo = $row[9];

$countOfDays = $dateTo - $dateFrom;
$countOfDays/=86400;

$numberOfDayInMonth_from = date("j",$dateFrom);
$numberOfDayInMonth_to = date("j",$dateTo);

$yearFrom = date("Y",$dateFrom);
$yearTo = date("Y",$dateTo);

$monthFrom = date("F",$dateFrom);
$monthTo = date("F",$dateTo);

switch($monthFrom){
    case "January":
        $fullDateFrom = $numberOfDayInMonth_from." січня ".$yearFrom;
        break;
    case "February":
        $fullDateFrom = $numberOfDayInMonth_from." лютого ".$yearFrom;
        break;
    case "March":
        $fullDateFrom = $numberOfDayInMonth_from." березня ".$yearFrom;
        break;
    case "April":
        $fullDateFrom = $numberOfDayInMonth_from." квітня ".$yearFrom;
        break;
    case "May";
        $fullDateFrom = $numberOfDayInMonth_from." травня ".$yearFrom;
        break;
    case "June":
        $fullDateFrom = $numberOfDayInMonth_from." червня ".$yearFrom;
        break;
    case "July":
        $fullDateFrom = $numberOfDayInMonth_from." липня ".$yearFrom;
        break;
    case "August":
        $fullDateFrom = $numberOfDayInMonth_from." серпня ".$yearFrom;
        break;
    case "September":
        $fullDateFrom = $numberOfDayInMonth_from." вересня ".$yearFrom;
        break;
    case "October":
        $fullDateFrom = $numberOfDayInMonth_from." жовтня ".$yearFrom;
        break;
    case "November":
        $fullDateFrom = $numberOfDayInMonth_from." листопада ".$yearFrom;
        break;
    case "December":
        $fullDateFrom = $numberOfDayInMonth_from." грудня ".$yearFrom;
        break;
}

switch($monthTo){
    case "January":
        $fullDateTo = $numberOfDayInMonth_to." січня ".$yearTo;
        break;
    case "February":
        $fullDateTo = $numberOfDayInMonth_to." лютого ".$yearTo;
        break;
    case "March":
        $fullDateTo = $numberOfDayInMonth_to." березня ".$yearTo;
        break;
    case "April":
        $fullDateTo = $numberOfDayInMonth_to." квітня ".$yearTo;
        break;
    case "May";
        $fullDateTo = $numberOfDayInMonth_to." травня ".$yearTo;
        break;
    case "June":
        $fullDateTo = $numberOfDayInMonth_to." червня ".$yearTo;
        break;
    case "July":
        $fullDateTo = $numberOfDayInMonth_to." липня ".$yearTo;
        break;
    case "August":
        $fullDateTo = $numberOfDayInMonth_to." серпня ".$yearTo;
        break;
    case "September":
        $fullDateTo = $numberOfDayInMonth_to." вересня ".$yearTo;
        break;
    case "October":
        $fullDateTo = $numberOfDayInMonth_to." жовтня ".$yearTo;
        break;
    case "November":
        $fullDateTo = $numberOfDayInMonth_to." листопада ".$yearTo;
        break;
    case "December":
        $fullDateTo = $numberOfDayInMonth_to." грудня ".$yearTo;
        break;
}
?>