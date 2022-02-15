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

  <!-- toogle-switch -->
  <link rel="stylesheet" href="../../dist/css/toggle.css">
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
            <?php
                include '../conexion/conexion.php';
                $uuid_item_sv = $_GET['uuid_item_sv'];
                $uuid_menu_sv = "";
                $sql = "SELECT * FROM itemssv WHERE uuid_item_sv = '".$uuid_item_sv."'";
                $resultado=mysqli_query($mysqli, $sql);
                while ($row = mysqli_fetch_assoc($resultado)){
                    $uuid_seccion_sv = $row['uuid_seccion_sv'];
                }
            ?>

          <a class="btn btn-success" href="agregarItemsSV.php?uuid_seccion_sv=<?= $uuid_seccion_sv?>">
              Regresar al Ítem
            </a>
            <h1>Editar Ítem</h1>
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
                <h3 class="card-title">Datos del Ítem</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->

                <?php
                    include '../conexion/conexion.php';
                    $uuid_item_sv = $_GET['uuid_item_sv'];
                    $sql = "SELECT * FROM itemssv WHERE uuid_item_sv = '".$uuid_item_sv."'";
                    $resultado=mysqli_query($mysqli, $sql);
                    $id_rol = false;
                    while ($row = mysqli_fetch_assoc($resultado)){
                ?>

              <form role="form" method="post" action="configMenuSV.php" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nombre del Ítem</label>
                                <input type="hidden" class="form-control" name="uuid_item_sv" id="uuid_item_sv" value="<?= $row['uuid_item_sv'];?>">
                                <input type="hidden" class="form-control" name="uuid_usuario" id="uuid_usuario" value="<?= $uuid_usuario?>">
                                <input type="text" class="form-control" name="nombre_item_sv" id="nombre_item_sv" value="<?= $row['nombre_item_sv'];?>"> 
                            </div>   
                        </div>
                        <div class="col">
                            <!-- Ingredientes del Menu -->
                            <label>Descripción</label>
                            <div class="form-group">
                            <div class="input-group">
                                
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="5" ><?= $row['descripcion_item_sv'];?></textarea>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 3%;">
                        <div class="col-sm">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Imagen Ítem</label>
                                <div class="card" style="width: 18rem;">
                                    <img class="card-img-top" src="<?= $row['url_imagen_item_sv'];?>">
                                </div>
                            </div>   
                        </div>
                        <div class="col-sm">
                          <!-- Contiene contenido? -->   
                          <div class="form-group"><label >Desea editar la Imagen?</label>
                              <div class="input-group">
                              <label class="switch">
                                  <input type="checkbox" name="item" id="item" onchange="javascript:showContent()">
                                  <span class="slider round"></span>
                              </label>
                              </div>
                          </div>
                      </div>
                      <div class="col-sm">
                          <div id="content" style="display: none;">
                              <!-- Ingredientes del Menu -->
                              <label>Imagen</label>
                              <div class="form-group">
                                  <div class="input-group">
                                      <input type="file" class="" name="imagen" id="imagen" onchange="validarFile(this);">
                                  </div>
                              </div> 
                          </div>  
                      </div>
                    </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="editarItemSV">Guardar Cambios</button>
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


<script>
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
function showContent() {
        element = document.getElementById("content");
        check = document.getElementById("item");
        imagen =  document.getElementById("imagen");
        if (check.checked) {
            element.style.display='block';
            imagen.setAttribute('required','required');
        }
        else {
            
            element.style.display='none';
            document.getElementById('imagen').removeAttribute('required');
        }
    }
</script>

<?php
    }
?>