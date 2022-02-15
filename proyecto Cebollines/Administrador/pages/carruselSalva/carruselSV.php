<?php
    session_start();
    $usuario = $_SESSION['username'];
    $uuid_usuario = substr($usuario, 0, 23);
    
    if(!isset($usuario)){
        header("location: ../../login/login.php");
    } else{
      ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GALA - Cebollines</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index.php" class="brand-link">
      <img src="../../dist/img/gorroCebollines.png" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">GALA - Cebollines</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div> -->
      <br>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <?php include('../usuarios/barraLateral.php');  ?>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Carrusel de imagenes</h1><br>
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCarrusel">Agregar Carrusel</button>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title"></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <?php 
                      include '../conexion/conexion.php';
                      $result = mysqli_query($mysqli, "SELECT * FROM carruselsv");
                      while ($row = mysqli_fetch_assoc($result)):
                  ?>

                  <div class="col">
                    <div class="card" style="width: 15rem;">
                      <h3 style="text-align: center;"><b><?= $row['nombre_carrusel_sv'];?></b></h3>
                        <img class="card-img-top" src="<?= $row['ruta_carrusel_sv'];?>" alt="Card image cap">                            
                    </div>
                    <!-- botones de accion en los menu -->
                    <div class="col">
                      <a class="btn btn-success" href="editarCarruselSV.php?uuid_carrusel_sv=<?= $row['uuid_carrusel_sv'];?>">
                        <i class="fas fa-edit"></i>
                      </a> 
                      <a class="btn btn-danger" href="eliminarCarruselSV.php?uuid_carrusel_sv=<?= $row['uuid_carrusel_sv'];?>">
                        <i class="fas fa-trash"></i>
                      </a>
                    </div>
                  </div>
                  <?php endwhile?>
                  </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.1.0
    </div>
    <strong>Copyright &copy; 2021-2025 <a href="">GALA</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>


<div id="modalAgregarCarrusel" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" action="configCarruselSV.php" enctype="multipart/form-data">
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <h4 class="modal-title">Agregar Imagen Carrusel</h4>
        </div>
        <div class="modal-body">
          

            <!-- nombres del usuario -->
            <label>Nombre</label>
             <div class="form-group">
              <div class="input-group">
                <input type="text" class="form-control input-lg" name="nombre" placeholder="Ingresa un nombre a la imagen" id="nombre" required>
                <input type="hidden" class="form-control input-lg" name="uuid_usuario" placeholder="" id="uuid_usuaerio" required value="<?= $uuid_usuario?>">
              </div>
            </div>

            <!-- nombres del usuario -->
            <label>Imágen de Presentación</label>
             <div class="form-group">
              <div class="input-group">
                <input type="file" class="" name="imagen" id="imagen" required onchange="validarFile(this);">
              </div>
            </div>           
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary" name="registrarCarruselSV">Guardar usuario</button>

        </div>
      </form>

    </div>

  </div>

</div>

<script>//Funcion de JS que valida el archivo ingresado al input. Formato y Tamaño.
function validarFile(all)
{
    console.log("Esta ingresando aca");
    //EXTENSIONES Y TAMANO PERMITIDO.
    var extensiones_permitidas = [".png", ".jpg", ".jpeg", ".JPG", ".PNG", ".JPEG"];
    var tamano = 8; // EXPRESADO EN MB.
    var rutayarchivo = all.value;
    var ultimo_punto = all.value.lastIndexOf(".");
    var extension = rutayarchivo.slice(ultimo_punto, rutayarchivo.length);
    if(extensiones_permitidas.indexOf(extension) == -1)
    {
        Swal.fire({
            icon: 'error',
            title: 'Archivo no permitido',
            text: 'Por favor intente de nuevo!',
            footer: ''
          })
        document.getElementById("imagen").value="";
        return; // Si la extension es no válida ya no chequeo lo de abajo.
    }
    if((all.files[0].size / 1048576) > tamano)
    {
        Swal.fire({
            icon: 'error',
            title: '',
            text: 'El archivo no puede superar los + tamano +MB',
            footer: ''
          })
        alert("El archivo no puede superar los "+tamano+"MB");
        document.getElementById(all.id).value = "";
        return;
    }
}
</script>


<?php
    }
?>