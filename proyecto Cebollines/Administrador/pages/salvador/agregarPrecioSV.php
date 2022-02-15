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
  <!-- cdn de las alertas -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    <?php 
        include '../conexion/conexion.php';
        $uuid_item_sv = $_GET['uuid_item_sv'];
        $sql = "SELECT  * FROM itemssv where uuid_item_sv = '".$uuid_item_sv."'";
        $resultado=mysqli_query($mysqli, $sql);
        while ($row = mysqli_fetch_assoc($resultado)){
            $item_sv =  $row['nombre_item_sv'];
    ?>
      
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Agregar precio a  <b><?= $row['nombre_item_sv'];?> </b></h1><br>
            
<!--             <a class="btn btn-success" href="menus.php">
              Regresar al Menú
            </a> -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <?php }?>
  

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <!-- /.card -->

            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Precio del ítem</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php 
                  include '../conexion/conexion.php';
                  $uuid_item_sv = $_GET['uuid_item_sv'];
                  $sql = "SELECT  * FROM preciossv WHERE uuid_item_sv= '".$uuid_item_sv."'";
                  $resultado=mysqli_query($mysqli, $sql);
                  while ($row = mysqli_fetch_assoc($resultado)){
                      
                ?>
                    <form role="form" method="post" action="configMenuSV.php">
                        <div class="row">
                            <div class="col-sm">
                                <label>Precio Regular</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">$.</span>
                                    </div>
                                    <input type="text" class="form-control" id="precio_regular_sv" name="precio_regular_sv" placeholder="Ingresa el precio Regular" required value="<?= $row['precio_normal_sv'];?>" >
                                    <input type="hidden"id="uuid_item_sv" name="uuid_item_sv" value="<?= $uuid_item_sv ?>">
                                </div>
                            </div>


                            <div class="col-sm">
                                <label>Precio Doble</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">$.</span>
                                    </div>
                                    <input type="text" class="form-control" id="precio_doble_sv" name="precio_doble_sv" placeholder="Ingresa el precio Doble" value="<?=  $row['precio_doble_sv'];?>" >
                                </div>
                            </div>
                            <div class="col-sm">
                                <label>Precio Promocion</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">$.</span>
                                    </div>
                                    <input type="text" class="form-control" id="precio_promocion_sv" name="precio_promocion_sv" placeholder="Ingresa el precio de Promoción" value="<?=  $row['precio_promocion_sv'];?>">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="registrarPrecioSV">Agregar Precio</button>
                        </div>
                    </form>
                    <?php } ?>
                    
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


<div id="modalAgregarItem" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" action="configMenu.php" enctype="multipart/form-data">
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <h4 class="modal-title">Agregar Ítem</h4>
        </div>
        <div class="modal-body">
          

            <!-- Nombre del menu -->
            <label>Nombre del Ítem</label>
             <div class="form-group">
              <div class="input-group">
                <input type="text" class="form-control input-lg" name="nombre_item" placeholder="Ingrese el Nombre del Ítem" id="nombre_item" required>
                <input type="hidden" id="id_seccion" name="id_seccion" value="<?= $id?>">
              </div>
            </div>

            <!-- Descripcion del Menu -->
            <label>Descripción</label>
             <div class="form-group">
              <div class="input-group">
                <input type="text" class="form-control input-lg" name="descripcion_item" placeholder="Ingrese Descripción del Ítem" id="descripcion_item" required>
              </div>
            </div>

            <!-- Ingredientes del Menu -->
            <label>Ingredientes</label>
             <div class="form-group">
              <div class="input-group">
                <textarea class="form-control" id="ingredientes_item" name="ingredientes_item" rows="3"></textarea>
              </div>
            </div>

            <!-- Ingredientes del Menu -->
            <label>Imágen del Ítem</label>
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

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>

          <button type="submit" class="btn btn-primary" name="registrarItem">Guardar Ítem</button>

        </div>
      </form>

    </div>

  </div>

</div>


<?php
    }
?>