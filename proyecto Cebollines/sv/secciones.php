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

   


    <div class="container margenContenedor" > 
        <div class="row">
            <a href="index.php">
                <button type="button" class="btn btn-outline-success" style="color: white; background-color: #f8981d;" >REGRESAR</button>
            </a>
            <?php 
                include '../Administrador/pages/conexion/conexion.php';
                $uuid_menu_sv = $_GET['uuid_menu_sv'];
                $esDomicilio = false;
                $nombre_domicilio = "";
                $resultDomicilios = mysqli_query($mysqli, "SELECT * FROM menusv WHERE uuid_menu_sv = '".$uuid_menu_sv."'");
                while ($rowDomicilio = mysqli_fetch_assoc($resultDomicilios)){
                    $nombre_domicilio = $rowDomicilio['nombre_menu_sv'];
                    echo "<script>console.log('Es domicilio?: " . $nombre_domicilio . "' );</script>";
                }
                
                if ($nombre_domicilio == 'DOMICILIO'){
                    echo "<script>console.log('Entro en domicilio' );</script>";
                    $ruta = "";
                    $result = mysqli_query($mysqli, "SELECT * FROM domiciliossv WHERE uuid_menu = '".$uuid_menu_sv."'");
                    while ($row = mysqli_fetch_assoc($result)): 
                        $ruta = $row['ruta_imagen_sv'];
                        $ruta = substr($ruta, 6);
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

                $result = mysqli_query($mysqli, "SELECT * FROM seccionessv WHERE uuid_menu_sv = '".$uuid_menu_sv."' ORDER BY posicionamiento ASC");
                $ruta = "";
                while ($row = mysqli_fetch_assoc($result)):
                    if ($row['ruta'] != '' || $row['ruta'] != null) {
                        $ruta = $row['ruta'];
                        $ruta = substr($ruta, 6);
                        if ($row['imagen'] == 1 ) {
            ?>
                            <div class="col-sm-4" style="margin-top: 3%;">
                                <div class="card-body">
                                    <a href="items.php?uuid_seccion_sv=<?= $row['uuid_seccion_sv'];?>">
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
                                    <a href="items.php?uuid_seccion_sv=<?= $row['uuid_seccion_sv'];?>" style="text-decoration: none;">
                                        <div class="card-body">
                                            <h5 class="card-title" style="color:white; text-align: center;"><b></b></h5><br>
                                            <h1 class="card-title" style="color:white; text-align: center;"><b><?= $row['nombre_seccion_sv']; ?></b></h1>
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