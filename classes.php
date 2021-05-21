<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}
include 'services/conn.php';

if (isset($_GET['idt'])) {
    $idt = $_GET['idt'];
}else $idt = -1;

if (isset($_GET['idu']) && $_GET['idu']!='null') {
    $idu = $_GET['idu'];
}else $idu = -1;

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

    // $wed_sql = "SELECT count(id) as total FROM calendar WHERE date = '".$date."'";
    // $result_wed = mysqli_query($con, $wed_sql);
    // $row_web = mysqli_fetch_array($result_wed, MYSQLI_ASSOC);
    $class_sql = "SELECT class, id_client FROM calendar WHERE date = '".$date."' AND id_teacher=".$idt;
    $result_class = mysqli_query($con, $class_sql);
    
    
    if ($str % 7 != 0) {
        $week .= "<span style='display:block; text-align:right; font-size: 16px; color:black; font-weight:bold'>$day</span>";
    }else $week .= "<span style='display:block; text-align:right; font-size: 16px; color:red; font-weight:bold'>$day</span>";
    // $week .= "<p style='display:block; text-align:center;'>". 8-$row_web['total'] . " </p>";


    $assigned_classes = ['green','green','green','green','green','green','green','green','green','green','green'];
    
    while ($row_class = mysqli_fetch_array($result_class, MYSQLI_ASSOC)) 
    {   
        

        if($row_class['class'] == 1) {
            if($row_class['id_client'] == $idu) $assigned_classes[0] = 'orange';
            else $assigned_classes[0] = 'silver';
        }
        

        if($row_class['class'] == 2) {
            if($row_class['id_client'] == $idu) $assigned_classes[1] = 'orange';
            else $assigned_classes[1] = 'silver';
        }

        if($row_class['class'] == 3) {
            if($row_class['id_client'] == $idu) $assigned_classes[2] = 'orange';
            else $assigned_classes[2] = 'silver';
        }
        
        if($row_class['class'] == 4) {
            if($row_class['id_client'] == $idu) $assigned_classes[3] = 'orange';
            else $assigned_classes[3] = 'silver';
        }

        if($row_class['class'] == 5) {
            if($row_class['id_client'] == $idu) $assigned_classes[4] = 'orange';
            else $assigned_classes[4] = 'silver';
        }
        
        if($row_class['class'] == 6) {
            if($row_class['id_client'] == $idu) $assigned_classes[5] = 'orange';
            else $assigned_classes[5] = 'silver';
        }
        
        if($row_class['class'] == 7) {
            if($row_class['id_client'] == $idu) $assigned_classes[6] = 'orange';
            else $assigned_classes[6] = 'silver';
        }
        
        if($row_class['class'] == 8) {
            if($row_class['id_client'] == $idu) $assigned_classes[7] = 'orange';
            else $assigned_classes[7] = 'silver';
        }
        
        if($row_class['class'] == 9) {
            if($row_class['id_client'] == $idu) $assigned_classes[8] = 'orange';
            else $assigned_classes[8] = 'silver';
        }

        if($row_class['class'] == 10) {
            if($row_class['id_client'] == $idu) $assigned_classes[9] = 'orange';
            else $assigned_classes[9] = 'silver';
        }
        
        if($row_class['class'] == 11) {
            if($row_class['id_client'] == $idu) $assigned_classes[10] = 'orange';
            else $assigned_classes[10] = 'silver';
        }


    }



    if ($str % 7 != 0) {


        if($idu=='null'||$idu==-1){
            $week .= "<span style='display:block; text-align:center; font-size: 14px'>";
            $week .= "<div class='row'>";
            
            $week .= "<div class='col col-sm-12 col-md-12 col-lg-4'><span style='color:".$assigned_classes[0]."'>07:30 <span></div>";

            $week .= "<div class='col col-sm-12 col-md-12 col-lg-4'><span style='color:".$assigned_classes[1]."'>08:20 <span></div>";

            
            $week .= "<div class='col col-sm-12 col-md-12 col-lg-4'><span style='color:".$assigned_classes[2]."'>09:10 <span></div>";

         
            
            $week .= "<div class='col col-sm-12 col-md-12 col-lg-4'><span style='color:".$assigned_classes[3]."'>10:50 <span></div>";
            
            $week .= "<div class='col col-sm-12 col-md-12 col-lg-4'><span style='color:".$assigned_classes[4]."'>11:40 <span></div>";

            $week .= "<div class='col col-sm-12 col-md-12 col-lg-4'><span style='color:".$assigned_classes[5]."'>14:30 <span></div>";

       
            
            $week .= "<div class='col col-sm-12 col-md-12 col-lg-4'><span style='color:".$assigned_classes[6]."'>15:20 <span></div>";

            $week .= "<div class='col col-sm-12 col-md-12 col-lg-4'><span style='color:".$assigned_classes[7]."'>16:10 <span></div>";

            $week .= "<div class='col col-sm-12 col-md-12 col-lg-4'><span style='color:".$assigned_classes[8]."'>17:00 <span></div>";

       
            
            $week .= "<div class='col col-sm-12 col-md-12 col-lg-4'><span style='color:".$assigned_classes[9]."'>18:00 <span></div>";

            $week .= "<div class='col col-sm-12 col-md-12 col-lg-4'><span style='color:".$assigned_classes[10]."'>18:50 <span></div>";

            $week .= "</div>";
            $week .= "</span>";
        }else{

            $week .= "<span style='display:block; text-align:center; font-size: 14px'>";
            $week .= "<div class='row'>";
            
            $week .= "<div class='col col-sm-12 col-md-12 col-lg-4'><span style='color:".$assigned_classes[0]."'>";
            if($assigned_classes[0]=='green') $week .= "<a class='green-link' href=services/schedule_class.php?date=".$date."&class=1&idu=".$idu."&idt=".$idt.">07:30</a> <span></div>";
            else if($assigned_classes[0]=='orange') $week .= "<a class='orange-link' href=services/schedule_class.php?date=".$date."&class=1&idu=".$idu."&idt=".$idt."&del=true>07:30</a> <span></div>";
            else $week .= "07:30 <span></div>";

            $week .= "<div class='col col-sm-12 col-md-12 col-lg-4'><span style='color:".$assigned_classes[1]."'>";
            if($assigned_classes[1]=='green') $week .= "<a class='green-link' href=services/schedule_class.php?date=".$date."&class=2&idu=".$idu."&idt=".$idt.">08:20</a> <span></div>";
            else if($assigned_classes[1]=='orange') $week .= "<a class='orange-link' href=services/schedule_class.php?date=".$date."&class=2&idu=".$idu."&idt=".$idt."&del=true>08:20</a> <span></div>";
            else $week .= "08:20 <span></div>";

            
            $week .= "<div class='col col-sm-12 col-md-12 col-lg-4'><span style='color:".$assigned_classes[2]."'>";
            if($assigned_classes[2]=='green') $week .= "<a class='green-link' href=services/schedule_class.php?date=".$date."&class=3&idu=".$idu."&idt=".$idt.">09:10</a> <span></div>";
            else if($assigned_classes[2]=='orange') $week .= "<a class='orange-link' href=services/schedule_class.php?date=".$date."&class=3&idu=".$idu."&idt=".$idt."&del=true>09:10</a> <span></div>";
            else $week .= "09:10 <span></div>";

            $week .= "</div>";
            $week .= "<div class='row'>";
            
            $week .= "<div class='col col-sm-12 col-md-12 col-lg-4'><span style='color:".$assigned_classes[3]."'>";
            if($assigned_classes[3]=='green') $week .= "<a class='green-link' href=services/schedule_class.php?date=".$date."&class=4&idu=".$idu."&idt=".$idt.">10:50</a> <span></div>";
            else if($assigned_classes[3]=='orange') $week .= "<a class='orange-link' href=services/schedule_class.php?date=".$date."&class=4&idu=".$idu."&idt=".$idt."&del=true>10:50</a> <span></div>";
            else $week .= "10:50 <span></div>";
            
            $week .= "<div class='col col-sm-12 col-md-12 col-lg-4'><span style='color:".$assigned_classes[4]."'>";
            if($assigned_classes[4]=='green') $week .= "<a class='green-link' href=services/schedule_class.php?date=".$date."&class=5&idu=".$idu."&idt=".$idt.">11:40</a> <span></div>";
            else if($assigned_classes[4]=='orange') $week .= "<a class='orange-link' href=services/schedule_class.php?date=".$date."&class=5&idu=".$idu."&idt=".$idt."&del=true>11:40</a> <span></div>";
            else $week .= "11:40 <span></div>";

            $week .= "<div class='col col-sm-12 col-md-12 col-lg-4'><span style='color:".$assigned_classes[5]."'>";
            if($assigned_classes[5]=='green') $week .= "<a class='green-link' href=services/schedule_class.php?date=".$date."&class=6&idu=".$idu."&idt=".$idt.">14:30</a> <span></div>";
            else if($assigned_classes[5]=='orange') $week .= "<a class='orange-link' href=services/schedule_class.php?date=".$date."&class=6&idu=".$idu."&idt=".$idt."&del=true>14:30</a> <span></div>";
            else $week .= "14:30 <span></div>";

            $week .= "</div>";
            $week .= "<div class='row'>";
            
            $week .= "<div class='col col-sm-12 col-md-12 col-lg-4'><span style='color:".$assigned_classes[6]."'>";
            if($assigned_classes[6]=='green') $week .= "<a class='green-link' href=services/schedule_class.php?date=".$date."&class=7&idu=".$idu."&idt=".$idt.">15:20</a> <span></div>";
            else if($assigned_classes[6]=='orange') $week .= "<a class='orange-link' href=services/schedule_class.php?date=".$date."&class=7&idu=".$idu."&idt=".$idt."&del=true>15:20</a> <span></div>";
            else $week .= "15:20 <span></div>";

            $week .= "<div class='col col-sm-12 col-md-12 col-lg-4'><span style='color:".$assigned_classes[7]."'>";
            if($assigned_classes[7]=='green') $week .= "<a class='green-link' href=services/schedule_class.php?date=".$date."&class=8&idu=".$idu."&idt=".$idt.">16:10</a> <span></div>";
            else if($assigned_classes[7]=='orange') $week .= "<a class='orange-link' href=services/schedule_class.php?date=".$date."&class=8&idu=".$idu."&idt=".$idt."&del=true>16:10</a> <span></div>";
            else $week .= "16:10 <span></div>";

            $week .= "<div class='col col-sm-12 col-md-12 col-lg-4'><span style='color:".$assigned_classes[8]."'>";
            if($assigned_classes[8]=='green') $week .= "<a class='green-link' href=services/schedule_class.php?date=".$date."&class=9&idu=".$idu."&idt=".$idt.">17:00</a> <span></div>";
            else if($assigned_classes[8]=='orange') $week .= "<a class='orange-link' href=services/schedule_class.php?date=".$date."&class=9&idu=".$idu."&idt=".$idt."&del=true>17:00</a> <span></div>";
            else $week .= "17:00 <span></div>";

            $week .= "</div>";
            $week .= "<div class='row'>";
            
            $week .= "<div class='col col-sm-12 col-md-12 col-lg-4'><span style='color:".$assigned_classes[9]."'>";
            if($assigned_classes[9]=='green') $week .= "<a class='green-link' href=services/schedule_class.php?date=".$date."&class=10&idu=".$idu."&idt=".$idt.">18:00</a> <span></div>";
            else if($assigned_classes[9]=='orange') $week .= "<a class='orange-link' href=services/schedule_class.php?date=".$date."&class=10&idu=".$idu."&idt=".$idt."&del=true>18:00</a> <span></div>";
            else $week .= "18:00 <span></div>";

            $week .= "<div class='col col-sm-12 col-md-12 col-lg-4'><span style='color:".$assigned_classes[10]."'>";
            if($assigned_classes[10]=='green') $week .= "<a class='green-link' href=services/schedule_class.php?date=".$date."&class=11&idu=".$idu."&idt=".$idt.">18:50</a> <span></div>";
            else if($assigned_classes[10]=='orange') $week .= "<a class='orange-link' href=services/schedule_class.php?date=".$date."&class=11&idu=".$idu."&idt=".$idt."&del=true>18:50</a> <span></div>";
            else $week .= "18:50 <span></div>";

            $week .= "</div>";
            $week .= "</span>";

        }


        
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AESIS</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/tooltip.css">
    <link rel="shortcut icon" href="assets/images/icon.png" />
    <link rel="icon" href="assets/images/favicon.ico" />
    <script src="https://kit.fontawesome.com/ccfc22b274.js" crossorigin="anonymous"></script>
    <script>
        var activeUser = []
    </script>


</head>
<body>
  <div id="sidebar" class="col col-md-3 d-md-block d-none shadowCustom">
  <div class="sidebarTitle logoPadding"><img src="./assets/images/icon.png" height="65px"></div>
      <a href="index.php?offset0"><div class="sidebarItem inactiveItem"><i class="fas fa-user-circle"></i> </div></a>
      <a href="classes.php"><div class="sidebarItem activeItem"><i class="fas fa-car"></i> </div></a>
      <a href="financial.php?offset0"><div class="sidebarItem"><i class="fas fa-hand-holding-usd inactiveItem"></i> </div></a>
      <div class="sidebarItem"><i class="fas fa-bell inactiveItem"></i> </div>
      <div class="sidebarItem"><i class="fas fa-cog inactiveItem"></i> </div>
      <div class="spacer"></div>
      <a href="http://meridianti.com.br/" target="new"><div style="margin-left:10px"><img width="50px" src="./assets/images/meridian.png" title="Desenvolvido por Meridian TI"> </div></a>
  </div>
    <div id="customContainer">
      <!-- HEADER MOBILE -->
        <div id="mobileHeader" class="row shadowCustom">
            <div id="header" class="col d-block d-md-none headerTitle logoPadding" >
                <div><img src="./assets/images/sisae_logo.png" height="40px"></div>
            </div>
            <div id="menuBars" class="col d-block d-md-none">
                <a href="#"><i class="fas fa-bars majorIcon"></i></a>
            </div>
        </div>
      
        <!-- CONTEUDO -->
        <div class="row">
            <div id="content" class="col" >
                <div id="bar" class="row d-block ">
                    <!-- BUSCA USUARIO -->
                        <div class="searchBox">
                            <a href="?ym=<?= $prev; ?>&idt=<?= $idt; ?>&idu=<?= $idu; ?>" class="btn btn-link" style="vertical-align:super"><img src='assets/images/arr_left.png' width='15px'></a>
                            <span class="titleClass"><?= $title; ?></span>
                            <a href="?ym=<?= $next; ?>&idt=<?= $idt; ?>&idu=<?= $idu; ?>" class="btn btn-link" style="vertical-align:super"><img src='assets/images/arr_right.png' width='15px'></a>
                        </div>
                        <div class="searchBox">
                           
                                </div>
                                <div class="searchBox logoPadding">

                                <select id="idt_choose" class="form-control" onChange=reloadByTeacher()>
                                    <option selected value=-1>Selecione</option>
                                        <?php
                                        
                                            $sql_teacer = "SELECT id, name FROM accounts WHERE role='teacher'"; 
                                            $result_teacher = mysqli_query($con, $sql_teacer);
                                            while ($row_teacher = mysqli_fetch_array($result_teacher, MYSQLI_ASSOC)) 
                                                {  
                                                    if($idt == $row_teacher['id']){
                                                        $select_teacher = 'selected';
                                                    }else $select_teacher = '';
                                                    echo "<option ".$select_teacher." value=".$row_teacher['id'].">".$row_teacher['name']."</option>";
                                            }
   
                                        ?>
                                           
                                    </select>

                        </div>
                    
                    <!-- ICONES CANTO ESQ -->
                        <div class="barIcons  d-md-block d-none">
                            <!-- <a href="#" ><i class="fas fa-bell verticalAlignent majorIcon grey"></i></a> -->
                            <a href="#"><i class="fas fa-user-circle majorIcon "></i></a>
                            <a href="services/logout.php"><i class="fas fa-sign-out-alt majorIcon"></i></a>
                        </div>                    
                </div>
                  <!-- CONTEUDO -->
                <div class="floatLeft">

                <?php if($idu != -1){ 

                    $sql_user = "SELECT u.nome, count(c.id) as total_aulas
                    FROM clients u
                    JOIN calendar c ON u.cod = c.id_client
                    WHERE cod=".$idu; 
                    $result_user = mysqli_query($con, $sql_user);
                    $row_user = mysqli_fetch_array($result_user, MYSQLI_ASSOC);

                    echo "<span style='text-align:center; display:block'><span style='font-size:20px'>".$row_user['nome'] ." </span><span>| Aulas agendadas: ".$row_user['total_aulas']."</span></span></br></br>";
                    }

                    ?>
         

                    <?php if($idt==-1){
                        echo "</br></br></br></br></br><p style='text-align:center; display:block; color:darkgrey'>Selecione um professor para exibir a agenda<p>";
                    }else{
                    ?>
         
                        <table class="table table-bordered tableClass">
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
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>


<script>

function reloadByTeacher(){

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const ym = urlParams.get('ym')
    const idu = urlParams.get('idu')
    const idt = document.getElementById('idt_choose').value
    window.location.href = '?ym='+ym+'&idt='+idt+"&idu="+idu
}

</script>



<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="assets/bootstrap/js/bootstrap.js"></script>
</body>
</html>