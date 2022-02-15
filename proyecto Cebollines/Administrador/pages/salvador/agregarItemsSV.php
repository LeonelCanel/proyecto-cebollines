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
        $uuid_seccion_sv = $_GET['uuid_seccion_sv'];
        $nombre_seccion_sv = "";
        $sql = "SELECT nombre_item_sv, url_imagen_item_sv, descripcion_item_sv, nombre_seccion_sv FROM itemssv t1 INNER JOIN seccionessv t2 where t2.uuid_seccion_sv = '".$uuid_seccion_sv."'";
        $resultado=mysqli_query($mysqli, $sql);
        while ($row = mysqli_fetch_assoc($resultado)){
          $nombre_seccion_sv = $row['nombre_seccion_sv'];
        }
    ?>
      
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <?php
            include '../conexion/conexion.php';
            $uuid_seccion_sv = $_GET['uuid_seccion_sv'];
            $sql = "SELECT * FROM seccionessv WHERE uuid_seccion_sv = '".$uuid_seccion_sv."'";
            $resultado=mysqli_query($mysqli, $sql);
            while ($rowRegreso = mysqli_fetch_assoc($resultado)){
                $regreso = $rowRegreso['uuid_menu_sv'];
            }
          ?>
            <h1>Items de la Sección de <?= $nombre_seccion_sv?></h1><br>
            <a class="btn btn-success" href="agregarSeccionesSV.php?uuid_menu_sv=<?= $regreso;?>">
              <i class="far fa-arrow-alt-circle-left"></i>
              Regresar
            </a>
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarItem">
            <i class="fas fa-plus"></i>
              Agregar Ítem</button>
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
                            $result = mysqli_query($mysqli, "SELECT i.uuid_item_sv, i.nombre_item_sv, i.url_imagen_item_sv, i.descripcion_item_sv, i.uuid_seccion_sv, p.precio_normal_sv, p.precio_doble_sv, p.precio_promocion_sv, p.item_contiene_precio_sv FROM itemssv i INNER JOIN preciossv p ON i.uuid_item_sv = p.uuid_item_sv WHERE i.uuid_seccion_sv = '".$uuid_seccion_sv."'");
                            while ($row = mysqli_fetch_assoc($result)):
                              $contienePrecio = $row['item_contiene_precio_sv'];
                              if ($contienePrecio == 1){
                        ?>

                        <div class="col" style="margin-top: 5%;">
                          <div class="card" style="width: 15rem;">
                            <h3 style="text-align: center;"><b><?= $row['nombre_item_sv'];?></b></h3>
                              <img class="card-img-top" src="<?= $row['url_imagen_item_sv'];?>" alt="Card image cap">
                              <?php if ($row['precio_doble_sv'] != 0) { ?>
                                <div class="row" style="">
                                  <div class="col" style="text-align: center; ">
                                    <b><h3 >$. <?= $row['precio_normal_sv'];?></h3></b>
                                    <label>Normal</label>
                                  </div>
                                  <div class="col">
                                    <b><h3>$. <?= $row['precio_doble_sv'];?></h3></b>
                                    <label>Doble</label>
                                  </div>
                                </div>
                                <?php } else {  ?>
                                <div class="row" style="text-align: center; ">
                                  <div class="col">
                                    <b><h3 style="text-align: center; ">$. <?= $row['precio_normal_sv'];?></h3></b>
                                    <label>Normal</label>
                                  </div>
                                </div>
                                <?php } ?>
                            
                          </div>
                          <!-- botones de accion en los menu -->
                          <div class="col">
                                <a class="btn btn-success" href="editarItemSV.php?uuid_item_sv=<?= $row['uuid_item_sv'];?>">
                                    <i class="fas fa-edit"></i>
                                </a> 

                                <a class="btn btn-danger" href="eliminarItemSV.php?uuid_item_sv=<?= $row['uuid_item_sv'];?>">
                                  <i class="fas fa-trash"></i>
                                </a>

                                <a class="btn btn-warning" href="agregarPrecioSV.php?uuid_item_sv=<?= $row['uuid_item_sv'];?>">
                                  <i class="far fa-money-bill-alt"></i>
                                </a>

                                <a class="btn btn-info" href="quitarPrecio.php?uuid_item_sv=<?= $row['uuid_item_sv'];?>">
                                <i class="fas fa-broom"></i>
                                </a>
                            </div>
                        </div>

                        <?php } else {  ?>
                          <div class="col">
                          <div class="card" style="width: 15rem;">
                            <h3 style="text-align: center;"><b><?= $row['nombre_item_sv'];?></b></h3>
                              <img class="card-img-top" src="<?= $row['url_imagen_item_sv'];?>" alt="Card image cap">
                          </div>
                          <!-- botones de accion en los menu -->
                          <div class="col">
                                <a class="btn btn-success" href="editarItemSV.php?uuid_item_sv=<?= $row['uuid_item_sv'];?>">
                                    <i class="fas fa-edit"></i>
                                </a> 

                                <a class="btn btn-danger" href="eliminarItemSV.php?uuid_item_sv=<?= $row['uuid_item_sv'];?>">
                                    <i class="fas fa-trash"></i>
                                </a>

                                <a class="btn btn-info" href="colocarPrecio.php?uuid_item_sv=<?= $row['uuid_item_sv'];?>">
                                  <i class="fas fa-hand-holding-usd"></i>
                                </a>
                            </div>
                        </div>

                          <?php } ?>

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


