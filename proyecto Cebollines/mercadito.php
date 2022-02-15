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
    <title>Mercadito</title>
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
            <h1 style="text-align: center; font-family:Verdana;">Mercadito - Los Cebollines</h1> 
            <hr>
        </div>
        <div class="row">
        <?php 
            include 'Administrador/pages/conexion/conexion.php';
            $result = mysqli_query($mysqli, "SELECT * FROM `seccion_mercadito`;");
            while ($row = mysqli_fetch_assoc($result)):
        ?>
            <div class="col-sm-4" style="margin-top: 3%;">
                <div class="card" style="background-color: #f8981d; width: 100%;">
                    <a href="recetas.php?uuid_seccion=<?= $row['uuid_seccion'];?>" style="text-decoration: none;">
                        <div class="card-body">
                            <h5 class="card-title" style="color:white; text-align: center;"><b></b></h5><br>
                            <h1 class="card-title" style="color:white; text-align: center;"><b><?= $row['nombre_seccion'];?></b></h1>
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