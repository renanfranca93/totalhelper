<?php 


include 'conn.php';

$select_query = "INSERT INTO `payments`(`data`, `valor`, `id_cliente`) 
VALUES ('".$_POST['data']."','".$_POST['valor']."','".$_POST['id_cliente']."')";

$result = mysqli_query($con, $select_query);


header("Location: ../index.php?offset=0");

?>
