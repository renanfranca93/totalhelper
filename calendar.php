<?php

include 'services/conn.php';


// Set your timezone!!
date_default_timezone_set('America/Sao_Paulo');

// Get prev & next month
if (isset($_GET['ym'])) {
    $ym = $_GET['ym'];
} else {
    // This month
    $ym = date('Y-m');
}

// Check format
$timestamp = strtotime($ym . '-01');  // the first day of the month
if ($timestamp === false) {
    $ym = date('Y-m');
    $timestamp = strtotime($ym . '-01');
}

// Today (Format:2018-08-8)
$today = date('Y-m-j');

// Title (Format:August, 2018)
if(date('m', $timestamp) == 01){
    $title = "Janeiro de ".date('Y', $timestamp);
}else if(date('m', $timestamp) == '02'){
    $title = "Fevereiro de ".date('Y', $timestamp);
}else if(date('m', $timestamp) == '03'){
    $title = "Março de ".date('Y', $timestamp);
}else if(date('m', $timestamp) == '04'){
    $title = "Abril de ".date('Y', $timestamp);
}else if(date('m', $timestamp) == '05'){
    $title = "Maio de ".date('Y', $timestamp);
}else if(date('m', $timestamp) == '06'){
    $title = "Junho de ".date('Y', $timestamp);
}else if(date('m', $timestamp) == '07'){
    $title = "Julho de ".date('Y', $timestamp);
}else if(date('m', $timestamp) == '08'){
    $title = "Agosto de ".date('Y', $timestamp);
}else if(date('m', $timestamp) == '09'){
    $title = "Setembro de ".date('Y', $timestamp);
}else if(date('m', $timestamp) == '10'){
    $title = "Outubro de ".date('Y', $timestamp);
}else if(date('m', $timestamp) == '11'){
    $title = "Novembro de ".date('Y', $timestamp);
}else if(date('m', $timestamp) == '12'){
    $title = "Dezembro de ".date('Y', $timestamp);
}

// $title = date('F, Y', $timestamp);

// Create prev & next month link
$prev = date('Y-m', strtotime('-1 month', $timestamp));
$next = date('Y-m', strtotime('+1 month', $timestamp));

// Number of days in the month
$day_count = date('t', $timestamp);

// 1:Mon 2:Tue 3: Wed ... 7:Sun
$str = date('N', $timestamp);

// Array for calendar
$weeks = [];
$week = '';

// Add empty cell(s)
$week .= str_repeat('<td></td>', $str - 1);

