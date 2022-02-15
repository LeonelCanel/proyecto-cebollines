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

  <!-- Script que funcionan para la colocacion de mensajes de alerta -->
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
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

  <?php 
        include '../conexion/conexion.php';
        $uuid_seccion_sv = $_GET['uuid_seccion_sv'];
        $uuid_menu_sv = "";
        echo "<script>console.log('uuid_seccion_sv: " . $uuid_seccion_sv . "' );</script>";
        $sql = "SELECT * FROM seccionessv WHERE uuid_seccion_sv = '".$uuid_seccion_sv."'";
        $resultado=mysqli_query($mysqli, $sql);
        while ($row = mysqli_fetch_assoc($resultado)){
          $esDomicilio ="";
          $uuid_menu_sv = $row['uuid_menu_sv'];
          if ($row['nombre_menu_sv'] == "DOMICILIO"){
            $esDomicilio = true;
          }
        }
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Editar Posición</h1>
            <a class="btn btn-success" href="posicionamientoSV.php?uuid_menu_sv=<?= $uuid_menu_sv;?>">
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
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Posicionamiento</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <?php
                    include '../conexion/conexion.php';
                    $uuid_seccion_sv = $_GET['uuid_seccion_sv'];
                    $uuid_menu_sv = "";
                    $sql = "SELECT * FROM seccionessv WHERE uuid_seccion_sv = '".$uuid_seccion_sv."'";
                    $resultado=mysqli_query($mysqli, $sql);
                    $id_rol = false;
                    while ($row = mysqli_fetch_assoc($resultado)){
                        $uuid_menu_sv = $row['uuid_menu_sv'];
                ?>

            <form method="post" >
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Posición Actual</label>
                                <input type="hidden" class="form-control" name="uuid_seccion_sv" id="uuid_seccion_sv" value="<?= $row['uuid_seccion_sv'];?>"> 
                                <input type="text" class="form-control" id="orden" name="orden" placeholder="Ejemplo: 5" maxlength="2"  value="<?= $row['posicionamiento'];?>" onKeyPress="return soloNumeros(event)"> 
                                <input type="hidden" class="form-control" name="uuid_usuario" id="uuid_usuario" value="<?= $uuid_usuario ?>"> 
                            </div>   
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="registrarPosicion">
                  <i class="far fa-save"></i>
                  Guardar Cambios</button>
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




</body>
</html>
<?php
    }
?>

<script type="text/javascript">
// Solo permite ingresar numeros.
function soloNumeros(e){
	var key = window.Event ? e.which : e.keyCode
	return (key >= 48 && key <= 57)
}
</script>



<?php
    include '../conexion/conn.php';
    if (isset($_POST['registrarPosicion'])) {
        $posicion = $_POST['orden'];
        echo "<script>console.log('posicion: " . $posicion . "' );</script>";
        $sql = "UPDATE seccionessv SET posicionamiento = '$posicion' WHERE uuid_seccion_sv = '$uuid_seccion_sv'";
            if (mysqli_query($conn, $sql)) {
                ?>
                <script LANGUAGE="javascript">
                    $(document).ready(function() {
                        Swal.fire({
                        title: 'Actualización',
                        text: "Datos actualizados correctamente correctamente. =)",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "posicionamientoSV.php?uuid_menu_sv=<?= $uuid_menu_sv;?>";
                        }
                        })
                    });
                </script>                
                <?php 
            } else {
                /* Mensaje de alerta cuando algo no se hace bien */
                include 'mensajes/mensajeError.php';
            }
            mysqli_close($conn);
    }
?>