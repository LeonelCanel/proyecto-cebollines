<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="img/favico.png" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style-slider.css">

    <!-- barra lateral iconos -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/main.css">

    <!-- CSS only bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Entradas</title>

     <!-- gif de carga (loader) -->
     <link rel="stylesheet" href="css/loader.css">
</head>
<body style="align-items: center;">

    <!-- Este div recibe la imagen de carga, mientras la pagina se carga -->
<div class="loader"></div>

    
    <div class="social-bar">
        <a href="https://www.facebook.com/CebollinesGT" class="icon icon-facebook" target="_blank"></a>
        <a href="https://www.instagram.com/cebollinesgt/" class="icon icon-instagram" target="_blank"></a>
        <a href="https://api.whatsapp.com/send?phone=+502 44981715" class="icon icon-whatsapp" target="_blank"></a>
    </div>
    
    <nav class="navbar navbar-light" style="background-color: #327226;">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <a href="index.php">
                        <img src="img/logo.png" alt="" class="logo" style="width: 100%;">
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


    <div class="container margenContenedor" > 
        <div class="row">
            <a href="index.php">
                <button type="button" class="btn btn-outline-success" style="color: white; background-color: #f8981d;" >REGRESAR</button>
            </a>



            <?php 
                include 'Administrador/pages/conexion/conexion.php';
                $uuid_menu = $_GET['uuid_menu'];
                $esDomicilio = false;
                $nombre_domicilio = "";
                $resultDomicilios = mysqli_query($mysqli, "SELECT * FROM menus WHERE uuid_menu = '".$uuid_menu."'");
                while ($rowDomicilio = mysqli_fetch_assoc($resultDomicilios)){
                    $nombre_domicilio = $rowDomicilio['nombre_menu'];
                    echo "<script>console.log('Es domicilio?: " . $nombre_domicilio . "' );</script>";
                }
                
                if ($nombre_domicilio == 'DOMICILIO'){
                    echo "<script>console.log('Entro en domicilio' );</script>";
                    $ruta = "";
                    $result = mysqli_query($mysqli, "SELECT * FROM domicilios WHERE uuid_menu = '".$uuid_menu."'");
                    while ($row = mysqli_fetch_assoc($result)): 
                        $ruta = $row['ruta_imagen'];
                        $ruta = substr($ruta, 9);
                    ?>
                    <div class="col-sm-4" style="margin-top: 3%;">
                        <div class="card-body">
                            <a href="<?= $row['enlace_domicilio'];?>">
                                <img src="<?= $ruta ?>" alt="" style="width: 100%; height: 30%;">
                            </a>
                            <div class="contenedorTextoImagen">
                                <div class="centradoTextoImagen">
                                </div>
                            </div>
                        </div>
                    </div>
                        
                    <?php endwhile; 
                } 

                $result = mysqli_query($mysqli, "SELECT * FROM secciones WHERE uuid_menu = '".$uuid_menu."' ORDER BY posicionamiento ASC");
                $ruta = "";
                while ($row = mysqli_fetch_assoc($result)):
                    if ($row['ruta'] != '' || $row['ruta'] != null) {
                        $ruta = $row['ruta'];
                        $ruta = substr($ruta, 9);
                        if ($row['imagen'] == 1 ) {
            ?>
                            <div class="col-sm-4" style="margin-top: 3%;">
                                <div class="card-body">
                                    <a href="items.php?uuid_seccion=<?= $row['uuid_seccion'];?>">
                                        <img src="<?= $ruta ?>" alt="" style="width: 100%; height: 30%;">
                                    </a>
                                    <div class="contenedorTextoImagen">
                                        <div class="centradoTextoImagen">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="col-sm-4" style="margin-top: 3%;">
                                <div class="card-body">
                                    <img src="<?= $ruta ?>" alt="" style="width: 100%; height: 30%;">
                                    <div class="contenedorTextoImagen">
                                        <div class="centradoTextoImagen">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                <?php  } else { ?>
                            <div class="col-sm-4" style="margin-top: 3%;">
                                <div class="card" style="background-color: #f8981d; width: 100%;">
                                    <a href="items.php?uuid_seccion=<?= $row['uuid_seccion'];?>" style="text-decoration: none;">
                                        <div class="card-body">
                                            <h5 class="card-title" style="color:white; text-align: center;"><b></b></h5><br>
                                            <h1 class="card-title" style="color:white; text-align: center;"><b><?= $row['nombre_seccion']; ?></b></h1>
                                            <div class="contenedorTextoImagen">
                                                <div class="centradoTextoImagen">
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php } ?>
            <?php endwhile ?>
        </div>
    </div>


    

    <div style="margin-top: 10%;margin-top: 20%;">
        <!-- Footer -->
        <footer class="colorFotter">
            <!-- Copyright -->
            <div class="footer-copyright text-center py-3">
                <img src="img/favico.png" alt=""> <br>
                © 2021 Copyright:
            <a href="#" style="color: white;"> Los Cebollines GT</a>
            
            </div>
            <!-- Copyright -->
        </footer>
        <!-- Footer -->
    </div>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>


  <!-- Script que oculta el gif y libera el evento loader cuando carga la pagina completa -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script type="text/javascript">
  $(window).load(function() {
      $(".loader").fadeOut("slow");
  });
  </script>