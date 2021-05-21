<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}
    include './services/conn.php';

    if(isset($_POST['search']) && $_POST['search']!=''){
        $offset=0;

    }else{
        if (isset($_GET['offset'])){
            $offset = $_GET['offset'];
            if($offset<0) $offset=0;
        }else header("Location: index.php?offset=0");
    }

    //PAGINACAO

    $resTotal = mysqli_query($con,'SELECT count(nome) FROM clients');
    $rowTotal = mysqli_fetch_row($resTotal);
    $sumTotal = $rowTotal[0];
    if($offset>=$sumTotal) $offset=$sumTotal-10;
    $indice1 = $offset/10+1;
    if($indice1==1) $index1Disp = 'none'; else $index1Disp = 'inline';
    $indice2 = floor($sumTotal/10)+1;
    if($indice1-$indice2==0) $index2Disp = 'none'; else $index2Disp = 'inline';
    $pag = $indice1." / ".$indice2;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Helper</title>
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
      <div class="sidebarTitle logoPadding"><img src="./assets/images/icon.png" height="45px"></div>
      <a href="index.php?offset0"><div class="sidebarItem activeItem"><i class="fas fa-user-circle"></i> </div></a>
      <!-- <a href="classes.php"><div class="sidebarItem inactiveItem"><i class="fas fa-car"></i> </div></a> -->
      <a href="financial.php?offset0"><div class="sidebarItem"><i class="fas fa-hand-holding-usd inactiveItem"></i> </div></a>
      <a href="material.php"><div class="sidebarItem"><i class="fas fa-box inactiveItem"></i> </div></a>
      <div class="sidebarItem"><i class="fas fa-cog inactiveItem"></i> </div>
      <div class="spacer"></div>
      <a href="http://meridianti.com.br/" target="new"><div style="margin-left:10px"><img width="50px" src="./assets/images/meridian.png" title="Desenvolvido por Meridian TI"> </div></a>
  </div>
    <div id="customContainer">
      <!-- HEADER MOBILE -->
        <div class="row shadowCustom">
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
                <div id="bar" class="row d-md-block d-none ">
                    <!-- BUSCA USUARIO -->
                        <div class="searchBox">
                            <form class="form-inline" method='POST' action='index.php'>
                                <input name="search" class="form-control form-control-sm mr-sm-2" type="search" placeholder="Digite o nome ou CPF" aria-label="Search">
                                <button class="btn btn-sm btn-outline-secondary text-center secondColor" type="submit"><i class="fa fa-search"></i></button>
                                &nbsp;<button class="btn btn-sm btn-outline-secondary text-center secondColor" data-toggle="modal" data-target="#modalAddCliente" type="button"> Novo cliente</button>
                            </form>
                        </div>
                    
                    <!-- ICONES CANTO ESQ -->
                        <div class="barIcons">
                            <!-- <a href="#" ><i class="fas fa-bell verticalAlignent majorIcon grey"></i></a> -->
                            <a href="#"><i class="fas fa-user-circle majorIcon "></i></a>
                            <a href="services/logout.php"><i class="fas fa-sign-out-alt majorIcon"></i></a>
                        </div>                    
                  </div>
                  <!-- CONTEUDO -->
                <div class="floatLeft" class="row">
                        <table class="table table-striped">
                            <thead>
                              <tr>
                                <th scope="col" class="titlePageTitle">
                                Clientes
                                </th>
                                <!-- <th class="d-md-inline d-none" scope="col" colspan="4">
                                <button class="btn btn-sm btn-outline-secondary text-center secondColor" data-toggle="modal" data-target="#modalAddCliente" type="submit"><i class="fa fa-user-plus"></i> Novo</button>
                                </th>                             -->
                              </tr>
                            </thead>
                            <tbody>

                            <?php

                            if (isset($_POST['search'])){
                                $select_query = "SELECT * FROM clients 
                                WHERE nome like '%".$_POST['search']."%'
                                OR cpf like '%".$_POST['search']."%'
                                ORDER BY cod DESC
                                ";
                                $showPag = 'none';

                                $_POST['search'] = '';

                            }else{
                                
                                $select_query = "SELECT * from clients ORDER BY cod DESC LIMIT 10 OFFSET ".$offset." ";

                                $showPag = 'inline';

                            }
                            
                            $result = mysqli_query($con, $select_query);


                            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                // $date = date_create($row['date']);
                                // $student = $row['student'];
                                echo "<tr>";
                                echo "<th scope='col' class='mediumfont'><a href='#' data-toggle='modal' data-target='#modalShowCliente' onclick=getUserData('". $row['cod'] ."')>" . $row['nome'] . "</a></th>";
                                echo "<td scope='col'>" . $row['cpf'] . "</th>";
                                echo "
                                <td class='d-md-inline d-none align-middle' data-toggle='modal' data-target='#modalPagamentos'><a href='#' onclick=getUserPayments('". $row['cod'] ."')><i class='fas fa-coins'></a></td>";
                            }


                            ?>   
                            <tr style="background-color: white;text-align:center">
                              <td colspan=5>
                              <span id="pagination" style="display:<?php echo $showPag ?>">
                            <a href="index.php?offset=<?php echo $offset-10 ?>">
                                <img src="assets/images/arr_left.png" width="15px" style="display:<?php echo $index1Disp ?>">
                            </a>
                                <?php echo $pag ?>
                            <a href="index.php?offset=<?php echo $offset+10 ?>">
                                <img src="assets/images/arr_right.png" width="15px" style="display:<?php echo $index2Disp ?>">
                            </a>
                          </span>

                              </td>
                          </tr>
                          
                            </tbody>
                          </table>

                          
                </div>
            </div>            
        </div>
        
    </div>




