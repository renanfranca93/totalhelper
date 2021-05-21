<?php 


include 'conn.php';

$select_query = "INSERT INTO `clients`(`nome`, `cpf`, `valor_inicial`, `tipo_pagamento`, `entrada`, `parcelas`) 
VALUES ('".$_POST['name']."','".$_POST['cpf']."','".$_POST['valor_inicial']."','".$_POST['tipo_pagamento']."','".$_POST['entrada']."','".$_POST['parcelas']."')";

$result = mysqli_query($con, $select_query);

header("Location: ../index.php?offset=0");

?>
