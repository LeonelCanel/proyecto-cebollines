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
            <h1>Secciones del Menú de <?= $row['nombre_menu'];?></h1><br>
            <a class="btn btn-success" href="menus.php">
            <i class="far fa-arrow-alt-circle-left"></i>
              Regresar al Menú
            </a>
            <?php 
              if($row['nombre_menu'] == 'DOMICILIO' || $row['uuid_menu'] == '61d0c41eaed012.67212495'){
            ?>
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarDomicilio">
            <i class="fas fa-plus"></i>
            Agregar Domicilio
            </button>
            <?php  } else { ?>
              <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarSeccion">
                <i class="fas fa-plus"></i>
                Agregar Secciones
              </button>

              <a class="btn btn-info" href="posicionamiento.php?uuid_menu=<?= $uuid_menu;?>">
            <i class="fas fa-crosshairs"></i>
              Ordenamiento
            </a>
            <?php } ?>


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
                              include '../conexion/conexion.php';
                              $result = mysqli_query($mysqli, "SELECT * FROM secciones WHERE uuid_menu = '".$uuid_menu."' ORDER BY posicionamiento ASC");
                              while ($row = mysqli_fetch_assoc($result)):
                         
                            
                        ?>
                        <?php if ($row['items'] == 0) { ?>
                          <!-- cuando la seccion tiene imagen -->
                          <div class="col-sm-4">
                            <div class="card" style="width: 12rem;">
                              <h3 style="text-align: center;"><b><?= $row['nombre_seccion'];?></b></h3>
                                <img class="card-img-top" src="<?= $row['ruta'];?>" alt="Card image cap">
                            </div>
                            <!-- botones de accion en los menu -->
                            <div class="col">
                                  <a class="btn btn-success" href="editarSeccion.php?uuid_seccion=<?= $row['uuid_seccion'];?>">
                                      <i class="fas fa-edit"></i>
                                  </a> 

                                  <a class="btn btn-danger" href="eliminarSeccion.php?uuid_seccion=<?= $row['uuid_seccion'];?>">
                                      <i class="fas fa-trash"></i>
                                  </a>
                              </div>
                          </div>
                        <?php } else { ?> 

                          <?php if ($row['nombre_seccion'] == 'PROMOCIONES CLUB BI') { ?> 
                              <!-- cuando la seccion tiene imagen -->
                              <div class="col-sm-4">
                                <div class="card" style="width: 12rem;">
                                  <h3 style="text-align: center;"><b><?= $row['nombre_seccion'];?></b></h3>
                                    <a href="agregarItems.php?uuid_seccion=<?= $row['uuid_seccion'];?>" style="color: white;">
                                      <img class="card-img-top" src="<?= $row['ruta'];?>" alt="Card image cap">
                                    </a> 
                                </div>
                                <!-- botones de accion en los menu -->
                                <div class="col">
                                      <a class="btn btn-success" href="editarSeccion.php?uuid_seccion=<?= $row['uuid_seccion'];?>">
                                          <i class="fas fa-edit"></i>
                                      </a> 

                                      <a class="btn btn-danger" href="eliminarSeccion.php?uuid_seccion=<?= $row['uuid_seccion'];?>">
                                          <i class="fas fa-trash"></i>
                                      </a>
                                  </div>
                              </div>
                          <?php } else { ?>

                              <!-- Cuando la seccion no tiene imagen -->
                              <div class="col-sm-4" style="margin-top: 3%;">
                                <div class="card" style="background-color: #f8981d; width: 100%;">
                                  <a href="agregarItems.php?uuid_seccion=<?= $row['uuid_seccion'];?>" style="color: white;">
                                      <div class="card-body">
                                          <h5 class="card-title" style="color:white; text-align: center;"><b></b></h5><br>
                                          <h3 style="text-align: center;"><b><?= $row['nombre_seccion'];?></b></h3>
                                      </div>
                                  </a>
                                </div>
                                <!-- botones de accion en los menu -->
                                <div class="col">
                                  <a class="btn btn-success" href="editarSeccion.php?uuid_seccion=<?= $row['uuid_seccion'];?>">
                                      <i class="fas fa-edit"></i>
                                  </a> 

                                  <a class="btn btn-danger" href="eliminarSeccion.php?uuid_seccion=<?= $row['uuid_seccion'];?>">
                                      <i class="fas fa-trash"></i>
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

<!-- Modal de secciones normales -->
<div id="modalAgregarSeccion" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" action="configMenu.php" enctype="multipart/form-data">
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <h4 class="modal-title">Agregar Sección</h4>
        </div>
        <div class="modal-body">
          

            <!-- Nombre-->
            <label>Nombre de la Sección</label>
             <div class="form-group">
              <div class="input-group">
                <input type="text" class="form-control input-lg" name="nombre_seccion" placeholder="Ingrese el Nombre de la Sección" id="nombre_seccion" required>
                <input type="hidden" id="uuid_menu" name="uuid_menu" value="<?= $uuid_menu?>">
                <input type="hidden" id="uuid_usuario" name="uuid_usuario" value="<?= $uuid_usuario?>">
              </div>
            </div>  

            <!-- Contiene contenido? -->   
            <div class="form-group"><label >Esta sección contiene Ítems?</label>
              <div class="input-group">
                <label class="switch">
                  <input type="checkbox" name="item" id="item" checked onchange="javascript:showContent()">
                  <span class="slider round"></span>
                </label>
              </div>
            </div>

            <div id="content" style="display: none;">
              <!-- Ingredientes del Menu -->
              <label>Imagen</label>
              <div class="form-group">
                <div class="input-group">
                <input type="file" class="" name="imagen" id="imagen" onchange="validarFile(this);">
                </div>
              </div> 
            </div>  



            <div id="contentCheck" style="display: block;">
              <!-- Desea agregar imagen a esta seccion? -->
              <div class="form-group"><label >Desea agregar imagen a esta sección?</label>
                <div class="input-group">
                  <label class="switch">
                    <input type="checkbox" name="item2" id="item2" onchange="javascript:showContent2()">
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
            </div>

            <div id="content2" style="display: none;">
              <!-- Ingredientes del Menu -->
              <label>Imagen</label>
              <div class="form-group">
                <div class="input-group">
                <input type="file" class="" name="imagen2" id="imagen2" onchange="validarFile(this);">
                </div>
              </div> 
            </div>  

            

        </div>
        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>

          <button type="submit" class="btn btn-primary" name="registrarSeccion">Guardar Sección</button>

        </div>
      </form>

    </div>

  </div>

</div>


<!-- modal de domicilios -->
<div id="modalAgregarDomicilio" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" action="configMenu.php" enctype="multipart/form-data">
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <h4 class="modal-title">Agregar domicilio</h4>
        </div>
        <div class="modal-body">
            <!-- Nombre-->
            <label>Nombre de la Sección</label>
             <div class="form-group">
              <div class="input-group">
                <input type="text" class="form-control input-lg" name="nombre_domicilio" placeholder="Ejem: Domicilio WhatsApp" id="nombre_domicilio" required>
                <input type="hidden" id="uuid_menu" name="uuid_menu" value="<?= $uuid_menu?>">
                <input type="hidden" id="uuid_usuario" name="uuid_usuario" value="<?= $uuid_usuario?>">
              </div>
            </div>  

            <!-- Es cebollines Domicilio -->               
            <div class="form-group"><label >Es Cebollines Domicilio?</label>
              <div class="input-group">
                <label class="switch">
                  <input type="checkbox" name="itemLLamada" id="itemLLamada" onchange="javascript:showContentLlamada()">
                  <span class="slider round"></span>
                </label>
              </div>
            </div>


            <div id="contentLlamada" style="display: none;">
              <div class="container">
                <div class="row">
                  <div class="col-sm">
                      <!-- 1715 -->
                    <label>Cebollines Domicilio</label>
                    <div class="form-group">
                      <div class="input-group">
                        <input type="text" class="form-control input-lg" name="numero_llamada" placeholder="Ejem: 1715" id="numero_llamada">
                      </div>
                    </div>  
                  </div>
                  <div class="col-sm">
                    <img src="../../dist/img/cebollinesDomicilio.png" width ="50%">
                  </div>
                </div>
              </div>
            </div><!-- Es cebollines Domicilio -->  


            <!-- Es Domicilio messenger -->               
            <div class="form-group"><label >Es Cebollines Messenger?</label>
              <div class="input-group">
                <label class="switch">
                  <input type="checkbox" name="itemMessenger" id="itemMessenger" onchange="javascript:showContentMessenger()">
                  <span class="slider round"></span>
                </label>
              </div>
            </div>


            <div id="contentMessenger" style="display: none;">
              <div class="container">
                <div class="row">
                  <div class="col-sm">
                      <!-- Messenger -->
                    <label>Messenger Cebollines</label>
                    <div class="form-group">
                      <div class="input-group">
                        <input type="text" class="form-control input-lg" name="messenger" placeholder="Ingrese enlace de Messenger" id="messenger">
                      </div>
                    </div>  
                  </div>
                  <div class="col-sm">
                    <img src="../../dist/img/cebollinesMessenger.png" width ="50%">
                  </div>
                </div>
              </div>
            </div><!-- Es Domicilio messenger --> 



            <!-- Es Domicilio Whatsapp -->               
            <div class="form-group"><label >Es Cebollines WhatsApp?</label>
              <div class="input-group">
                <label class="switch">
                  <input type="checkbox" name="itemWhatsapp" id="itemWhatsapp" onchange="javascript:showContentWhatsapp()">
                  <span class="slider round"></span>
                </label>
              </div>
            </div>


            <div id="contentWhatsapp" style="display: none;">
              <div class="container">
                <div class="row">
                  <div class="col-sm">
                      <!-- Whatsapp -->
                    <label>Whatsapp Cebollines</label>
                    <div class="form-group">
                      <div class="input-group">
                        <input type="number" class="form-control input-lg" name="whatsapp" placeholder="Ejem: 44981715" id="whatsapp">
                      </div>
                    </div>  
                  </div>
                  <div class="col-sm">
                    <img src="../../dist/img/cebollinesWhatsapp.png" width ="50%">
                  </div>
                </div>
              </div>
            </div> <!-- Whatsapp -->
            
            
            <!-- Es Domicilio Telegram -->               
            <div class="form-group"><label >Es Cebollines Telegram?</label>
              <div class="input-group">
                <label class="switch">
                  <input type="checkbox" name="itemTelegram" id="itemTelegram" onchange="javascript:showContentTelegram()">
                  <span class="slider round"></span>
                </label>
              </div>
            </div>


            <div id="contentTelegram" style="display: none;">
              <div class="container">
                <div class="row">
                  <div class="col-sm">
                      <!-- Telegram -->
                    <label>Telegram Cebollines</label>
                    <div class="form-group">
                      <div class="input-group">
                        <input type="text" class="form-control input-lg" name="Telegram" placeholder="Ejem: LosCebollinesGuatemala" id="Telegram">
                      </div>
                    </div>  
                  </div>
                  <div class="col-sm">
                    <img src="../../dist/img/cebollinesTelegram.png" width ="50%">
                  </div>
                </div>
              </div>
            </div> <!-- Telegram -->

             <!-- Es Domicilio Web -->               
             <div class="form-group"><label >Es Cebollines Web?</label>
              <div class="input-group">
                <label class="switch">
                  <input type="checkbox" name="itemWeb" id="itemWeb" onchange="javascript:showContentWeb()">
                  <span class="slider round"></span>
                </label>
              </div>
            </div>


            <div id="contentWeb" style="display: none;">
              <div class="container">
                <div class="row">
                  <div class="col-sm">
                      <!-- Web -->
                    <label>Web Cebollines</label>
                    <div class="form-group">
                      <div class="input-group">
                        <input type="text" class="form-control input-lg" name="Web" placeholder="Ejem: cebollines.com" id="Web">
                      </div>
                    </div>  
                  </div>
                  <div class="col-sm">
                    <img src="../../dist/img/cebollinesWeb.png" width ="50%">
                  </div>
                </div>
              </div>
            </div> <!-- Telegram -->


            <!-- Agregar imagen -->               
            <div class="form-group"><label >Agregar imagen</label>
              <div class="input-group">
                <input type="file" name="imagen" id="imagen" required onchange="validarFile(this);">
              </div>
            </div>
            

        </div>
        <!--=====================================
        PIE DEL MODAL
        ======================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary" name="crearDomicilios">Guardar Sección</button>
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
        imagen =  document.getElementById("imagen");

        element2 = document.getElementById("content2");
        check2 = document.getElementById("item2");
        imagen2 =  document.getElementById("imagen2");

        elementCheck = document.getElementById("contentCheck");

        if (check.checked) {
            element.style.display='none';
            document.getElementById('imagen').removeAttribute('required');
            elementCheck.style.display='block';

             check2.checked = false; 
        }
        else {
            element.style.display='block';
            imagen.setAttribute('required','required');
            elementCheck.style.display='none';
            element2.style.display="none";
        }
    }


    function showContent2() {
        element2 = document.getElementById("content2");
        check2 = document.getElementById("item2");
        imagen2 =  document.getElementById("imagen2");

        if (check2.checked) {
            element2.style.display='block';
            imagen2.setAttribute('required','required');
        }
        else {
            element2.style.display='none';
            document.getElementById('imagen2').removeAttribute('required');
        }
    }


    /* DomicilioLlamada */
    function showContentLlamada() {
        /* Llamada */
        element = document.getElementById("contentLlamada");
        check = document.getElementById("itemLLamada");
        domicilio1715 =  document.getElementById("numero_llamada");
        /* Llamada */

        /* Messenger */
          messengerCheck =  document.getElementById("itemMessenger");
          elementMessenger = document.getElementById("contentMessenger");
          messenger = document.getElementById("messenger");
        /* Messenger */

        /* Whatsapp */
        contentWhatsapp = document.getElementById("contentWhatsapp");
        checkWhatsapp = document.getElementById("itemWhatsapp");
        whatsapp = document.getElementById("whatsapp");
        /* Whatsapp */

        /* Telegram */
        elementTelegram = document.getElementById("contentTelegram");
        checkTelegram = document.getElementById("itemTelegram");
        Telegram = document.getElementById("Telegram");
        /* Telegram */

        /* Web */
        elementWeb = document.getElementById("contentWeb");
        checkWeb = document.getElementById("itemWeb");
        Web = document.getElementById("Web");
        /* Web */

        if (check.checked) {
            element.style.display='block';
            domicilio1715.setAttribute('required','required');
            
            /* Bloquea los demas checks */
            messengerCheck.checked = false;         /* cebollines Messenger */
            elementMessenger.style.display='none';  /* cebollines Messenger */

            checkWhatsapp.checked = false;          /* cebollines Whatsapp */
            contentWhatsapp.style.display='none';    /* cebollines Whatsapp */

            checkTelegram.checked = false;          /* Cebollines telegram */
            elementTelegram.style.display='none';   /* Cebollines telegram */


            checkWeb.checked = false;          /* Cebollines Web */
            elementWeb.style.display='none';   /* Cebollines Web */


            /* Limpia los inputs que estan ocultos */
            messenger.value = "";
            whatsapp.value = "";
            Telegram.value="";
            Web.value="";
        }
        else {
            element.style.display='none';
            document.getElementById('numero_llamada').removeAttribute('required');
        }
    }
    /* DomicilioLlamada */



    /* Domicilio Messenger */
    function showContentMessenger() {
        /* Messenger */
        element = document.getElementById("contentMessenger");
        check = document.getElementById("itemMessenger");
        messenger = document.getElementById("messenger");
        /* Messenger */

        /* Llamada */
        domicilio1715 = document.getElementById("itemLLamada");
        element1715 = document.getElementById("contentLlamada");
        llamada = document.getElementById("numero_llamada");
        /* Llamada */

        /* Whatsapp */
        elementwhatsapp = document.getElementById("contentWhatsapp");
        checkWhatsapp = document.getElementById("itemWhatsapp");
        whatsapp = document.getElementById("whatsapp");
        /* Whatsapp */

        /* Telegram */
        elementTelegram = document.getElementById("contentTelegram");
        checkTelegram = document.getElementById("itemTelegram");
        Telegram = document.getElementById("Telegram");
        /* Telegram */

        /* Web */
        elementWeb = document.getElementById("contentWeb");
        checkWeb = document.getElementById("itemWeb");
        Web = document.getElementById("Web");
        /* Web */
        
        if (check.checked) {
            element.style.display='block';
            messenger.setAttribute('required','required');

             /* Bloquea los demas checks */
            domicilio1715.checked = false;        /* Cebollines Domicilio 1715 */
            element1715.style.display='none';     /* Cebollines Domicilio 1715 */

            checkWhatsapp.checked = false;          /* cebollines Whatsapp */
            contentWhatsapp.style.display='none';    /* cebollines Whatsapp */

            checkTelegram.checked = false;          /* Cebollines telegram */
            elementTelegram.style.display='none';   /* Cebollines telegram */

            checkWeb.checked = false;          /* Cebollines Web */
            elementWeb.style.display='none';   /* Cebollines Web */


            /* Limpia los inputs que estan ocultos */
            llamada.value = "";
            whatsapp.value = "";
            Telegram.value = "";
            Web.value="";
        }
        else {
            element.style.display='none';
            document.getElementById('messenger').removeAttribute('required');
        }
    }/* Domicilio Messenger */



    /* Domicilio Whatsapp */
    function showContentWhatsapp() {
        /* Whatsapp */
        elementWhatsapp = document.getElementById("contentWhatsapp");
        checkWhatsapp = document.getElementById("itemWhatsapp");
        whatsapp = document.getElementById("whatsapp");
        /* Whatsapp */

        /* Llamada */
        domicilio1715 = document.getElementById("itemLLamada");
        element1715 = document.getElementById("contentLlamada");
        llamada = document.getElementById("numero_llamada");
        /* Llamada */

        /* Messenger */
        messengerCheck =  document.getElementById("itemMessenger");
        elementMessenger = document.getElementById("contentMessenger");
        messenger = document.getElementById("messenger");
        /* Messenger */

        /* Telegram */
        elementTelegram = document.getElementById("contentTelegram");
        checkTelegram = document.getElementById("itemTelegram");
        Telegram = document.getElementById("Telegram");
        /* Telegram */
        
        
         /* Web */
        elementWeb = document.getElementById("contentWeb");
        checkWeb = document.getElementById("itemWeb");
        Web = document.getElementById("Web");
        /* Web */
        
        if (checkWhatsapp.checked) {
            elementWhatsapp.style.display='block';
            whatsapp.setAttribute('required','required');

             /* Bloquea los demas checks */
            domicilio1715.checked = false;   /* Cebollines Domicilio 1715  */
            element1715.style.display='none';/* Cebollines Domicilio 1715  */

            messengerCheck.checked = false;       /* cebollines Messenger */
            elementMessenger.style.display='none';/* cebollines Messenger */

            checkTelegram.checked = false;          /* Cebollines telegram */
            elementTelegram.style.display='none';   /* Cebollines telegram */

            checkWeb.checked = false;          /* Cebollines Web */
            elementWeb.style.display='none';   /* Cebollines Web */


            /* Limpia los inputs que estan ocultos */
            llamada.value = "";
            messenger.value = "";
            Telegram.value = "";
            Web.value="";
        }
        else {
            elementWhatsapp.style.display='none';
            document.getElementById('whatsapp').removeAttribute('required');
        }
    }/* Domicilio Whatsapp */



        /* Domicilio Telegram */
    function showContentTelegram() {
        /* Telegram */
        elementTelegram = document.getElementById("contentTelegram");
        checkTelegram = document.getElementById("itemTelegram");
        Telegram = document.getElementById("Telegram");
        /* Telegram */

        /* Llamada */
        domicilio1715 = document.getElementById("itemLLamada");
        element1715 = document.getElementById("contentLlamada");
        llamada = document.getElementById("numero_llamada");
        /* Llamada */

        /* Messenger */
        messengerCheck =  document.getElementById("itemMessenger");
        elementMessenger = document.getElementById("contentMessenger");
        messenger = document.getElementById("messenger");
        /* Messenger */

        /* Whatsapp */
        elementWhatsapp = document.getElementById("contentWhatsapp");
        checkWhatsapp = document.getElementById("itemWhatsapp");
        whatsapp = document.getElementById("whatsapp");
        /* Whatsapp */

         /* Web */
        elementWeb = document.getElementById("contentWeb");
        checkWeb = document.getElementById("itemWeb");
        Web = document.getElementById("Web");
        /* Web */
        
        if (checkTelegram.checked) {
            elementTelegram.style.display='block';
            Telegram.setAttribute('required','required');

             /* Bloquea los demas checks */
            domicilio1715.checked = false;   /* Cebollines Domicilio 1715  */
            element1715.style.display='none';/* Cebollines Domicilio 1715  */

            messengerCheck.checked = false;       /* cebollines Messenger */
            elementMessenger.style.display='none';/* cebollines Messenger */

            checkWhatsapp.checked = false;       /* cebollines Whatsapp */
            elementWhatsapp.style.display='none';/* cebollines Whatsapp */

            checkWeb.checked = false;          /* Cebollines Web */
            elementWeb.style.display='none';   /* Cebollines Web */

            /* Limpia los inputs que estan ocultos */
            llamada.value = "";
            messenger.value = "";
            whatsapp.value="";
            whatsapp.value="";

        }
        else {
            elementTelegram.style.display='none';
            document.getElementById('Telegram').removeAttribute('required');
        }
    }/* Domicilio Telegram */
    

         /* Domicilio web */
    function showContentWeb() {
        /* Web */
        elementWeb = document.getElementById("contentWeb");
        checkWeb = document.getElementById("itemWeb");
        Web = document.getElementById("Web");
        /* Web */

        /* Llamada */
        domicilio1715 = document.getElementById("itemLLamada");
        element1715 = document.getElementById("contentLlamada");
        llamada = document.getElementById("numero_llamada");
        /* Llamada */

        /* Messenger */
        messengerCheck =  document.getElementById("itemMessenger");
        elementMessenger = document.getElementById("contentMessenger");
        messenger = document.getElementById("messenger");
        /* Messenger */

        /* Whatsapp */
        elementWhatsapp = document.getElementById("contentWhatsapp");
        checkWhatsapp = document.getElementById("itemWhatsapp");
        whatsapp = document.getElementById("whatsapp");
        /* Whatsapp */
        

        /* Telegram */
        elementTelegram = document.getElementById("contentTelegram");
        checkTelegram = document.getElementById("itemTelegram");
        Telegram = document.getElementById("Telegram");
        /* Telegram */   


        if (checkWeb.checked) {
            elementWeb.style.display='block';
            Web.setAttribute('required','required');

             /* Bloquea los demas checks */
            domicilio1715.checked = false;   /* Cebollines Domicilio 1715  */
            element1715.style.display='none';/* Cebollines Domicilio 1715  */

            messengerCheck.checked = false;       /* cebollines Messenger */
            elementMessenger.style.display='none';/* cebollines Messenger */

            checkWhatsapp.checked = false;       /* cebollines Whatsapp */
            elementWhatsapp.style.display='none';/* cebollines Whatsapp */

            checkTelegram.checked = false;          /* Cebollines telegram */
            elementTelegram.style.display='none';   /* Cebollines telegram */

            /* Limpia los inputs que estan ocultos */
            llamada.value = "";
            messenger.value = "";
            whatsapp.value="";
            Telegram.value="";
        }
        else {
            elementWeb.style.display='none';
            document.getElementById('Web').removeAttribute('required');
        }
    }/* Domicilio Web */
    
</script>

<?php
    }
?>