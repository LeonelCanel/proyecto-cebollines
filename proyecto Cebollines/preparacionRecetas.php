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
    
    <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <?php 
        $titulo_receta = "";
        $uuid_item = $_GET['uuid_item'];
        include 'Administrador/pages/conexion/conexion.php';
        $result = mysqli_query($mysqli, "SELECT * FROM `items_mercadito` WHERE uuid_item = '".$uuid_item."'");
        while ($row = mysqli_fetch_assoc($result)):
            $titulo_receta = $row['titulo_receta'];  
            $uuid_seccion = $row['uuid_seccion'];  
            $ingredientes = $row['ingredientes'];
            $preparacion = $row['preparacion'];    
            $ruta = $row['ruta_imagen']; 
            $ruta = substr($ruta, 9);   
            $cantidad_personas = $row['cantidad_personas']; 
            $tiempo_preparacion = $row['tiempo_preparacion']; 
            $dificultad = $row['dificultad']; 
    ?>
    <title><?= $titulo_receta;?></title>
    <?php endwhile ?>
         <!-- gif de carga (loader) -->
         <link rel="stylesheet" href="css/loader.css">
</head>
<body style="background-color: #C7F3C3;" >

    <!-- Este div recibe la imagen de carga, mientras la pagina se carga -->
    <div class="loader"></div>
    
   <!--  <div class="social-bar">
        <a href="https://www.facebook.com/CebollinesGT" class="icon icon-facebook" target="_blank"></a>
        <a href="https://www.instagram.com/cebollinesgt/" class="icon icon-instagram" target="_blank"></a>
        <a href="https://api.whatsapp.com/send?phone=+502 44981715" class="icon icon-whatsapp" target="_blank"></a>
    </div> -->
    
    
    
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

    <div class="container" style="margin-top: 5%;">
        <div class="row">
            <h2 style="text-align: center; font-family:Ginebra;"><?= $titulo_receta;?>  </h2>
            <a href="recetas.php?uuid_seccion=<?= $uuid_seccion?>" style="margin-top:3%;">
                <button type="button" class="btn btn-outline-success" style="color: white; background-color: #f8981d;" >REGRESAR</button>
            </a>
        </div>

        <br><br>
        <div class="row">
            <div class="col-sm-6" style="margin-top: 3%;">
                <img src="<?= $ruta; ?>" alt="" width="100%;">
            </div>
            <div class="col-sm-6" style="margin-top: 15%;">
                <div class="row">
                    <div class="col col-center">
                        <i class="fa-solid fa-users fa-3x" style="color: #dd6726"></i>
                        <br>
                        <br>
                        <b><?= $cantidad_personas; ?> Personas</b>
                    </div>
                    <div class="col col-center">
                        <i class="fa-solid fa-clock fa-3x" style="color: #dd6726"></i>
                        <br>
                        <br>
                        <b><?= $tiempo_preparacion; ?> Minutos</b>
                    </div>
                    <div class="col col-center">
                        <i class="fa-solid fa-utensils fa-3x" style="color: #dd6726"></i>
                        <br>
                        <br>
                        <b><?= $dificultad; ?></b> 
                    </div>
                </div>
            </div>
        </div>
        <br><br>
        <div class="row">
            <ul class="nav nav-tabs" id="myTab" role="tablist" style="margin-top:5%;">
                <li class="nav-item">
                    <a class="nav-link active" id="ingredientes-tab" data-toggle="tab" href="#ingredientes" role="tab" aria-controls="ingredientes" aria-selected="true">Ingredientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="preparacion-tab" data-toggle="tab" href="#preparacion" role="tab" aria-controls="preparacion" aria-selected="false">Preparación</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent" style="margin-top: 5%;">
                <div class="tab-pane fade show active" id="ingredientes" role="tabpanel" aria-labelledby="ingredientes-tab">
                    <h3>Ingredientes</h3>
                    <p><?= $ingredientes?></p>
                </div>
                <div class="tab-pane fade" id="preparacion" role="tabpanel" aria-labelledby="preparacion-tab">
                    <h3>Preparación</h3>
                    <p><?= $preparacion?></p>
                </div>
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