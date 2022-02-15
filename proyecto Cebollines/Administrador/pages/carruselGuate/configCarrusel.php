<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Script que funcionan para la colocacion de mensajes de alerta -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    
    <title></title>
</head>
<body>
<?php 
    include '../conexion/conn.php';
    /* Registra items de carrusel */
    if (isset($_POST['registrarCarrusel'])) {
        $nombre = $_POST['nombre'];
        $uuid_usuario = $_POST['uuid_usuario'];
        $uuid_carrusel = uniqid('', true);
        $nombre = strtoupper($nombre);
        $archivo = $_FILES['imagen']['name'];
        //Recogemos el archivo enviado por el formulario
        $ruta = '../../../Cliente/imagenes/'.$archivo; 
        $path = "../../../Cliente/imagenes/"; //directorio donde se va colocar la imagen
        
    
        if (isset($archivo) && $archivo != "") {
            //Obtenemos algunos datos necesarios sobre el archivo
            $tipo = $_FILES['imagen']['type'];
            $tamano = $_FILES['imagen']['size'];
            $temp = $_FILES['imagen']['tmp_name'];
            echo "<script>console.log( 'Si tiene archivo' );</script>";
            echo "<script>console.log( 'tipo: " . $tipo . "' );</script>";
            echo "<script>console.log( 'tamaño: " . $tamano . "' );</script>";
            echo "<script>console.log( 'Id en: " . $temp . "' );</script>";
            //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
            if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 400000000 ))) {
                include 'mensajes/mensajeError.php';
            } else {
                //Si la imagen es correcta en tamaño y tipo
                echo "<script>console.log( 'La imagen si es correcta' );</script>";
                if (!is_dir($path)) { //Si el directorio no existe crea uno con lo maximo en permisos
                    mkdir($path, 0777, true);
                    echo "<script>console.log( 'Crea la carpeta' );</script>";
                }
                //Se intenta subir al servidor
                $temp = $_FILES['imagen']['tmp_name'];
                move_uploaded_file($temp,$ruta); 
                echo "<script>console.log( 'Llega aca con todo bueno' );</script>";
                $sql = "INSERT INTO carruselgt (uuid_carrusel_gt, nombre_carrusel_gt, ruta_carrusel_gt, uuid_usuario) VALUES ('$uuid_carrusel', '$nombre', '$ruta', '$uuid_usuario')";
                if (mysqli_query($conn, $sql)) {
                    include 'mensajes/mensajeCreacion.php';
                } else {
                    include 'mensajes/mensajeError.php';
                }
                mysqli_close($conn);
            }      
        }
    }/* Registra items de carrusel */
    
    
    /* Edita registro de carrusel */
    if (isset($_POST['editarCarrusel'])) {
      $nombre_carrusel_gt = $_POST['nombre_carrusel_gt'];
      $uuid_carrusel_gt = $_POST['uuid_carrusel_gt'];
      /* cuando no viene la imagen */
      if (empty($_FILES['imagen']['name'])) {
          echo "<script>console.log( 'Ingreso sin imagen' );</script>";
          $sql = "UPDATE carruselgt SET nombre_carrusel_gt = '$nombre_carrusel_gt' WHERE uuid_carrusel_gt = '$uuid_carrusel_gt'";
              if (mysqli_query($conn, $sql)) {
                include 'mensajes/mensajeActualizacion.php';
              } else {
                  include 'mensajes/mensajeError.php';
              }
              mysqli_close($conn);
        } else{
          $nombre_carrusel_gt = $_POST['nombre_carrusel_gt'];
          $uuid_carrusel_gt = $_POST['uuid_carrusel_gt'];
          $archivo = $_FILES['imagen']['name'];
          //Recogemos el archivo enviado por el formulario
          $ruta = '../../../Cliente/imagenes/'.$archivo; 
          $path = "../../../Cliente/imagenes/"; //directorio donde se va colocar la imagen
    
      
            if (isset($archivo) && $archivo != "") {
                //Obtenemos algunos datos necesarios sobre el archivo
                $tipo = $_FILES['imagen']['type'];
                $tamano = $_FILES['imagen']['size'];
                $temp = $_FILES['imagen']['tmp_name'];
                //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
                if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 400000000 ))) {
                    include 'mensajes/mensajeError.php';
                } else {
                    //Si la imagen es correcta en tamaño y tipo
                    echo "<script>console.log( 'La imagen si es correcta' );</script>";
                    if (!is_dir($path)) { //Si el directorio no existe crea uno con lo maximo en permisos
                        mkdir($path, 0777, true);
                        echo "<script>console.log( 'Crea la carpeta' );</script>";
                    }
                    //Se intenta subir al servidor
                    $temp = $_FILES['imagen']['tmp_name'];
                    move_uploaded_file($temp,$ruta); 
                    echo "<script>console.log( 'Llega aca' );</script>";
                    //obtener la ruta para saber que es lo que se elimina
                    $rutaEliminarCarrusel = obtenerRutaItem($uuid_carrusel_gt);
                    if ($rutaEliminarCarrusel != '' || $rutaEliminarCarrusel != null){
                        unlink($rutaEliminarCarrusel);
                    }

                    /* Se actualiza los registros */
                    $sql = "UPDATE carruselgt SET nombre_carrusel_gt = '$nombre_carrusel_gt', ruta_carrusel_gt = '$ruta' WHERE uuid_carrusel_gt = '$uuid_carrusel_gt'";
                    if (mysqli_query($conn, $sql)) {
                    include 'mensajes/mensajeActualizacion.php';
                    } else {
                        include 'mensajes/mensajeError.php';
                    }
                    mysqli_close($conn);
                }      
            }
        }
    }/* Edita registro de carrusel */
    

    /* Funcion que devuelve la ruta de un registro en carrusel para eliminar la imagen */
    function obtenerRutaItem($uuid_carrusel_gt){
        include '../conexion/conn.php';
        $borrarCarpeta = mysqli_query($conn, "SELECT * FROM carruselgt WHERE uuid_carrusel_gt = '".$uuid_carrusel_gt."'");
        $rutaSeccion = "";
        while ($row = mysqli_fetch_assoc($borrarCarpeta)){
            $rutaCarrusel = $row['ruta_carrusel_gt'];
            echo "<script>console.log('La ruta enviada: " . $rutaCarrusel . "' );</script>";
        }
        if ($rutaCarrusel == '' || $rutaCarrusel == null){
            $rutaSeccion = "Vacia";
        }
        return $rutaSeccion;
    }/* Funcion que devuelve la ruta de un registro en carrusel para eliminar la imagen */


    /* elimina registro en carrusel */    
    if (isset($_POST['eliminarCarrusel'])) {
        include '../conexion/conexion.php';
        $uuid_carrusel_gt = $_POST['uuid_carrusel_gt'];
        if ($uuid_carrusel_gt != ''){
            // Check connection
            if ($mysqli->connect_error) {
                die("Connection failed: " . $mysqli->connect_error);
            } 
            $rutaEliminarCarrusel = obtenerRutaItem($uuid_carrusel_gt);
            if ($rutaEliminarCarrusel != '' || $rutaEliminarCarrusel != null){
                unlink($rutaEliminarCarrusel);
            }
            $sql = "DELETE FROM carruselgt WHERE `uuid_carrusel_gt` = '".$uuid_carrusel_gt."'";
            if (mysqli_query($mysqli, $sql)) {
                include 'mensajes/mensajeEliminacion.php';
            } else {
                include 'mensajes/mensajeError.php';
            }
            $mysqli->close();
        }
    }/* elimina registro en carrusel */    

?>

</body>
</html>
