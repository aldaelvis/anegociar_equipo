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

<?php

                    $mostrarDepartamentosController = new GestorUsuariosController();
                    $mostrarDepartamentosController -> mostrarDepartamentosController();

                ?> 

    <div id="app">
{{arrayDepartamento}}

</div>
<script>
new Vue({
    el: "#app",
    data: {
        arrayDepartamento: []
    },
    methods: {
        listarDepartamentos: function()
        {
            let me = this;
            axios.get('$mostrarDepartamentosController = new GestorUsuariosController();                    $mostrarDepartamentosController -> mostrarDepartamentosController();          ')
            .then(function(response){
                me.arrayDepartamentos = response.data;
                console.log(me.arrayDepartamentos);
            })
            .catch(function(e){
                console.log(e);
            })
        },
    },
    mounted() {
        this.listarDepartamentos();
    }
});
</script>


<div id="bloque-listar-todo">
    <h1>Listar <span style="color: #2196F3;"><?php echo $_GET["rol"]?></span></h1>

    <div class="boton-nuevo">
        <a href="index.php?action=nuevo&rol=<?php echo $_GET["rol"]?>" class="nuevo">Nuevo <?php echo $_GET["rol"]?></a>
    </div>

    <div class="bloque-listar-todo">

<?php
    if (isset($_GET["rol"])) {
    
    ?>
    
        <table id="tablaSuscriptores" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Nombres</th>
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

</div>
 
<!-- <script type="text/javascript" src="vista/temas/js/script.js"></script> -->
<script type="text/javascript">

    // <!-- $(document).ready(function() { -->
    // $('#tablaSuscriptores').DataTable();
// } );

$(document).ready(function() {
    $('#tablaSuscriptores').DataTable( {
        "order": [[ 1, "desc" ]]
    } );
} );

//     $('#tablaSuscriptores').DataTable({
//     "language": {
//             "sProcessing":     "Procesando...",
//             "sLengthMenu":     "Mostrar _MENU_ registros",
//             "sZeroRecords":    "No se encontraron resultados",
//             "sEmptyTable":     "Ningún dato disponible en esta tabla",
//             "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
//             "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
//             "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
//             "sInfoPostFix":    "",
//             "sSearch":         "Buscar:",
//             "sUrl":            "",
//             "sInfoThousands":  ",",
//             "sLoadingRecords": "Cargando...",
//             "oPaginate": {
//                 "sFirst":    "Primero",
//                 "sLast":     "Último",
//                 "sNext":     "Siguiente",
//                 "sPrevious": "Anterior"
//             },
//             "oAria": {
//                 "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
//                 "sSortDescending": ": Activar para ordenar la columna de manera descendente"
//             }
//         }
// });

</script>