for ($day = 1; $day <= $day_count; $day++, $str++) {

    $date = $ym . '-' . $day;

    if ($today == $date) {
        $week .= '<td class="today">';
    } else {
        $week .= '<td>';
    }
    $wed_sql = "SELECT count(id) as total FROM calendar WHERE date = '".$date."'";
    $result_wed = mysqli_query($con, $wed_sql);
    $row_web = mysqli_fetch_array($result_wed, MYSQLI_ASSOC);

    $class_sql = "SELECT class FROM calendar WHERE date = '".$date."'";
    $result_class = mysqli_query($con, $class_sql);
    
    if ($str % 7 != 0) {
        $week .= "<span style='display:block; text-align:right; font-size: 16px; color:black; font-weight:bold'>$day</span>";
    }else $week .= "<span style='display:block; text-align:right; font-size: 16px; color:red; font-weight:bold'>$day</span>";
    // $week .= "<p style='display:block; text-align:center;'>". 8-$row_web['total'] . " </p>";


    $assigned_classes = ['green','green','green','green','green','green','green','green','green','green','green'];
    
    while ($row_class = mysqli_fetch_array($result_class, MYSQLI_ASSOC)) 
    {   
        

        // $week .= "<span style='display:block; text-align:left; font-size: 14px; color:green'>";

        if($row_class['class'] == 1) $assigned_classes[0] = 'red';
        // $week .= "<span style='color:red'>07:30 <span>";
        // else $week .= "<span style='color:green'>07:30 <span>";

        if($row_class['class'] == 2) $assigned_classes[1] = 'red';
        // $week .= "<span style='color:red'>08:20 <span>";
        // else $week .= "<span style='color:green'>08:20 <span>";

        if($row_class['class'] == 3) $assigned_classes[2] = 'red';
        // $week .= "<span style='color:red'>09:10 <span>";
        // else $week .= "<span style='color:green'>09:10 <span>";
        
        if($row_class['class'] == 4) $assigned_classes[3] = 'red';
        // $week .= "</br><span style='color:red'>10:50 <span>";
        // else $week .= "<span style='color:green'></br>10:50 <span>";

        if($row_class['class'] == 5) $assigned_classes[4] = 'red';
        // $week .= "<span style='color:red'>11:40 <span>";
        // else $week .= "<span style='color:green'>11:40 <span>";
        
        if($row_class['class'] == 6) $assigned_classes[5] = 'red';
        // $week .= "<span style='color:red'>14:30 <span>";
        // else $week .= "<span style='color:green'>14:30 <span>";
        
        if($row_class['class'] == 7) $assigned_classes[6] = 'red';
        // $week .= "</br><span style='color:red'>15:20 <span>";
        // else $week .= "<span style='color:green'></br>15:20 <span>";
        
        if($row_class['class'] == 8) $assigned_classes[7] = 'red';
        // $week .= "<span style='color:red'>16:10 <span>";
        // else $week .= "<span style='color:green'>16:10 <span>";
        
        if($row_class['class'] == 9) $assigned_classes[8] = 'red';
        // $week .= "<span style='color:red'>17:00 <span>";
        // else $week .= "<span style='color:green'>17:00 <span>";
        
        if($row_class['class'] == 10) $assigned_classes[9] = 'red';
        // $week .= "</br><span style='color:red'>18:00 <span>";
        // else $week .= "<span style='color:green'></br>18:00 <span>";
        
        if($row_class['class'] == 11) $assigned_classes[10] = 'red';
        // $week .= "<span style='color:red'>18:50 <span>";
        // else $week .= "<span style='color:green'>18:50 <span>";

        // $week .= "</span>";
    }

    // $week .= "<span style='display:block; text-align:left; font-size: 12px'>";
    // $week .= "<span style='color:".$assigned_classes[0]."'>07:30 <span>";
    // $week .= "<span style='color:".$assigned_classes[1]."'>| 08:20 <span>";
    // $week .= "<span style='color:".$assigned_classes[2]."'>| 09:10 <span>";
    // $week .= "<span style='color:".$assigned_classes[3]."'></br>10:50 <span>";
    // $week .= "<span style='color:".$assigned_classes[4]."'>| 11:40 <span>";
    // $week .= "<span style='color:".$assigned_classes[5]."'>| 14:30 <span>";
    // $week .= "<span style='color:".$assigned_classes[6]."'></br>15:20 <span>";
    // $week .= "<span style='color:".$assigned_classes[7]."'>| 16:10 <span>";
    // $week .= "<span style='color:".$assigned_classes[8]."'>| 17:00 <span>";
    // $week .= "<span style='color:".$assigned_classes[9]."'></br>18:00 <span>";
    // $week .= "<span style='color:".$assigned_classes[10]."'>| 18:50 <span>";
    // $week .= "</span>";

    if ($str % 7 != 0) {
        $week .= "<span style='display:block; text-align:center; font-size: 14px'>";
        $week .= "<div class='row'>";
        
        $week .= "<div class='col col-sm-4'><span style='color:".$assigned_classes[0]."'>";
         if($assigned_classes[0]!='red') $week .= "<a href=schedule_class.php?date=".$date."&class=1>07:30</a> <span></div>";
         else $week .= "07:30 <span></div>";

         $week .= "<div class='col col-sm-4'><span style='color:".$assigned_classes[1]."'>";
         if($assigned_classes[1]!='red') $week .= "<a href=schedule_class.php?date=".$date."&class=2>08:20</a> <span></div>";
         else $week .= "08:20 <span></div>";

        
         $week .= "<div class='col col-sm-4'><span style='color:".$assigned_classes[2]."'>";
         if($assigned_classes[2]!='red') $week .= "<a href=schedule_class.php?date=".$date."&class=3>09:10</a> <span></div>";
         else $week .= "09:10 <span></div>";

        $week .= "</div>";
        $week .= "<div class='row'>";
        
        $week .= "<div class='col col-sm-4'><span style='color:".$assigned_classes[3]."'>";
         if($assigned_classes[3]!='red') $week .= "<a href=schedule_class.php?date=".$date."&class=4>10:50</a> <span></div>";
         else $week .= "10:50 <span></div>";
        
         $week .= "<div class='col col-sm-4'><span style='color:".$assigned_classes[4]."'>";
         if($assigned_classes[4]!='red') $week .= "<a href=schedule_class.php?date=".$date."&class=5>11:40</a> <span></div>";
         else $week .= "11:40 <span></div>";

         $week .= "<div class='col col-sm-4'><span style='color:".$assigned_classes[5]."'>";
         if($assigned_classes[5]!='red') $week .= "<a href=schedule_class.php?date=".$date."&class=6>14:30</a> <span></div>";
         else $week .= "14:30 <span></div>";

        $week .= "</div>";
        $week .= "<div class='row'>";
        
        $week .= "<div class='col col-sm-4'><span style='color:".$assigned_classes[6]."'>";
         if($assigned_classes[6]!='red') $week .= "<a href=schedule_class.php?date=".$date."&class=7>15:20</a> <span></div>";
         else $week .= "15:20 <span></div>";

         $week .= "<div class='col col-sm-4'><span style='color:".$assigned_classes[7]."'>";
         if($assigned_classes[7]!='red') $week .= "<a href=schedule_class.php?date=".$date."&class=8>16:10</a> <span></div>";
         else $week .= "16:10 <span></div>";

         $week .= "<div class='col col-sm-4'><span style='color:".$assigned_classes[8]."'>";
         if($assigned_classes[8]!='red') $week .= "<a href=schedule_class.php?date=".$date."&class=9>17:00</a> <span></div>";
         else $week .= "17:00 <span></div>";

        $week .= "</div>";
        $week .= "<div class='row'>";
        
        $week .= "<div class='col col-sm-4'><span style='color:".$assigned_classes[9]."'>";
         if($assigned_classes[9]!='red') $week .= "<a href=schedule_class.php?date=".$date."&class=10>18:00</a> <span></div>";
         else $week .= "18:00 <span></div>";

         $week .= "<div class='col col-sm-4'><span style='color:".$assigned_classes[10]."'>";
         if($assigned_classes[10]!='red') $week .= "<a href=schedule_class.php?date=".$date."&class=11>18:50</a> <span></div>";
         else $week .= "18:50 <span></div>";

        $week .= "</div>";
        $week .= "</span>";
    }

    $week .= '</td>';

    // Sunday OR last day of the month
    if ($str % 7 == 0 || $day == $day_count) {

        // last day of the month
        if ($day == $day_count && $str % 7 != 0) {
            // Add empty cell(s)
            $week .= str_repeat('<td></td>', 7 - $str % 7);
        }

        $weeks[] = '<tr>' . $week . '</tr>';

        $week = '';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>AESIS - Agendar aula</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <style>
        .container {
            font-family: 'Montserrat', sans-serif;
            margin: 60px auto;
        }
        .list-inline {
            text-align: center;
            margin-bottom: 30px;
        }
        .title {
            font-weight: bold;
            font-size: 26px;
        }
        th {
            text-align: center;
        }
        td {
            height: 100px;
        }
        th:nth-of-type(6), td:nth-of-type(6) {
            color: black;
        }
        th:nth-of-type(7), td:nth-of-type(7) {
            color: red;
        }
        .today {
            background-color: ghostwhite;
        }
        .table th, .table td, .table tr{
        border: solid 1px lightgrey !important;
        vertical-align: baseline;
    }
    </style>
</head>
<body>
    <div class="container">
        <ul class="list-inline">
            <li class="list-inline-item"><a href="?ym=<?= $prev; ?>" class="btn btn-link">&lt; Anterior</a></li>
            <li class="list-inline-item"><span class="title"><?= $title; ?></span></li>
            <li class="list-inline-item"><a href="?ym=<?= $next; ?>" class="btn btn-link">Próximo &gt;</a></li>
        </ul>
        <p class="text-right"><a href="calendar.php">Hoje</a></p>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>SEG</th>
                    <th>TER</th>
                    <th>QUA</th>
                    <th>QUI</th>
                    <th>SEX</th>
                    <th>SÁB</th>
                    <th>DOM</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($weeks as $week) {
                        echo $week;
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>