<!-- Modal -->
<div class="modal fade" id="modalShowCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
        <form method="POST" action="./services/add_client.php">
            <div class="form-group">
            <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nome</label>
            <input id="nameShowModal" class="form-control" type="text"  disabled>
            </div>
            <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">CPF</label>
            <input id="cpfShowModal" class="form-control" type="text"  disabled>
            </div>
            <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Valor inicial</label>
            <input id="valorShowModal" class="form-control" type="text"  disabled>
            </div>
            <!-- <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Sexo</label>
            <select name="gender" class="form-control" aria-label="Default select example">
                <option selected>Selecione</option>
                <option value="f">Feminino</option>
                <option value="m">Masculino</option>
            </select>
            </div> -->
            
            </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary">Ver tudo</button>
        <!-- <button type="button" class="btn btn-primary">Ligar</button>
        <button type="button" class="btn btn-success">Whatsapp</button> -->
        <button type="button" class="btn btn-danger" data-dismiss="modal">Sair</button>
      </div>
    </div>
  </div>
</div>


<!-- MODAL ADD CLIENTE -->

<div class="modal fade" id="modalAddCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Novo cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
        <form method="POST" action="./services/add_client.php">
            <div class="form-group">
            <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nome</label>
            <input name="name" class="form-control" type="text"  id="example-date-input">
            </div>
            <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">CPF</label>
            <input name="cpf" class="form-control" type="text"  id="example-date-input">
            </div>
            <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Valor inicial</label>
            <input name="valor_inicial" class="form-control" type="text"  id="example-date-input">
            </div>
            <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Tipo de pagamento</label>
            <select name="tipo_pagamento" id="tipo_pagamento" class="form-control" onChange=showPaymentOptions()>
            <option selected value="1">À vista</option>
              <option value="2">Cartão de crédito</option>
              <option value="3">Parcelado</option>
            </select>
            </div>
            <div class="row">
              <div class="col-9" style="display:none" id="divEntrada">
                <label for="exampleFormControlInput1" class="form-label">Entrada</label>
                <input name="entrada" class="form-control" type="text"  id="entrada">
              </div>
              <div class="col-3" style="display:none" id="divParcelas">
                <label for="exampleFormControlInput1" class="form-label">Parcelas</label>
                <select name="parcelas" class="form-control" type="text"  id="parcelas">
                  <option selected value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                </select>
              </div>
            </div>

            
            </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Salvar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
      </div>
      </form>
    </div>
  </div>
</div>


<!-- MODAL PAGAMENTOS -->

<div class="modal fade" id="modalPagamentos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Pagamentos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row letraPequena">
        <div class="col-4"><p><strong>Valor Total: </strong><span id="valor_total_span"></span></p></div>
        <div class="col-4"><p><strong>Pago: </strong><span id="valor_pago_span"></span> </p></div>
        <div class="col-4"><p><strong>Restante: </strong> <span id="valor_restante_span"></span></p></div>
        <div class="col-6"><p><strong>Forma de pagamento:</strong> <span id="valor_tipo_span"></span></p></div>
        <div class="col-6"><p><strong>Situação: </strong><span id="valor_situacao_span"></span></p></div>
      </div>
      </br>

      <div id="tabelaPagamentos"></div>
      </br>  
      
      <div id="divNovoPagamento">
      <h5>Novo pagamento</h5>
       
        <form method="POST" action="./services/add_payment.php">
            <div class="form-group">
            <input name="id_cliente" class="form-control" type="hidden"  id="id_cliente">
            <div class="row">
              <div class="col-6"  id="divEntrada">
                <label for="exampleFormControlInput1" class="form-label">Valor</label>
                <input name="valor" class="form-control" type="text"  id="entrada">
              </div>
              <div class="col-6"  id="divParcelas">
                <label for="exampleFormControlInput1" class="form-label">Data</label>
                <input name="data" class="form-control" type="date"  id="entrada">
              </div>
            </div>
            </div>
       </div>                      
      
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="salvarModalPagamentos">Salvar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Sair</button>
      </div>
      </form>
    </div>
  </div>
</div>


<!-- MODAL DOCUMENTOS -->

<div class="modal fade" id="modalDocumentos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Documentos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
    <ul>
      <li><a href=#>Contrato</a></li>
      <li><a href=#>Agenda de aulas</a></li>
    </ul>
                        
      
   
      
    </div>
  </div>
