<?php
    include 'services/conn.php';

    $resTotal = mysqli_query($con,"SELECT * FROM calendar WHERE id_teacher = 2");

    $mon = [];
    $wed = [];
    while ($row = mysqli_fetch_array($resTotal, MYSQLI_ASSOC)) {
        if($row['day']=='mon'){
            $total = $row['end'] - $row['start'];
            array_push($mon,$row['start'],$row['end'],$total);
        }
        if($row['day']=='wed'){
            $total = $row['end'] - $row['start'];
            array_push($wed,$row['start'],$row['end'],$total);
        }
    }



    echo "<script>console.log(['".implode("','",$wed)."'])</script>";

?>

<!DOCTYPE html>
<html>
<head>
	<title>Shortlearner.com</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><form method="post" action="">

	<select name="month" >
		<option value="01">Jan</option>
		<option value="02" <?php if(date("m") == 02) echo "selected"; ?>>Feb</option>
		<option value="03">March</option>
		<option value="04">April</option>
		<option value="05">May</option>
		<option value="06">Jun</option>
		<option value="07">July</option>
		<option value="08">Aug</option>
		<option value="09">Sep</option>
		<option value="10">Oct</option>
		<option value="11">Nov</option>
		<option value="12">Dec</option>
	</select>
	<select name="year" >
		<option value="2018">2018</option>
		<option value="2019">2019</option>
		<option value="2020">2020</option>
		<option value="2021" <?php if(date("Y") == 2021) echo "selected"; ?>>2021</option>
		<option value="2022">2022</option>
		<option value="2023">2023</option>
		<option value="2024">2024</option>
		<option value="2025">2025</option>
		<option value="2026">2026</option>
		<option value="2027">2027</option>
	</select>
	<input type="submit" name="submit" class="btn btn-danger">
</form>	
</table>
<table class="table">
	<th><table class="table table-bordered bordered table-striped  datatable table-responsive ">
<thead>
 <div class="col-sm-1">   <th>DOM</th></div>
 <div class="col-sm-1">   <th>SEG</th></div>
 <div class="col-sm-1">   <th>TER</th></div>
 <div class="col-sm-1">   <th>QUA</th></div>
 <div class="col-sm-1">   <th>QUI</th></div>
 <div class="col-sm-1">   <th>SEX</th></div>
 <div class="col-sm-1">   <th>SAB</th></div>
</thead>
	<tbody style="text-align:center;">
<tr>
    <?php 
    
    if(isset($_POST['submit']))
{
	$month= $_POST['month'];
    $year=$_POST['year'];
}else{
    $month= date("m");

    $year=date("Y");
}

	
    $day='01';
    $endDate=date("t",mktime(0,0,0,$month,$day,$year));
    $s=date ("w", mktime (0,0,0,$month,1,$year));
    for ($ds=1;$ds<=$s;$ds++) {
    echo "<td style=\"font-family:arial;color:#B3D9FF\" align=center valign=middle bgcolor=\"#FFFFFF\">
    </td>";}
    for ($d=1;$d<=$endDate;$d++) {
    if (date("w",mktime (0,0,0,$month,$d,$year)) == 0) { echo "<tr>"; }
    $fontColor="#000000";
    if (date("D",mktime (0,0,0,$month,$d,$year)) == "Sun") 
        { $fontColor="red"; 
            echo "<td style=\"font-family:arial;color:#333333\" align=center valign=middle> 
            <span style=\"color:$fontColor\">$d</span>
            </br>
    
    </td>";
    
    }else if (date("D",mktime (0,0,0,$month,$d,$year)) == "Mon") 
        { $fontColor="green"; 
            echo "<td style=\"font-family:arial;color:#333333\" align=center valign=middle> 
            <span style='font-size: 12px; color:$fontColor'>$d</span>
            </br>
    </td>";
    }else if (date("D",mktime (0,0,0,$month,$d,$year)) == "Wed") 
    {   $wed_sql = "SELECT count(id) as total FROM calendar WHERE date = '".$year."-".$month."-".$d."'";
        $result_wed = mysqli_query($con, $wed_sql);
        $row_web = mysqli_fetch_array($result_wed, MYSQLI_ASSOC);
        
        $fontColor="green"; 
        echo "<td style=\"font-family:arial;color:#333333\" align=center valign=middle> 
        <span style='display:block; text-align:right; font-size: 12px; color:$fontColor'>$d</span>
        </br>
        <p>".$row_web['total']."/2</p>
    </td>";
    
    }
    else
            { $fontColor="green"; 
    echo "<td style=\"font-family:arial;color:#333333\" align=center valign=middle> 
    <span style=\"color:$fontColor\">$d</span>
    </br>
    
    </td>";
    }
    if (date("w",mktime (0,0,0,$month,$d,$year)) == 6) { echo "</tr>"; }}

	?>

		</tr>
</tbody>                                             
        
</table>
</center>
</body>
</html>