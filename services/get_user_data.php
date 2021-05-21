<?php
    include 'conn.php';
    $resTotal = mysqli_query($con,"SELECT * FROM clients WHERE cod = ".$_GET['id']);
    $rowTotal = mysqli_fetch_array($resTotal, MYSQLI_ASSOC);
    $nome = $rowTotal['nome'];
    $id = $rowTotal['cod'];
    $cpf = $rowTotal['cpf'];
    $valor_inicial = $rowTotal['valor_inicial'];
    $tipo_pagamento = $rowTotal['tipo_pagamento'];
    if($tipo_pagamento ==1) $tipo_pagamento = "À vista";
    else if($tipo_pagamento ==2) $tipo_pagamento = "Crédito";
    else if($tipo_pagamento ==3) $tipo_pagamento = "Parcelado";

    $resTotal2 = mysqli_query($con,"SELECT SUM(valor) as valor_pago FROM payments WHERE id_cliente = ".$_GET['id']);
    $rowTotal2 = mysqli_fetch_array($resTotal2,MYSQLI_ASSOC);

    $valor_pago = $rowTotal2['valor_pago'];
    $restante = $valor_inicial-$valor_pago;
    if($restante==0) $situacao = "Pago";
    else $situacao = "Pendente";

    $teste = [$nome, $cpf, $valor_inicial, $valor_pago, $restante, $tipo_pagamento, $situacao, $id];

    echo "['".implode("','",$teste)."']";

?>