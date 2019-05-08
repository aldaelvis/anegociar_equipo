<?php
session_start();

    if(!$_SESSION["user_admin"]){
        #echo "inisice session";
        header('location:ingreso');
    }
    else{
        #echo $_SESSION["idusuario"];
    }

?>
<script type="text/javascript" src="vista/temas/js/jquery-3.3.1.js"></script>
<script type="text/javascript" src="vista/temas/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://editor.datatables.net/extensions/Editor/js/dataTables.editor.min.js"></script>

<link rel="stylesheet" href="vista/temas/css/jquery.dataTables.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<div id="bloque-listar-todo">
    <h1>Listar </h1>
	<div class="bloque-listar-todo">

<?php
    if (isset($_GET["rol"])) {
    
    ?>
    <a href="#">Nuevo Agente</a>
        <table id="tablaSuscriptores" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Firstname</th>
                    <th>Estado</th>
                    <th>Usuario</th>
                    <th>Ubicación</th>
                    <th>Saldo</th>
                    <th>Operaciones</th>
                </tr>
            </thead>
        <tbody>
                <?php

                    $ingreso = new GestorUsuariosController();
                    $ingreso -> listarUsuariosPorRol();

                ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Nombres</th>
                <th>Estado</th>
                <th>Usuario</th>
                <th>Ubicación</th>
                <th>Saldo</th>
                <th>Operaciones</th>
            </tr>
        </tfoot>
    </table>
    <?php
}
?>


<?php
if (isset($_GET["cat"])) {
    
    ?>
    <a href="#">Nueva Categoria</a>
    <table id="tablaSuscriptores" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Nombres</th>
                    <th>Estado</th>
                    <th>Usuario</th>
                    <th>Ubicación</th>
                    <th>Saldo</th>
                    <th>Operaciones</th>
                    <th></th>
                </tr>
            </thead>
        <tbody>
                <?php

                    $ingreso = new GestorCategoriasController();
                    $ingreso -> listarCategoriasController();

                ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Nombres</th>
                <th>Estado</th>
                <th>Usuario</th>
                <th>Ubicación</th>
                <th>Saldo</th>
                <th>Operaciones</th>
                <th></th>
            </tr>
        </tfoot>
    </table>
    <?php
}
?>

    </div>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Modal Header</h4>
          </div>
          <div class="modal-body">
              <div class="form-group">
                <label>First Name</label>
                <input type="text" id="firstName" class="form-control">
              </div>
              <div class="form-group">
                <label>Last Name</label>
                <input type="text" id="lastName" class="form-control">
              </div>

               <div class="form-group">
                <label>Email</label>
                <input type="text" id="email" class="form-control">
              </div>
                <input type="hidden" id="userId" class="form-control">


          </div>
          <div class="modal-footer">
            <a href="#" id="save" class="btn btn-primary pull-right">Update</a>
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

</div>

<!-- <script type="text/javascript" src="vista/temas/js/script.js"></script> -->
<script type="text/javascript">
    $(document).ready(function(){

    //  append values in input fields
      $(document).on('click','a[data-role=update]',function(){
            var id  = $(this).data('id');
            var firstName  = $('#'+id).children('td[data-target=firstName]').text();
            var lastName  = $('#'+id).children('td[data-target=lastName]').text();
            var email  = $('#'+id).children('td[data-target=email]').text();

            $('#firstName').val(firstName);
            $('#lastName').val(lastName);
            $('#email').val(email);
            $('#userId').val(id);
            $('#myModal').modal('toggle');
      });

      // now create event to get data from fields and update in database 

       $('#save').click(function(){
          var id  = $('#userId').val(); 
         var firstName =  $('#firstName').val();
          var lastName =  $('#lastName').val();
          var email =   $('#email').val();

          $.ajax({
              url      : 'vista/modulos/ajax/ajax.php',
              method   : 'post', 
              data     : {firstName : firstName , lastName: lastName , email : email , id: id},
              success  : function(respuesta){
                            // now update user record in table 
                            
                             $('#'+id).children('td[data-target=firstName]').text(firstName);
                             $('#'+id).children('td[data-target=lastName]').text(lastName);
                             $('#'+id).children('td[data-target=email]').text(email);
                             $('#myModal').modal('toggle');
                             
                /*
                if(respuesta == success){

                    $("label[for='usuarioRegistro'] span").html('<p>Este usuario ya existe en la base de datos</p>');

                    usuarioExistente = true;
                }

                else{

                    $("label[for='usuarioRegistro'] span").html("");
                    usuarioExistente = false;

                }
                */
                         }
          });
       });
    });
</script>
<script type="text/javascript">

    $(document).ready(function() {
    $('#tablaSuscriptores').DataTable();
} );

    $('#tablaSuscriptores').DataTable({
    "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
});

</script>