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

  <!-- toogle-switch -->
  <link rel="stylesheet" href="../../dist/css/toggle.css">

  <!-- Mostrar alertas Swal Alert 2 -->
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
        $uuid_menu = $_GET['uuid_menu'];
        $sql = "SELECT * FROM menus WHERE uuid_menu = '".$uuid_menu."'";
        $resultado=mysqli_query($mysqli, $sql);
        while ($row = mysqli_fetch_assoc($resultado)){
          $esDomicilio ="";
          if ($row['nombre_menu'] == "DOMICILIO"){
            $esDomicilio = true;
          }
    ?>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Posicionamiento <?= $row['nombre_menu'];?></h1><br>
            <a class="btn btn-success" href="posicionamiento.php?uuid_menu=<?= $uuid_menu;?>">
            <i class="far fa-arrow-alt-circle-left"></i>
              Regresar al Menú
            </a>
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

            <div class="card">
              <div class="card-header">
                <h3 class="card-title"></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <div class="row">
                        <?php if($esDomicilio == true){ ?>
                          <?php
                            include '../conexion/conexion.php';
                            $result = mysqli_query($mysqli, "SELECT * FROM domicilios WHERE uuid_menu = '".$uuid_menu."'");
                            while ($row = mysqli_fetch_assoc($result)):
                          ?>
                        <div class="col">
                          <div class="card" style="width: 10rem;">
                            <h3 style="text-align: center;"><b><?= $row['nombre_domicilio'];?></b></h3>
                              <img class="card-img-top" src="<?= $row['ruta_imagen'];?>" alt="Card image cap">
                          </div>
                        </div>
                        <?php endwhile?>
                        <?php }  else {?>


                        <?php

                            
                              $esDomicilio = false;
                              $uuid_modal ="";
                              $uuid_seccion = "";
                              include '../conexion/conexion.php';
                              $result = mysqli_query($mysqli, "SELECT * FROM secciones WHERE uuid_menu = '".$uuid_menu."' ORDER BY posicionamiento ASC");
                              while ($row = mysqli_fetch_assoc($result)):
                                $uuid_modal = substr($row['uuid_seccion'], 0, 14);
                                $uuid_seccion = $row['uuid_seccion'];
                        ?>
                        <?php if ($row['items'] == 0) { ?>
                          <!-- cuando la seccion tiene imagen -->
                          <div class="col-sm-4">
                            <div class="card" style="width: 12rem;">
                              <h3 style="text-align: center;"><b><?= $row['nombre_seccion'];?></b></h3>
                                <img class="card-img-top" src="<?= $row['ruta'];?>" alt="Card image cap">
                            </div>
                          </div>
                        <?php } else { ?> 

                          <?php if ($row['nombre_seccion'] == 'PROMOCIONES CLUB BI') { ?> 
                              <!-- cuando la seccion tiene imagen -->
                              <div class="col-sm-4">
                                <div class="card" style="width: 12rem;">
                                  <h3 style="text-align: center;"><b><?= $row['nombre_seccion'];?></b></h3>
                                  <a href="editarPosicion.php?uuid_seccion=<?= $uuid_seccion;?>">
                                    <img class="card-img-top" src="<?= $row['ruta'];?>" alt="Card image cap">
                                    <h6 style="text-align: center;">Posición Actual <span class="badge badge-danger"><b><?= $row['posicionamiento'];?></b></span></h6>
                                  </a>  
                                </div>
                              </div>
                          <?php } else { ?>
                              <!-- Cuando la seccion no tiene imagen -->
                              <div class="col-sm-4" style="margin-top: 3%;">
                                <div class="card" style="background-color: #f8981d; width: 100%;">
                                  <!-- <button style="background: transparent; border: none !important; font-size:0; color: white;" data-toggle="modal" data-target="#modal<?= $uuid_modal; ?>"> -->
                                  <a href="editarPosicion.php?uuid_seccion=<?= $uuid_seccion;?>" style="background: transparent; border: none !important; font-size:0; color: white;">
                                    <div class="card-body">
                                      <h5 class="card-title" style="color:white; text-align: center;"><b></b></h5><br>
                                      <h3 style="text-align: center;"><b><?= $row['nombre_seccion'];?></b></h3>
                                    </div>
                                    <h6 style="text-align: center;">Posición Actual <span class="badge badge-danger"><b><?= $row['posicionamiento'];?></b></span></h6>
                                  <!-- </button> -->
                                  </a>  
                                </div>
                              </div>
                            <?php } ?>
                          <?php } ?>
                        <?php endwhile?>
                      <?php } ?>
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
<?php
    }
?>