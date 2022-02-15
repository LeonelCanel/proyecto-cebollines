<?php
    session_start();
    session_status();
    $usuario = $_SESSION['username'];
    $uuid_usuario = substr($usuario, 0, 23);
    if(!isset($usuario)){
        header("location: pages/login/login.php");
    } else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">

    <link rel="icon" type="image/png" href="img/favico.png" />
    <!-- CSS only bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!-- barra lateral iconos -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/main.css">


      <!-- gif de carga (loader) -->
      <link rel="stylesheet" href="css/loader.css">

    <title>Los Cebollines</title>
</head>
<body>

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
            <img class="d-block w-100" src="img/img-Slider/ocaciones especiales.jpg" alt="">
        </div>
        <!-- <div class="carousel-item ">
          <img class="d-block w-100" src="img/img-Slider/banner-2x22-combinaciones.jpg" alt="">
        </div>    --> 
        <div class="carousel-item">
          <img class="d-block w-100" src="img/img-Slider/banner-tacopizza.jpg" alt="">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="img/img-Slider/banner-domicilio-1.jpg" alt="">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="img/img-Slider/banner-eventos-reservacion.jpg" alt="">
        </div>
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
            include 'Administrador/pages/conexion/conexion.php';
            $result = mysqli_query($mysqli, "SELECT * FROM menus");
            while ($row = mysqli_fetch_assoc($result)):
        ?>
            <div class="col-sm-6" style="margin-top: 3%;">
                <div class="card" style="background-color: #f8981d; width: 100%;">
                    <a href="secciones.php?uuid_menu=<?= $row['uuid_menu'];?>" style="text-decoration: none;">
                        <div class="card-body">
                            <h5 class="card-title" style="color:white; text-align: center;"><b></b></h5><br>
                            <h1 class="card-title" style="color:white; text-align: center;"><b><?= $row['nombre_menu'];?></b></h1>
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
        <img src="img/favico.png" alt=""> <br>
        © 2021 Copyright:
      <a href="#" style="color: white;"> Los Cebollines GT</a>
      
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


