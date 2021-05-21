<?php
    include 'conn.php';
    $resCliente = mysqli_query($con,"SELECT * FROM clients WHERE cod = ".$_GET['id']);
    $rowcliente = mysqli_fetch_array($resCliente, MYSQLI_ASSOC);
    $tipo_pagamento = $rowcliente['tipo_pagamento'];

    if($tipo_pagamento != 3){
        return;
    }

    $select_query = "SELECT * from payments WHERE id_cliente=".$_GET['id']." ORDER BY data";
    $showPag = 'inline';
    $result = mysqli_query($con, $select_query);
    $row_cnt = $result->num_rows;
    if ($row_cnt>0){
        echo "<h5>Pagamentos</h5>";
        echo "<table class='table table-striped'>";
        echo "<tr> <th>Data</th><th>Valor</th></tr>";

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

            $date = date_create($row['data']);
            
            echo "<tr>";
            echo "<td scope='col'>" . date_format($date, 'd/m/Y') . "</th>";
            echo "<td scope='col'>" . $row['valor'] . "</th>";
        }

        echo "</tr>";
        echo "</table>";
    }

    
?>