</div>



<!-- SCRIPTS JAVASCRIPT -->


<script>

    function showPaymentOptions(){
      if(document.getElementById('tipo_pagamento').value == 3){
        document.getElementById('divEntrada').style = "display:block"
        document.getElementById('divParcelas').style = "display:block"
      }else{
        document.getElementById('divEntrada').style = "display:none"
        document.getElementById('divParcelas').style = "display:none"
      }
    }


    function getUserData(id){
        // console.log('getting user data. id: '+id);

        var objXMLHttpRequest = new XMLHttpRequest();
        objXMLHttpRequest.onreadystatechange = function() {
        if(objXMLHttpRequest.readyState === 4) {
            if(objXMLHttpRequest.status === 200) {
                var activeUser = objXMLHttpRequest.responseText
                activeUser = activeUser .split(",");
                activeUser [0] = activeUser [0].substring(1);
                activeUser [activeUser .length - 1] = activeUser [activeUser .length - 1].substring(
                0,
                activeUser [activeUser .length - 1].length - 1
                );
                activeUser .forEach((x, i) => {
                activeUser [i] = activeUser [i].includes('"') ? activeUser [i].replaceAll('"', "").trim()
                    : activeUser [i].replaceAll("'", "").trim();
                });

                document.getElementById('nameShowModal').value = activeUser[0] 
                document.getElementById('cpfShowModal').value = activeUser[1]
                document.getElementById('valorShowModal').value = activeUser[2]
            } else {
                console.log('Error Code: ' +  objXMLHttpRequest.status);
                console.log('Error Message: ' + objXMLHttpRequest.statusText);
            }
        }
        }
        objXMLHttpRequest.open('GET', './services/get_user_data.php?id='+id);
        objXMLHttpRequest.send();
        // console.log(objXMLHttpRequest.responseText);
    }

    function getUserPayments(id){
        console.log('getting user data. id: '+id);

        var objXMLHttpRequest1 = new XMLHttpRequest();
        objXMLHttpRequest1.onreadystatechange = function() {
        if(objXMLHttpRequest1.readyState === 4) {
            if(objXMLHttpRequest1.status === 200) {
                var payments = objXMLHttpRequest1.responseText

                document.getElementById('tabelaPagamentos').innerHTML = payments 
                
            } else {
                console.log('Error Code: ' +  objXMLHttpRequest1.status);
                console.log('Error Message: ' + objXMLHttpRequest1.statusText);
            }
        }
        }
        objXMLHttpRequest1.open('GET', './services/get_user_payments.php?id='+id);
        objXMLHttpRequest1.send();



        var objXMLHttpRequest = new XMLHttpRequest();
        objXMLHttpRequest.onreadystatechange = function() {
        if(objXMLHttpRequest.readyState === 4) {
            if(objXMLHttpRequest.status === 200) {
                var activeUser = objXMLHttpRequest.responseText
                activeUser = activeUser .split(",");
                activeUser [0] = activeUser [0].substring(1);
                activeUser [activeUser .length - 1] = activeUser [activeUser .length - 1].substring(
                0,
                activeUser [activeUser .length - 1].length - 1
                );
                activeUser .forEach((x, i) => {
                activeUser [i] = activeUser [i].includes('"') ? activeUser [i].replaceAll('"', "").trim()
                    : activeUser [i].replaceAll("'", "").trim();
                });

                document.getElementById('id_cliente').value = activeUser[7]
                document.getElementById('valor_pago_span').innerText = activeUser[3]
                document.getElementById('valor_restante_span').innerText = activeUser[4]
                document.getElementById('valor_tipo_span').innerText = activeUser[5]
                document.getElementById('valor_situacao_span').innerText = activeUser[6]
                document.getElementById('divNovoPagamento').style = ""
                document.getElementById('salvarModalPagamentos').style = ""

                if(activeUser[5] !="Parcelado"){
                  document.getElementById('divNovoPagamento').style = "display:none"
                  document.getElementById('salvarModalPagamentos').style = "display:none"
                  document.getElementById('valor_pago_span').innerText = activeUser[2]
                  document.getElementById('valor_restante_span').innerText = '00'
                  document.getElementById('valor_situacao_span').innerText = 'Pago'
                }
                else if(activeUser[6] =="Pago"){
                  document.getElementById('divNovoPagamento').style = "display:none"
                  document.getElementById('salvarModalPagamentos').style = "display:none"
                }

                document.getElementById('valor_total_span').innerText = activeUser[2] 
                

            } else {
                console.log('Error Code: ' +  objXMLHttpRequest.status);
                console.log('Error Message: ' + objXMLHttpRequest.statusText);
            }
        }
        }
        objXMLHttpRequest.open('GET', './services/get_user_data.php?id='+id);
        objXMLHttpRequest.send();
    }

</script>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="assets/bootstrap/js/bootstrap.js"></script>
</body>
</html>