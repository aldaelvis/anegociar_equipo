<?php
session_start();

    if(!$_SESSION["user_agente"]){
        #echo "inisice session";
        header('location:ingreso');
    }
    else{
        #echo $_SESSION["idusuario"];
    }

?>
<div id="bloque-principal-agente">
    <h1 class="page-title">Saldos y  <span style="color: #2196F3;">Movimientos</span></h1>
</div>