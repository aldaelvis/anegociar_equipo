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
<div id="bloque-saldo-agente">
    <h1 class="page-title">Recarga <span style="color: #2196F3;">de saldo</span></h1>
    <div class="saldo-agente">
        <?php
            if(isset($_GET["action"])){

                if($_GET["action"] == "recargar_saldo"){
                    
                    echo '
                            <div id="mensaje">
                                <div class="mensaje">
                                    <span>Lo sentimos pero usted no cuenta con saldo suficiente
                                </div>
                            </div>
                        ';
                    #header("location:usuario");
                
                }

            }
        ?>
        <div class="bloque-recargar">
            <h3>Estimado Agente para recargar saldo haga lo siguiente: </h3>
            <p>1. Diríaje a un <span style="color: #E65100">"Agente BCP"</span> </br>OJO solo agente no banco ni ventanilla. </p>
            <p>2. Haga un depósito mayor a S/. 10.00 (Diez soles) a la siguiente <span style="color: #E65100">"cuenta de ahorros"</span>: 215-25157327-0-37 a Nombre de: Luz Marina Roman.</p>
            <p>3. Comuníquese con nosotros al: 958155581 
            <p>¡Eso es todo!, confirmaremos los datos de pago y su saldo se cargará automaticamente.</p>
        </div>
    </div>
</div>