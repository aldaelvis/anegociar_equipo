<div id="bloque-contenedor-registro">
<?php
if(isset($_GET["action"])){

    if($_GET["action"] == "registro_exitoso"){

        echo '
                <div id="mensaje">
                    <div class="mensaje">
                        <span>Usted se registro correctamente verifique su correo</span>
                    </div>
                </div>
            ';
        #header("location:usuario");
    
    }

}
?>
<?php
ob_start();
?>
    <div class="bloque-registro">
        <h1>Nuevo <span style="color: #2196F3;"><?php echo $_GET["rol"]?></span></h1>
        <form method="post" onsubmit="return validarRegistro()">

            <label>Ingresar Nombres</label>
            <input type="text" name="nombresRegistro" class="form-control" placeholder="Ingrese un nombre (Opcional)" autocomplete="off">

            <label>Ingresar Apellidos</label>
            <input type="text" name="apellidosRegistro" class="form-control" placeholder="Ingrese el apellido (Opcional)" autocomplete="off">

            <label for="saldoRegistro">Asignar Saldo<span></span></label>
            <input type="number" step="any" placeholder="Ingrese el saldo del usuario" name="saldoRegistro" id="saldoRegistro" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) ||  
     event.charCode == 44 || event.charCode == 0 " required>
            
            <label for="usuarioRegistro">Usuario</label>
            <input type="text" placeholder="Minimo 6 caracteres" minength="6" name="usuarioRegistro" id="usuarioRegistro" required>

            <label for="passwordRegistro">Contraseña</label>
            <input type="password" placeholder="Mínimo 6 caracteres, incluir número(s) y una mayúscula" name="passwordRegistro" id="passwordRegistro" required>
            <!-- <input type="password" placeholder="Mínimo 6 caracteres, incluir número(s) y una mayúscula" name="passwordRegistro" id="passwordRegistro" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" required> -->

            <label for="emailRegistro">Correo electrónico</label>
            <input type="email" placeholder="Escriba su correo electrónico correctamente" name="emailRegistro" id="emailRegistro" required>

            <div class="boton-enviar-registro">
                <input type="submit" value="Enviar">
            </div>

        </form>
    </div>
</div>

<?php

$registro = new GestorUsuariosController();
$registro -> nuevoUsuarioController();

/*
if(isset($_GET["action"])){

    if($_GET["action"] == "registro_exitoso"){

        echo "Registro Exitoso";
        #header("location:usuario");
    
    }

}
*/
?>