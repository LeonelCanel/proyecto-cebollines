<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">

    <link rel="icon" type="image/png" href="img/favico.png" />
    <!-- CSS only bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <?php 
        $nombreSeccion_sv = "";
        $uuid_menu_sv = "";
        $uuid_seccion_sv = $_GET['uuid_seccion_sv'];
        include '../Administrador/pages/conexion/conexion.php';
        $result = mysqli_query($mysqli, "SELECT * FROM seccionessv WHERE uuid_seccion_sv = '".$uuid_seccion_sv."'");
        
        while ($row = mysqli_fetch_assoc($result)):
            $nombreSeccion_sv = $row['nombre_seccion_sv']; 
            $uuid_menu_sv = $row['uuid_menu_sv']; 
    ?>
    <title><?= $row['nombre_seccion_sv'];?></title>
    <?php endwhile ?>
    <!-- barra lateral iconos -->
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../css/main.css">


      <!-- gif de carga (loader) -->
      <link rel="stylesheet" href="../css/loader.css">

    <title>Los Cebollines-El Salvador</title>
</head>
<body>

<!-- Este div recibe la imagen de carga, mientras la pagina se carga -->
<div class="loader"></div>


<div class="social-bar">
    <a href="https://www.facebook.com/LosCebollinesElSalvador" class="icon icon-facebook" target="_blank"></a>
    <a href="https://instagram.com/cebollinessv?utm_medium=copy_link" class="icon icon-instagram" target="_blank"></a>
</div>
    
    <nav class="navbar navbar-light" style="background-color: #327226;">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <a href="index.html">
                        <img src="../img/logo.png" alt="" class="logo" style="width: 100%;">
                    </a>
                </div>
                <div class="col-6">
                    <div style="margin-top: 10%;">
                        <!-- <img src="img/redesSociales/facebook.png" alt="" width="2%">
                        <img src="img/redesSociales/instagram.png" alt="" width="3%"> -->
                    </div>
                    
                </div>
                <div class="col-lg-3"><br>

                </div>
            </div>
        </div>
    </nav>


   


<hr>

<div class="container centrarImagenes">
        <h1 class="tituloNachos"><b><?= $nombreSeccion_sv; ?></b></h1>
        <div class="margen">
            <div class="row">
            <?php 
              include '../Administrador/pages/conexion/conexion.php';
              $result = mysqli_query($mysqli, "SELECT * FROM seccionessv WHERE uuid_seccion_sv = '".$uuid_seccion_sv."'");
              while ($row = mysqli_fetch_assoc($result)):
            ?>
              <a href="secciones.php?uuid_menu_sv=<?= $row['uuid_menu_sv'];?>">
                  <button type="button" class="btn btn-outline-success" style="color: white; background-color: #f8981d;" >REGRESAR</button>
              </a>
            <?php endwhile ?>

            <?php 
              $ruta = "";
              $uuid_item = "";
              $uuid_modal = "";
              
              include '../Administrador/pages/conexion/conexion.php';
              $result = mysqli_query($mysqli, "SELECT i.uuid_item_sv, i.nombre_item_sv, i.url_imagen_item_sv, i.descripcion_item_sv, i.uuid_seccion_sv, p.precio_normal_sv, p.precio_doble_sv, p.precio_promocion_sv, p.item_contiene_precio_sv FROM itemssv i INNER JOIN preciossv p ON i.uuid_item_sv = p.uuid_item_sv WHERE i.uuid_seccion_sv = '".$uuid_seccion_sv."'");
              while ($row = mysqli_fetch_assoc($result)):
                $uuid_modal = substr($row['uuid_item_sv'], 0, 14);
                echo "<script>console.log('id para el modal: " . $uuid_modal . "' );</script>";
                $ruta = $row['url_imagen_item_sv'];
                $ruta = substr($ruta, 6);
                echo "<script>console.log('Ruta " . $ruta . "' );</script>";
                $contienePrecio = $row['item_contiene_precio_sv'];
                $uuid_item = $row['uuid_item_sv'];
                if ($contienePrecio == 1){
            ?>


                <div class="col-sm-3" style="margin-top: 3%;">
                    <div class="card">
                    <div class="card-body">
                        <div class="contenedorTextoImagen">
                          <button style="background: transparent; border: none !important; font-size:0;" data-toggle="modal" data-target="#modal<?= $uuid_modal; ?>">
                              <img src="<?= $ruta; ?>" alt="" width="100%;" height="30%">
                          </button>
                          <h5 style="text-align: center; color: #f8981d;"><b><?= $row['nombre_item_sv'];?></b></h5>
                            <?php if ($row['precio_doble_sv'] != 0) { ?>
                                <div class="row" style="">
                                    <div class="col" style="text-align: center; ">
                                        <!-- <b><h3 >$. <?= $row['precio_normal_sv'];?></h3></b> -->
                                        <b><h5 style="text-align: center; color: #327226; ">$. <?= $row['precio_normal_sv'];?></h5></b>
                                        <label>Media Porción</label>
                                        </div>
                                        <div class="col">
                                        <b><h5 style="text-align: center; color: #327226; ">$. <?= $row['precio_doble_sv'];?></h5></b>
                                        <label>Porción completa</label>
                                    </div>
                                </div>
                            <?php } else {  ?>
                                <div class="row" style="text-align: center; ">
                                  <div class="col">
                                    <b><h5 style="text-align: center; color: #327226; ">$. <?= $row['precio_normal_sv'];?></h5></b>
                                  </div>
                                </div>
                            <?php } ?>
                          
                        </div>
                    </div>
                    </div>
                </div>
                <?php include('modal.php');  ?>
                <?php } else {  ?>
                  <div class="col-sm-3" style="margin-top: 3%;">
                    <div class="card">
                      <div class="card-body">
                          <div class="contenedorTextoImagen">
                            <img src="<?= $ruta?>" alt="" width="100%;" height="30%">
                          </div>
                      </div>
                    </div>
                </div>
                    <?php } ?>


            <?php endwhile ?>
            </div>
        </div>    
    </div>
    



     <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<!-- Footer -->
<footer class="colorFotter">
    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">
        <img src="../img/favico.png" alt=""> <br>
        © 2021 Copyright:
      <a href="#" style="color: white;"> Los Cebollines - El Salvador</a>
      
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>



    <!-- Script que oculta el gif y libera el evento loader cuando carga la pagina completa -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script type="text/javascript">
    $(window).load(function() {
        $(".loader").fadeOut("slow");
    });
    </script>