<div id="modalAgregarItem" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" action="configMenuSV.php" enctype="multipart/form-data">
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <h4 class="modal-title">Agregar Ítem</h4>
        </div>
        <div class="modal-body">
          

            <!-- Nombre del menu -->
            <label>Nombre del Ítem</label>
             <div class="form-group">
              <div class="input-group">
                <input type="text" class="form-control input-lg" name="nombre_item_sv" placeholder="Ingrese el Nombre del Ítem" id="nombre_item_sv" required>
                <input type="hidden" id="uuid_seccion_sv" name="uuid_seccion_sv" value="<?= $uuid_seccion_sv?>">
                <input type="hidden" id="uuid_usuario" name="uuid_usuario" value="<?= $uuid_usuario?>">
              </div>
            </div>
            
            <!-- Contiene contenido? -->   
            <div class="form-group"><label >Contiene descripción?</label>
              <div class="input-group">
                <label class="switch">
                  <input type="checkbox" name="item" id="item"  onchange="javascript:showContent()">
                  <span class="slider round"></span>
                </label>
              </div>
            </div>

            <div id="content" style="display: none;">
              <label>Descripción</label>
              <div class="form-group">
                <div class="input-group">
                  <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                </div>
              </div>
            </div>  

            <label>Imágen del Ítem</label>
             <div class="form-group">
              <div class="input-group">
              <input type="file" class="" name="imagen" id="imagen" required onchange="validarFile(this);">
              </div>
            </div>        
            
            <!-- Contiene contenido? -->   
            <div class="form-group"><label>Ítem lleva precio?</label>
              <div class="input-group">
                <label class="switch">
                  <input type="checkbox" name="itemPrecio" id="itemPrecio" >
                  <span class="slider round"></span>
                </label>
              </div>
            </div>
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>

          <button type="submit" class="btn btn-primary" name="registrarItemSV">Guardar Ítem</button>

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


function showContent() {
        element = document.getElementById("content");
        check = document.getElementById("item");
        descripcion =  document.getElementById("descripcion");
        if (check.checked) {
            element.style.display='block';
            descripcion.setAttribute('required','required');
        }
        else {
          element.style.display='none';
          document.getElementById('descripcion').removeAttribute('required');
        }
    }

</script>


<?php
    }
?>


