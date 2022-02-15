<?php
    include 'visitasSalva.php';
?>
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

    <!-- barra lateral iconos -->
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="css/main.css">


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
                    <a href="index.php">
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


    <!--   <nav class="navbar navbar-light" style="background-color: #327226;">
        <img src="img/logo.png" alt="" class="tamañoImagen">
    </nav> -->
    
    <!--Inicio del slider-->
    <div class="container" style="margin-top:3%;">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
            <?php 
                $uuid_obtenido = '';
                include '../Administrador/pages/conexion/conexion.php';
                $result = mysqli_query($mysqli, "SELECT * FROM carruselsv ORDER BY fecha_creacion ASC LIMIT 1");
                while ($row = mysqli_fetch_assoc($result)):
                    $uuid_obtenido = $row['uuid_carrusel_sv'];
                    $ruta = $row['ruta_carrusel_sv'];
                    $ruta = substr($ruta, 9);
                    echo "<script>console.log('Debug Objects: " . $ruta . "' );</script>";

            ?>
                <!-- Imprimimos la imagen que esta en el primer registro -->
                <img class="d-block w-100" src="../<?= $ruta?>" alt="">
            <?php endwhile ?>
        </div>
        <?php
            include '../Administrador/pages/conexion/conexion.php';
            $result = mysqli_query($mysqli, "SELECT * FROM carruselsv WHERE uuid_carrusel_sv <> '$uuid_obtenido'");
            while ($row = mysqli_fetch_assoc($result)):
                $ruta = $row['ruta_carrusel_sv'];
                $ruta = substr($ruta, 9);
                $nombre = $row['nombre_carrusel_sv'];
                echo "<script>console.log('Debug Objects: " . $ruta . "' );</script>";
        ?>
        <div class="carousel-item">
            <!-- imprimir todas las imagenes exepto la primera que ya se muestra al inicio -->
            <img class="d-block w-100" src="../<?= $ruta?>" alt="">
        </div>
        <?php endwhile ?>
      </div>
      <a class="carousel-control-prev"  href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" style="background-color:#8e0061; width: 50px; height: 50px; border: 3px solid #f8981d;" aria-hidden="true"></span>
        <span class="sr-only"></span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" style="background-color: #8e0061; width: 50px; height: 50px; border: 3px solid #f8981d;" aria-hidden="true"></span>
        <span class="sr-only"></span>
      </a>
    </div>
    </div>
    <!--Fin del Slider-->



<hr>
    <!-- <h1 style="color:#327226; text-align: center;"><u> <b>Nuestras Especialidades</b></u></h1> -->
    <div class="container margenContenedor" > 
        <div class="row">
        <?php 
            include '../Administrador/pages/conexion/conexion.php';
            $result = mysqli_query($mysqli, "SELECT * FROM menusv");
            while ($row = mysqli_fetch_assoc($result)):
        ?>
        
            <div class="col-sm-6" style="margin-top: 3%;">
                <div class="card" style="background-color: #f8981d; width: 100%;">
                    <a href="secciones.php?uuid_menu_sv=<?= $row['uuid_menu_sv'];?>" style="text-decoration: none;">
                        <div class="card-body">
                            <h5 class="card-title" style="color:white; text-align: center;"><b></b></h5><br>
                            <h1 class="card-title" style="color:white; text-align: center;"><b><?= $row['nombre_menu_sv'];?></b></h1>
                            <div class="contenedorTextoImagen">
                                <div class="centradoTextoImagen">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <?php endwhile ?>
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