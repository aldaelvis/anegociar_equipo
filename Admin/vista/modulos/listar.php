<?php
session_start();
if(!$_SESSION["user_admin"]){
    echo "inisice session";
    header('location:ingreso');
}
else{
    #echo $_SESSION["idusuario"];
}
?>
<div class="container-fluid">
    <div class="box"> 
       <div class="box-header with-border">
          <h5 class="box-title">Listado de Agentes</h5>
          <a href="#pop2">
            <button class="btn btn-info" id="buttonAgregar">
              <i class="fa fa-plus-circle"></i> Agregar
            </button>
          </a>
       </div>
       <div class="box-body">
        <div style="overflow-x: auto;">
           <table id="agentesData" class="table table-bordered  table-striped">
               <thead>
                   <th>Opciones</th>
                   <th>Usuario</th>
                   <th>Nombres</th>
                   <th>Apellidos</th>
                   <th>E-mail</th>
                   <th>Saldo</th>
                   <th>Fecha Creación</th>
                   <th>Estado</th>
               </thead>
               <tbody>
               </tbody>
               <tfoot>
                   <th>Opciones</th>
                   <th>Usuario</th>
                   <th>Nombres</th>
                   <th>Apellidos</th>
                   <th>E-mail</th>
                   <th>Saldo</th>
                   <th>Fecha Creación</th>
                   <th>Estado</th>
               </tfoot>
           </table>
         </div>
       </div>
    </div> 
</div>
<!--modal-->
<div id="pop2" class="pop-up">
    <div class="popBox">
        <div class="popScroll">
          <div class="container-fluid">
            <h1>Registro de Cuenta Nueva</h1>
            <form method="post" action="" id="formRegistrar">
              <div class="form-group">
                <input type="hidden" name="idusuario" id="idusuario">
                <label for="usuarioRegistro">Usuario<span></span></label>
                <input type="text" class="form-control" placeholder="Máximo 10 caracteres" maxlength="10" id="usuarioRegistro" name="usuarioRegistro" required>
              </div>
              <div class="form-group">
                <label for="passwordRegistro">Contraseña</label>
                <input type="password" class="form-control" placeholder="Mínimo 6 caracteres, incluir número(s) y una mayúscula" minlength="6" name="passwordRegistro" id="passwordRegistro" required>
              </div>
              <div class="form-group">
                <label for="emailRegistro">Correo electrónico<span></span></label>
                <input type="email" class="form-control" placeholder="Escriba su correo electrónico correctamente" id="emailRegistro" name="emailRegistro" required>
              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-primary" name="guardarUsuario" value="Guardar Usuario" onclick="cerrarModal();">
              </div>
            </form>
          </div>
        </div>
        <a href="#" class="close"><span>Close</span></span></a>
    </div>
    <a href="#" class="lightbox">Back to links</a>
</div>
<div id="recargar" class="pop-up">
    <div class="popBox">
        <div class="popScroll">
          <div class="container-fluid">
            <h1>Recargar usuario: <span id="nombre-usuario"></span></h1>
            <form method="post" id="formRecargar">
              <div class="form-group">
                <input type="hidden" name="idusuariorecarga" id="idusuariorecarga">
                <label for="usuarioRegistro">Monto a recargar<span></span></label>
                <input type="text" class="form-control" placeholder="Ingrese el monto" id="saldo" name="saldo" required>
              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Recargar" onclick="cerrarModal();">
              </div>
            </form>
          </div>
        </div>
        <a href="#" class="close"><span>Close</span></span></a>
    </div>
    <a href="#" class="lightbox">Back to links</a>
</div>
<!--fin del modal-->
<script>
var tabla;
function init(){
    listarUsurios();
    $("#formRegistrar").on("submit", function(e)
    {
        guardaryeditar(e);
    });
    $("#formRecargar").on("submit", function(e)
    {
        recargarSaldo(e);
    });
}

function limpiar(){
    $("#idusuario").val("");
    $("#usuarioRegistro").val("");
    $("#passwordRegistro").val("");
    $("#emailRegistro").val("");
}

function listarUsurios(){
    tabla = $('#agentesData').dataTable(
        {
            "aProcessing": true,
            "aServerSide": true,
            dom: 'Bfrtip',
            responsive: true,
            "ajax":{
                    url: 'vista/modulos/ajax/ajax.php?op=listarUsuarios',
                    type: 'get',
                    dataType: 'json',
                    error: function(e) {
                        console.log(e.responseText);
                    }
            },
            'bDestroy':true,
            'iDisplayLength':15, //paginación
            'order': [2, 'asc'] //ordenar (columna, orden)
        }
    ).DataTable();
}

//Guardar
function guardaryeditar(e) {
    e.preventDefault();
    var formdata = new FormData($("#formRegistrar")[0]);

    $.ajax({
        url: 'vista/modulos/ajax/ajax.php?op=guardaryeditar',
        type: 'POST',
        data: formdata,
        contentType: false,
        processData: false,
        success: function( datos ) {
            console.log(datos);
            tabla.ajax.reload();
        }
    });
    limpiar();
    
}
function mostrar(id){
  $.post("vista/modulos/ajax/ajax.php?op=mostrar",
        { id : id },
        function (data, status) {
         data = JSON.parse(data);

         $("#usuarioRegistro").val(data.usuario);
         $("#emailRegistro").val(data.email);
         $("#passwordRegistro").val(data.password);
         $("#idusuario").val(data.idusuario);
        }
  );
}

function desactivar(id){
  alertify.confirm('Anegociar Admin','¿Desea desactivar el usuario?', 
    function(){ 
      $.post('vista/modulos/ajax/ajax.php?op=desactivar',{id:id}, function (e) {
               tabla.ajax.reload();
               alertify.success('Usuario desactivado correctamente.');
            });
    }, 
    function(){ 
    }
  );
}

function activar(id){
  alertify.confirm('Anegociar Admin','¿Desea activar el usuario?', 
    function(){ 
      $.post('vista/modulos/ajax/ajax.php?op=activar',{id:id}, function (e) {
                tabla.ajax.reload();
                alertify.success('Usuario activado correctamente.');
            });
  }, 
  function(){ 
  });
}

function recargar(id){
  $.post("vista/modulos/ajax/ajax.php?op=mostrar",
        { id : id },
        function (data, status) {
         data = JSON.parse(data);
         $("#nombre-usuario").text(data.nombres + ", "+data.apellidos);
         $("#idusuariorecarga").val(data.idusuario);
        }
  );
}

function recargarSaldo(e){
    e.preventDefault();
    var formdata = new FormData($("#formRecargar")[0]);

    $.ajax({
        url: 'vista/modulos/ajax/ajax.php?op=recargar',
        type: 'POST',
        data: formdata,
        contentType: false,
        processData: false,
        success: function( datos ) {
            console.log(datos);
            tabla.ajax.reload();
        }
    });
    limpiar();
}
function cerrarModal() {
  window.location.href = 'index.php?action=listar&rol=agente';
}
init();
</script>