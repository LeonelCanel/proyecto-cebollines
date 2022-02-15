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
  <title>GALA | Cebollines</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">


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
            <h1>Eliminar Sección</h1>
            <?php
                include '../conexion/conexion.php';
                $uuid_seccion_sv = $_GET['uuid_seccion_sv'];
                $sql = "SELECT * FROM seccionessv WHERE uuid_seccion_sv = '".$uuid_seccion_sv."'";
                $resultado=mysqli_query($mysqli, $sql);
                while ($rowRegreso = mysqli_fetch_assoc($resultado)){
                    $regreso = $rowRegreso['uuid_menu_sv'];
                }
            ?>
            <a class="btn btn-success" href="agregarSeccionesSV.php?uuid_menu_sv=<?= $regreso;?>">
                <i class="far fa-arrow-alt-circle-left"></i>
                Regresar
            </a>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Datos de la Sección</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->

                <?php
                    include '../conexion/conexion.php';
                    $uuid_seccion_sv = $_GET['uuid_seccion_sv'];
                    $sql = "SELECT * FROM seccionessv WHERE uuid_seccion_sv = '".$uuid_seccion_sv."'";
                    $resultado=mysqli_query($mysqli, $sql);
                    while ($row = mysqli_fetch_assoc($resultado)){
                ?>

              <form role="form" method="post" action="configMenuSV.php">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nombre de la sección</label>
                                <input type="hidden" class="form-control" name="uuid_seccion_sv" id="uuid_seccion_sv" value="<?= $row['uuid_seccion_sv'];?>"> 
                                <input type="hidden" class="form-control" name="uuid_usuario" id="uuid_usuario" value="<?= $row['uuid_usuario'];?>"> 
                                <input type="text" class="form-control" name="nombre_seccion_sv" id="nombre_seccion_sv" value="<?= $row['nombre_seccion_sv'];?>"> 
                            </div>   
                        </div>
                        <div class="col">
                        <?php
                            if ($row['ruta'] == null || $row['ruta'] == ""){
                        ?>
                            <br><br><label for="exampleInputEmail1">Esta sección no contiene imagen.</label>
                        <?php } else { ?>
                            <label for="exampleInputEmail1">Imagen de la sección</label><br>
                            <img src="<?= $row['ruta'];?>" width="50%">
                        </div>
                        
                        <?php } ?>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer" >
                  
                    <a class="btn btn-danger" href="agregarSeccionesSV.php?uuid_menu_sv=<?= $regreso;?>">
                        <i class="far fa-arrow-alt-circle-left"></i>
                        Cancelar
                    </a>
                  <button type="submit" class="btn btn-success" name="eliminarSeccionSV">Eliminar Sección</button>
                </div>
              </form>
              <?php } ?>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0
    </div>
    <strong>Copyright &copy; 2021-2025 GALA</strong> All rights reserved.
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
<!-- jquery-validation -->
<script src="../../plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="../../plugins/jquery-validation/additional-methods.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Page specific script -->



<script>
$(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      alert( "Form successful submitted!" );
    }
  });
  $('#quickForm').validate({
    rules: {
      email: {
        required: true,
        email: true,
      },
      password: {
        required: true,
        minlength: 5
      },
      terms: {
        required: true
      },
    },
    messages: {
      email: {
        required: "Please enter a email address",
        email: "Please enter a vaild email address"
      },
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      terms: "Please accept our terms"
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>
</body>
</html>



<?php
    }
?>