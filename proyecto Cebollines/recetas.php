<!DOCTYPE html>
<html lang="en">
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
    <?php 
        $nombreSeccion = "";
        $uuid_seccion = $_GET['uuid_seccion'];
        echo "<script>console.log('Console: " . $uuid_seccion . "' );</script>";
        include 'Administrador/pages/conexion/conexion.php';
        $result = mysqli_query($mysqli, "SELECT * FROM `seccion_mercadito` WHERE uuid_seccion = '".$uuid_seccion."'");
        while ($row = mysqli_fetch_assoc($result)):
            $nombreSeccion = $row['nombre_seccion']; 
            echo "<script>console.log('Console: " . $nombreSeccion . "' );</script>";
    ?>
    <title><?= $nombreSeccion;?></title>
    <?php endwhile ?>
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

    <div class="container centrarImagenes">
        <div class="margen">
            <div class="row">
                <h2 style="text-align: center;">RECETAS DE <?= $nombreSeccion;?>  </h2>
                <a href="mercadito.php" style="margin-top:3%;">
                    <button type="button" class="btn btn-outline-success" style="color: white; background-color: #f8981d;" >REGRESAR</button>
                </a>
            <?php 
              $ruta = "";
              $uuid_item = "";
              $uuid_modal = "";
              $nombre_item = "";
              
              include 'Administrador/pages/conexion/conexion.php';
              $result = mysqli_query($mysqli, "SELECT * FROM items_mercadito  WHERE uuid_seccion = '".$uuid_seccion."'");
              while ($row = mysqli_fetch_assoc($result)):
                $ruta = $row['ruta_imagen'];
                $ruta = substr($ruta, 9);
                $uuid_item = $row['uuid_item'];
                $titulo_receta = $row['titulo_receta'];
            ?>

                <div class="col-sm-3" style="margin-top: 3%;">
                    <div class="card">
                    <div class="card-body">
                        <div class="contenedorTextoImagen">
                            <a href="preparacionRecetas.php?uuid_item=<?= $row['uuid_item'];?>" role="button">
                                <img src="<?= $ruta; ?>" alt="" width="100%;" height="30%">
                            </a>
                          <h5 style="text-align: center; margin-top:3%; font-family:Ginebra;"><b><?= $row['titulo_receta'];?></b></h5>
                        </div>
                    </div>
                    </div>
                </div>


            <?php endwhile ?>
            </div>
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
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  
  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  
  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</html>


  <!-- Script que oculta el gif y libera el evento loader cuando carga la pagina completa -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script type="text/javascript">
  $(window).load(function() {
      $(".loader").fadeOut("slow");
  });
  </script>