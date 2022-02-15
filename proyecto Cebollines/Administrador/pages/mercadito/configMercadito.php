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
    /* Registrar Seccion del Mercadito */
    /* Condicion que se ejecuta si se envia, "registrarSeccion" dentro del formulario */
    if (isset($_POST['registrarSeccion'])) {
        $nombreSeccion = $_POST['nombre_seccion'];
        $uuid_usuario = $_POST['uuid_usuario'];
        $nombreSeccion = strtoupper($nombreSeccion);
        $uuid_seccion = uniqid('', true);

        $sql = "INSERT INTO seccion_mercadito (uuid_seccion, nombre_seccion, uuid_usuario) VALUES ('$uuid_seccion', '$nombreSeccion', '$uuid_usuario')";
            if (mysqli_query($conn, $sql)) {
                include 'mensajes/mensajeCreacion.php';
            } else {
                include 'mensajes/mensajeError.php';
            }
            mysqli_close($conn);
    }    /* Registrar Seccion  */


    /* Editar menu */
    if (isset($_POST['editarSeccion'])) {
        include '../conexion/conexion.php';
        $uuid_seccion = $_POST['uuid_seccion'];
        $nombre_seccion = $_POST['nombre_seccion'];
        $uuid_usuario = $_POST['uuid_usuario'];
        $nombre_seccion = strtoupper($nombre_seccion);
        echo "<script>console.log('nombre_seccion: " . $nombre_seccion . "' );</script>";
        $sql = "UPDATE seccion_mercadito SET nombre_seccion = '$nombre_seccion' WHERE `uuid_seccion` = '".$uuid_seccion."'";
    
        if (mysqli_query($mysqli, $sql)) {
            include 'mensajes/mensajeActualizacion.php';
        } else {
            include 'mensajes/mensajeError.php';
        }
        $mysqli->close();
    }/* Editar menu */
    
    
    /* Eliminar menu */
    if (isset($_POST['eliminarSeccion'])) {
        include '../conexion/conexion.php';
        $uuid_seccion = $_POST['uuid_seccion'];
    
        if ($uuid_seccion != ''){
            // Check connection
            if ($mysqli->connect_error) {
                die("Connection failed: " . $mysqli->connect_error);
             } 
             $sql = "DELETE FROM seccion_mercadito WHERE `uuid_seccion` = '".$uuid_seccion."'";
    
             if (mysqli_query($mysqli, $sql)) {
                include 'mensajes/mensajeEliminacion.php';         
             } else {
                include 'mensajes/mensajeError';     
             }
             $mysqli->close();
        }
    }/* Eliminar menu */



    /* Registrar la receta del mercadito  */
    include '../conexion/conn.php';
    if (isset($_POST['registraReceta'])) {
        $titulo_receta = $_POST['titulo_receta'];
        $uuid_seccion = $_POST['uuid_seccion'];
        $uuid_usuario = $_POST['uuid_usuario'];
        $ingredientes = $_POST['ingredientes'];
        $preparacion = $_POST['preparacion'];

        $cantidad_personas = $_POST['cantidad_personas'];
        $tiempo_preparacion = $_POST['tiempo_preparacion'];
        $dificultad = $_POST['dificultad'];
        $archivo = $_FILES['imagen']['name'];

        $titulo_receta = strtoupper($titulo_receta);
        $uuid_item = uniqid('', true);

        echo "<script>console.log('Esta ingresando aca: " . $titulo_receta . "' );</script>";

        //Recogemos el archivo enviado por el formulario
        $ruta = '../../../Mercadito/imagenes/'.$titulo_receta.'/'.$archivo; 
        $path = "../../../Mercadito/imagenes/".$titulo_receta; //directorio donde se va colocar la imagen
        if (isset($archivo) && $archivo != "") {
            //Obtenemos algunos datos necesarios sobre el archivo
            $tipo = $_FILES['imagen']['type'];
            $tamano = $_FILES['imagen']['size'];
            $temp = $_FILES['imagen']['tmp_name'];
            //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
        if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 400000000 ))) {
            echo "<script>console.log( 'No corresponde la imagen' );</script>";
            echo "<script> swal({
                title: 'Error',
                text: 'Extensión de los archivos no valida.',
                type: 'error',
            });</script>";
        } else {
                //Si la imagen es correcta en tamaño y tipo
                if (!is_dir($path)) { //Si el directorio no existe crea uno con lo maximo en permisos
                    mkdir($path, 0777, true);
                    echo "<script>console.log( 'Crea la carpeta' );</script>";
                }
                //Se intenta subir al servidor
                $temp = $_FILES['imagen']['tmp_name'];
                move_uploaded_file($temp,$ruta); 
                $sql = "INSERT INTO items_mercadito (uuid_item, titulo_receta, ingredientes, preparacion, ruta_imagen, cantidad_personas, tiempo_preparacion, dificultad, uuid_seccion, uuid_usuario) VALUES ('$uuid_item','$titulo_receta', '$ingredientes', '$preparacion', '$ruta', '$cantidad_personas', '$tiempo_preparacion', '$dificultad', '$uuid_seccion', '$uuid_usuario')";
                if (mysqli_query($conn, $sql)) {
                    include 'mensajes/mensajeCreacion.php';
                } else {
                    include 'mensajes/mensajeError.php';
                }
                mysqli_close($conn);
            }      
        }
    }    /* Registrar Seccion  */



    /* Editar item */
    if (isset($_POST['editarItem'])) {
        $titulo_receta = $_POST['titulo_receta'];
        $ingredientes = $_POST['ingredientes'];
        $preparacion = $_POST['preparacion'];
        $uuid_item = $_POST['uuid_item'];
        $uuid_usuario = $_POST['uuid_usuario'];
        $titulo_receta = strtoupper($titulo_receta);
        
        $cantidad_personas = $_POST['cantidad_personas'];
        $tiempo_preparacion = $_POST['tiempo_preparacion'];
        $dificultad = $_POST['dificultad'];

        /* cuando no viene la imagen */
        if (empty($_FILES['imagen']['name'])) {
            echo "<script>console.log( 'Ingreso sin imagen' );</script>";
            $sql = "UPDATE items_mercadito SET titulo_receta = '$titulo_receta', ingredientes = '$ingredientes', preparacion = '$preparacion', cantidad_personas = '$cantidad_personas', tiempo_preparacion = '$tiempo_preparacion', dificultad = '$dificultad', uuid_usuario = '$uuid_usuario' WHERE uuid_item = '$uuid_item'";
                if (mysqli_query($conn, $sql)) {
                    include 'mensajes/mensajeActualizacion.php';
                } else {
                    include 'mensajes/mensajeError.php';
                }
                mysqli_close($conn);
        } else{
            $archivo = $_FILES['imagen']['name'];
            //Recogemos el archivo enviado por el formulario
            $ruta = '../../../Mercadito/imagenes/'.$titulo_receta.'/'.$archivo; 
            $path = "../../../Mercadito/imagenes/".$titulo_receta; //directorio donde se va colocar la imagen
        
            if (isset($archivo) && $archivo != "") {
                //Obtenemos algunos datos necesarios sobre el archivo
                $tipo = $_FILES['imagen']['type'];
                $tamano = $_FILES['imagen']['size'];
                $temp = $_FILES['imagen']['tmp_name'];
                //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
            if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 400000000 ))) {
                echo "<script>console.log( 'No corresponde la imagen' );</script>";
                echo'<script type="text/javascript">
                    alert("Extención no valida");
                    window.location.href="menus.php";
                    </script>';
            } else {
                    //Si la imagen es correcta en tamaño y tipo
                    echo "<script>console.log( 'La imagen si es correcta' );</script>";
                    if (!is_dir($path)) { //Si el directorio no existe crea uno con lo maximo en permisos
                        mkdir($path, 0777, true);
                        echo "<script>console.log( 'Crea la carpeta' );</script>";
                    }
                    //Se intenta subir al servidor
                    $temp = $_FILES['imagen']['tmp_name'];
                    move_uploaded_file($temp, $ruta); 
                    echo "<script>console.log( 'Llega aca' );</script>";

                    $sql = "UPDATE items_mercadito SET titulo_receta = '$titulo_receta', ingredientes = '$ingredientes', preparacion = '$preparacion', ruta_imagen = '$ruta', cantidad_personas = '$cantidad_personas', tiempo_preparacion = '$tiempo_preparacion', dificultad = '$dificultad', uuid_usuario = '$uuid_usuario' WHERE uuid_item = '$uuid_item'";
                    if (mysqli_query($conn, $sql)) {
                        include 'mensajes/mensajeActualizacion.php';
                    } else {
                        include 'mensajes/mensajeError.php';
                    }
                    mysqli_close($conn);
                }      
            }
        }
    }/* Editar item */


    /* Eliminar items */
    if (isset($_POST['eliminarItem'])) {
        
        include '../conexion/conexion.php';
        $uuid_item = $_POST['uuid_item'];
        if ($uuid_item != ''){
            // Check connection
            if ($mysqli->connect_error) {
                die("Connection failed: " . $mysqli->connect_error);
            } 
            $sql = "DELETE FROM `items_mercadito` WHERE `uuid_item` = '".$uuid_item."'";
            if (mysqli_query($mysqli, $sql)) {
                include 'mensajes/mensajeEliminacion.php';         
            } else {
                include 'mensajes/mensajeError';  
            }
            $mysqli->close();
        }
    }/* Eliminar items */

    

?>

</body>
</html>

<?php } ?>
