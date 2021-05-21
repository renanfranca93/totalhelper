<?php 


include 'conn.php';

if(isset($_GET['del'])){
    $del = true;
}else $del = false;

$idu = $_GET['idu'];
$idt = $_GET['idt'];
$date = $_GET['date'];
$class = $_GET['class'];

// echo "user_id: ".$idu." teacher_id: ".$idt." date: ".$date." class: ".$class;

if($del){
    $select_query = "DELETE FROM `calendar` WHERE `id_teacher` = ".$idt." AND `id_client` = ".$idu." AND `date` = '".$date."' AND `class`=".$class;
    
}else{
    $select_query = "INSERT INTO `calendar`(`id_teacher`, `id_client`, `date`, `class`) 
VALUES (".$idt.",".$idu.",'".$date."',".$class.")";

}


$result = mysqli_query($con, $select_query);

header("Location: ../classes.php?idt=".$idt."&idu=".$idu."");

?>