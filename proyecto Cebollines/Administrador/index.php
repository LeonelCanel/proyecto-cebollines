<?php
    session_start();
    $usuario = $_SESSION['username'];
    $uuid_usuario = substr($usuario, 0, 23);
    if(!isset($usuario)){
        header("location: login/login.php");
    } else{
?>
 
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | Cebollines</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
</head>
<body  class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/gorroCebollines.png" alt="AdminLTELogo" height="60" width="60">
  </div>

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
    <a href="index.php" class="brand-link">
      <img src="dist/img/gorroCebollines.png" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
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


      
<?php
    include 'pages/conexion/conexion.php';        
    $contador = 0;
    $usuarioObtenido = "";
    $tipoRol = "";
    $result = mysqli_query($mysqli, "SELECT u.uuid_usuario, u.usuario, u.nombres_usuario, u.apellidos_usuario, u.correo, u.uuid_rol, r.uuid_rol, r.tipo_rol  FROM usuarios as u INNER JOIN rol as r ON u.uuid_rol = r.uuid_rol WHERE u.uuid_usuario = '$uuid_usuario'");
    $contador = 0;
    while ($row = mysqli_fetch_assoc($result)):
        $contador++;
        $usuarioObtenido = $row['nombres_usuario'];
        $usuarioApellido = $row['apellidos_usuario'];
        $tipoRol = $row['tipo_rol'];
    endwhile;
?>
<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">  
      <li class="nav-header">
          <b>Usuario Logueado</b> 
      </li>
      <li class="nav-header"><?php echo $usuarioObtenido." ".$usuarioApellido; ?></li>
      <hr>
      <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
        <?php if ($tipoRol == 'ADMINISTRADOR'){ ?>
          <li class="nav-header">
            <b>Usuarios</b> 
          </li>
          <li class="nav-item">
              <a href="" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                      Usuarios
                  <i class="fas fa-angle-left right"></i>
                  </p>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                  <a href="pages/usuarios/usuarios.php" class="nav-link">
                      <i class="fas fa-eye"></i>
                      <p>Ver Usuarios</p>
                  </a>
                  </li>
              </ul>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                  <a href="pages/usuarios/roles.php" class="nav-link">
                      <i class="fas fa-user-tie"></i>
                      <p>Roles</p>
                  </a>
                  </li>
              </ul>
          </li>
        <?php } ?>
            <hr>
        <li class="nav-header">
            <i class="fas fa-map-marked-alt"></i>
            <b>Guatemala</b>
        </li> 
        
        <li class="nav-item">
        <a href="pages/menus/menus.php" class="nav-link">
            <i class="nav-icon fas fa-utensils"></i>
            <p>
                Menú Guatemala
            </p>
        </a>
        </li>

        <li class="nav-item">
        <a href="pages/carruselGuate/carrusel.php" class="nav-link">
            <i class="fas fa-photo-video"></i>
            <p>
                Carrusel Guatemala
            </p>
        </a>
        </li>

        <hr>
        <li class="nav-header">
            <i class="fas fa-map-marked-alt"></i>
            <b>Salvador</b>
        </li> 
        
          <li class="nav-item">
            <a href="pages/salvador/menusSalvador.php" class="nav-link">
              <i class="nav-icon fas fa-utensils"></i>
              <p>
                Menú Salvador
              </p>
            </a>
          </li>


          <li class="nav-item">
        <a href="pages/carruselSalva/carruselSV.php" class="nav-link">
            <i class="fas fa-photo-video"></i>
            <p>
                Carrusel Salvador
            </p>
        </a>
        </li>
        <br>

        <li class="nav-header">
            <i class="fas fa-business-time"></i>
            <b>Mercadito</b>
        </li> 
        
          <li class="nav-item">
            <a href="pages/mercadito/mercadito.php" class="nav-link">
            <i class="fas fa-drumstick-bite"></i>
              <p>
                Mercadito
              </p>
            </a>
          </li>
        <li class="nav-header" style="margin-top:45%;">Salir</li>
        <li class="nav-item">
        <a href="login/login.php" class="nav-link">
        <i class="fas fa-sign-out-alt"></i>
            <p>
            Cerrar Sesión
            </p>
        </a>
        </li>
    </ul>
</nav>
<!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <?php
    include 'pages/estadisticasGuate/estadisticasGuate.php';
  ?>
  <!-- /.content-wrapper -->




  <footer class="main-footer">
    <strong>Copyright &copy; 2021-2025 <a href="">GALA</a>.</strong> All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

</body>
</html>
  

<?php
    }
?>

