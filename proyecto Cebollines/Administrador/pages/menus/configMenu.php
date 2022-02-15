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
    /* Registrar menu  */
    /* Condicion que se ejecuta si se envia, "registrarMenu" dentro del formulario */
    if (isset($_POST['registrarMenu'])) {
        $nombreMenu = $_POST['nombre_menu'];
    
        $uuid_usuario = $_POST['uuid_usuario'];
        $nombreMenu = strtoupper($nombreMenu);
        $uuid_menu = uniqid('', true);

        $items = filter_input(INPUT_POST, 'item', FILTER_VALIDATE_BOOLEAN);
        if (!isset($_POST['item']))
        $items = 0;
        $sql = "INSERT INTO menus (uuid_menu, nombre_menu, secciones, uuid_usuario) VALUES ('$uuid_menu', '$nombreMenu', '$items', '$uuid_usuario')";
            if (mysqli_query($conn, $sql)) {
                include 'mensajes/mensajeCreacion.php';
            } else {
                include 'mensajes/mensajeError.php';
            }
            mysqli_close($conn);
    }    /* Registrar menu  */


    /* Editar menu */
    if (isset($_POST['editarMenu'])) {
        include '../conexion/conexion.php';
        $uuid_menu = $_POST['uuid_menu'];
        $nombreMenu = $_POST['nombre_menu'];
        $uuid_usuario = $_POST['uuid_usuario'];
        $nombreMenu = strtoupper($nombreMenu);
        $sql = "UPDATE menus SET nombre_menu = '$nombreMenu', uuid_menu = '$uuid_menu' WHERE `uuid_menu` = '".$uuid_menu."'";
    
        if (mysqli_query($mysqli, $sql)) {
            include 'mensajes/mensajeActualizacion.php';
        } else {
            include 'mensajes/mensajeError.php';
        }
        $mysqli->close();
    }/* Editar menu */
    
    
    /* Eliminar menu */
    if (isset($_POST['eliminarMenu'])) {
        include '../conexion/conexion.php';
        $uuid_menu = $_POST['uuid_menu'];
    
        if ($uuid_menu != ''){
            // Check connection
            if ($mysqli->connect_error) {
                die("Connection failed: " . $mysqli->connect_error);
             } 
             $sql = "DELETE FROM menus WHERE `uuid_menu` = '".$uuid_menu."'";
    
             if (mysqli_query($mysqli, $sql)) {
                include 'mensajes/mensajeEliminacion.php';         
             } else {
                include 'mensajes/mensajeError';     
             }
             $mysqli->close();
        }
    }/* Eliminar menu */


    /* Registrar secciones */
    if (isset($_POST['registrarSeccion'])) {
        $nombreSeccion = $_POST['nombre_seccion'];
        $uuid_menu  = $_POST['uuid_menu'];
        $items = filter_input(INPUT_POST, 'item', FILTER_VALIDATE_BOOLEAN);
        $uuid_usuario = $_POST['uuid_usuario'];
        $nombreSeccion = strtoupper($nombreSeccion);
        $uuid_seccion = uniqid('', true);
        if (!isset($_POST['item']))
        $items = 0;
        $nombreSeccion = strtoupper($nombreSeccion);
        $archivo = $_FILES['imagen']['name'];
        $archivo2 = $_FILES['imagen2']['name'];

        $item2 = filter_input(INPUT_POST, 'item2', FILTER_VALIDATE_BOOLEAN);
        if (!isset($_POST['item2']))
        $item2 = 0;

        echo "<script>console.log('item2: " . $item2 . "' );</script>";

        if (($archivo =='' || $archivo == null) && ($archivo2 == '' || $archivo2 == null)){
            $ruta = null;
            $sql = "INSERT INTO secciones (uuid_seccion, nombre_seccion, items, ruta, uuid_menu, uuid_usuario) VALUES ('$uuid_seccion', '$nombreSeccion', '$items', '$ruta', '$uuid_menu', '$uuid_usuario')";
            if (mysqli_query($conn, $sql)) {
                include 'mensajes/mensajeCreacion.php';
            } else {
                include 'mensajes/mensajeError.php';
            }
            mysqli_close($conn);
        } else{
            echo "<script>console.log( 'Llega al else' );</script>";
            if($archivo !='' || $archivo != null){
                $archivoEnviar = $_FILES['imagen']['name'];
                $imagenUsar = "imagen";
                echo "<script>console.log( 'Ingreso en archivo' );</script>";
            } else if ($archivo2 != '' || $archivo2 != null) {
                $archivoEnviar = $_FILES['imagen2']['name'];
                $imagenUsar = "imagen2";
                echo "<script>console.log( 'Ingreso en archivo 2' );</script>";

            }

            //Recogemos el archivo enviado por el formulario
            $ruta = '../../../Cliente/imagenes/secciones/'.$archivoEnviar; 
            $path = "../../../Cliente/imagenes/secciones/".$nombreSeccion; //directorio donde se va colocar la imagen
            if (isset($archivoEnviar) && $archivoEnviar != "") {
                //Obtenemos algunos datos necesarios sobre el archivo
                $tipo = $_FILES[$imagenUsar]['type'];
                $tamano = $_FILES[$imagenUsar]['size'];
                $temp = $_FILES[$imagenUsar]['tmp_name'];
                
                echo "<script>console.log('Tipo: " . $tipo . "' );</script>";
                echo "<script>console.log('tamaño: " . $tamano . "' );</script>";
                echo "<script>console.log('temp: " . $temp . "' );</script>";
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
                    echo "<script>console.log( 'La imagen si es correcta' );</script>";
                    if (!is_dir($path)) { //Si el directorio no existe crea uno con lo maximo en permisos
                        mkdir($path, 0777, true);
                        echo "<script>console.log( 'Crea la carpeta' );</script>";
                    }
                    //Se intenta subir al servidor
                    $temp = $_FILES[$imagenUsar]['tmp_name'];
                    move_uploaded_file($temp,$ruta); 
                    echo "<script>console.log( 'Llega aca' );</script>";
                    $sql = "INSERT INTO secciones (uuid_seccion, nombre_seccion, items, imagen, ruta, uuid_menu, uuid_usuario) VALUES ('$uuid_seccion', '$nombreSeccion', '$items', '$item2', '$ruta', '$uuid_menu', '$uuid_usuario')";
                    if (mysqli_query($conn, $sql)) {
                        include 'mensajes/mensajeCreacion.php';
                    } else {
                        include 'mensajes/mensajeError.php';
                    }
                    mysqli_close($conn);
                }      
            }
        }
    }/* Registrar secciones */



    /* Editar Secciones */
    if (isset($_POST['editarSeccion'])) {
        $uuid_seccion = $_POST['uuid_seccion'];
        $nombre_seccion = $_POST['nombre_seccion'];
        $uuid_usuario = $_POST['uuid_usuario'];
        $nombre_seccion = strtoupper($nombre_seccion);
        
        /* cuando no viene la imagen */
        if (empty($_FILES['imagen']['name'])) {
            echo "<script>console.log('Esta ingresando sin imagen' );</script>";
            $sql = "UPDATE secciones SET nombre_seccion = '$nombre_seccion', uuid_usuario = '$uuid_usuario' WHERE uuid_seccion = '$uuid_seccion'";
                if (mysqli_query($conn, $sql)) {
                    include 'mensajes/mensajeActualizacion.php';                 
                } else {
                    /* Mensaje de alerta cuando algo no se hace bien */
                    include 'mensajes/mensajeError.php';
                }
                mysqli_close($conn);
        } else{ /* cuando la edicion trae imagen */
            $archivo = $_FILES['imagen']['name'];
            //Recogemos el archivo enviado por el formulario
            $ruta = '../../../Cliente/imagenes/items/'.$nombre_seccion.'/'.$archivo; 
            $path = "../../../Cliente/imagenes/items/".$nombre_seccion; //directorio donde se va colocar la imagen
        
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
                    move_uploaded_file($temp,$ruta); 
                    echo "<script>console.log( 'Llega aca' );</script>";
                    $rutaEliminar = obtenerRuta($uuid_seccion);
                    $sql = "UPDATE secciones SET nombre_seccion = '$nombre_seccion', ruta = '$ruta', uuid_usuario = '$uuid_usuario' WHERE uuid_seccion = '$uuid_seccion'";
                    if (mysqli_query($conn, $sql)) {
                        unlink($rutaEliminar);
                        include 'mensajes/mensajeActualizacion.php';
                    } else {
                        include 'mensajes/mensajeError.php';
                    }
                    mysqli_close($conn);
                }      
            }
        }
    } /* Editar Secciones */


    /* Eliminar Secciones */
    if (isset($_POST['eliminarSeccion'])) {
        include '../conexion/conexion.php';
        $uuid_seccion = $_POST['uuid_seccion'];

        if ($uuid_seccion != ''){
            // Check connection
            if ($mysqli->connect_error) {
                die("Connection failed: " . $mysqli->connect_error);
            }
/*             $rutaEliminar = obtenerRuta($uuid_seccion);
            if ($rutaEliminar != 'Vacia'){
                unlink($rutaEliminar);
            } */
            $sql = "DELETE FROM secciones WHERE `uuid_seccion` = '".$uuid_seccion."'";
            if (mysqli_query($mysqli, $sql)) {
                include 'mensajes/mensajeEliminacion.php';
            } else {
                include 'mensajes/mensajeError.php';
            }
            $mysqli->close();
        }
    }/* Eliminar Secciones */


    /* Funcion que devuelve la ruta de un registro en secciones */
    function obtenerRuta($uuid_seccion){
        include '../conexion/conn.php';
        $borrarCarpeta = mysqli_query($conn, "SELECT * FROM secciones WHERE uuid_seccion = '".$uuid_seccion."'");
        $rutaSeccion = "";
        while ($row = mysqli_fetch_assoc($borrarCarpeta)){
            $rutaSeccion = $row['ruta'];
            echo "<script>console.log('La ruta enviada: " . $rutaSeccion . "' );</script>";
        }
        if ($rutaSeccion == '' || $rutaSeccion == null){
            $rutaSeccion = "Vacia";
        }
        return $rutaSeccion;
    }/* Funcion que devuelve la ruta de un registro en secciones */

    /* ingreso de los items */
    if (isset($_POST['registrarItem'])) {
        $uuid_seccion = $_POST['uuid_seccion'];
        $uuid_usuario = $_POST['uuid_usuario'];
        $nombre_item = $_POST['nombre_item'];
        $descripcion = $_POST['descripcion'];
        $archivo = $_FILES['imagen']['name'];
        $uuid_item = uniqid('', true);
        $uuid_precio = uniqid('', true);
        $contieneDescripcion = FALSE;
        if (empty($descripcion)){
            $contieneDescripcion = 0;
            $descripcion = NULL;
        } else{
            $contieneDescripcion = TRUE;
        } 

        $itemPrecio = filter_input(INPUT_POST, 'itemPrecio', FILTER_VALIDATE_BOOLEAN);
        if (!isset($_POST['itemPrecio'])){
            $itemPrecio = 0;
        }
        //Recogemos el archivo enviado por el formulario
        $ruta = '../../../Cliente/imagenes/items/'.$nombre_item.'/'.$archivo; 
        $path = "../../../Cliente/imagenes/items/".$nombre_item; //directorio donde se va colocar la imagen
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
                $sql = "INSERT INTO items (uuid_item, nombre_item, url_imagen_item, descripcion_item, contiene_descripcion, uuid_seccion, uuid_usuario) VALUES ('$uuid_item','$nombre_item', '$ruta', '$descripcion', $contieneDescripcion, '$uuid_seccion', '$uuid_usuario')";
                if (mysqli_query($conn, $sql)) {
                    $sql1 = "INSERT INTO precios (uuid_precio, precio_normal, precio_doble, precio_promocion, item_contiene_precio, uuid_item) VALUES ('$uuid_precio', 0,0,0, $itemPrecio, '$uuid_item')";
                    if (mysqli_query($conn, $sql1)) {
                        include 'mensajes/mensajeCreacion.php';
                    }
                } else {
                    include 'mensajes/mensajeError.php';
                }
                mysqli_close($conn);
            }      
        }
    }/* ingreso de los items */

    /* Editar item */
    if (isset($_POST['editarItem'])) {
        $descripcion = $_POST['descripcion'];
        $uuid_item = $_POST['uuid_item'];
        $uuid_usuario = $_POST['uuid_usuario'];
        $nombre_item = $_POST['nombre_item'];
        /* cuando no viene la imagen */
        if (empty($_FILES['imagen']['name'])) {
            echo "<script>console.log( 'Ingreso sin imagen' );</script>";
            $sql = "UPDATE items SET nombre_item = '$nombre_item', descripcion_item = '$descripcion', uuid_usuario = '$uuid_usuario' WHERE uuid_item = '$uuid_item'";
                if (mysqli_query($conn, $sql)) {
                    include 'mensajes/mensajeActualizacion.php';
                } else {
                    include 'mensajes/mensajeError.php';
                }
                mysqli_close($conn);
        } else{
            $archivo = $_FILES['imagen']['name'];
            //Recogemos el archivo enviado por el formulario
            $ruta = '../../../Cliente/imagenes/items/'.$nombre_item.'/'.$archivo; 
            $path = "../../../Cliente/imagenes/items/".$nombre_item; //directorio donde se va colocar la imagen
        
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
/*                     $rutaEliminarItem = obtenerRutaItem($uuid_item);
                    if ($rutaEliminarItem != '' || $rutaEliminarItem != null){
                        unlink($rutaEliminarItem);
                    } */
                    $sql = "UPDATE items SET nombre_item = '$nombre_item', url_imagen_item = '$ruta', descripcion_item = '$descripcion', uuid_usuario = '$uuid_usuario' WHERE uuid_item = '$uuid_item'";
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

    /* Eliminar Item */
    if (isset($_POST['eliminarItem'])) {
        include '../conexion/conexion.php';
        $uuid_item = $_POST['uuid_item'];
        if ($uuid_item != ''){
            // Check connection
            if ($mysqli->connect_error) {
                die("Connection failed: " . $mysqli->connect_error);
            } 
/*             $rutaEliminarItem = obtenerRutaItem($uuid_item);
            
            if ($rutaEliminarItem != '' || $rutaEliminarItem != null){
                unlink($rutaEliminarItem);
            } */
            $sql = "DELETE FROM items WHERE `uuid_item` = '".$uuid_item."'";
            if (mysqli_query($mysqli, $sql)) {
                include 'mensajes/mensajeEliminacion.php';
            } else {
                include 'mensajes/mensajeError.php';
            }
            $mysqli->close();
        }
    }/* Eliminar Item */

    /* Funcion que devuelve la ruta de un registro en secciones */
    function obtenerRutaItem($uuid_item){
        include '../conexion/conn.php';
        $borrarCarpeta = mysqli_query($conn, "SELECT * FROM items WHERE uuid_item = '".$uuid_item."'");
        $rutaSeccion = "";
        while ($row = mysqli_fetch_assoc($borrarCarpeta)){
            $rutaItems = $row['url_imagen_item'];
            echo "<script>console.log('La ruta enviada: " . $rutaItems . "' );</script>";
        }
        if ($rutaItems == '' || $rutaItems == null){
            $rutaSeccion = "Vacia";
        }
        echo "<script>console.log('Debug Objects: " . $rutaSeccion . "' );</script>";
        return $rutaSeccion;

    }/* Funcion que devuelve la ruta de un registro en secciones */


    include '../conexion/conexion.php';
    /* Agregar precio a los items */
    if (isset($_POST['registrarPrecio'])) {
        $precio_regular = $_POST['precio_regular'];
        $precio_doble = $_POST['precio_doble'];
        $precio_promocion = $_POST['precio_promocion'];
        $uuid_item = $_POST['uuid_item'];
        
        if (empty($precio_doble)) 
        {
            $precio_doble = 0;
        }
        
        if (empty($precio_promocion)) 
        {
            $precio_promocion = 0;
        }
        if ($precio_regular != ''){
            // Check connection
            if ($mysqli->connect_error) {
                die("Connection failed: " . $mysqli->connect_error);
            } else{
                $sql = "UPDATE precios SET precio_normal = $precio_regular, precio_doble = $precio_doble, precio_promocion = $precio_promocion WHERE uuid_item = '$uuid_item'";
                
                if (mysqli_query($mysqli, $sql)) {
                    echo'<script type="text/javascript">
                    alert("Precio actualizado correctamente");
                    window.location.href="menus.php";
                    </script>';
                } else {
                    echo "Error: " . $sql . "" . mysqli_error($mysqli);
                }
            }
            $mysqli->close();
        } else{
            echo'<script type="text/javascript">
            alert("Algunos campos no estan completados, por favor verifique.");
            window.location.href="menus.php";
            </script>';
        }
    }/* Agregar precio a los items */




    /* Crear un domicilio de los que se tienen registrados */
    /* Domicilios */
    if (isset($_POST['crearDomicilios'])){
        empty ($nombre_domicilio = $_POST['nombre_domicilio']); 
        $valorEnviado = false;
        $nombre_domicilio = strtoupper($nombre_domicilio);
        $uuid_menu = $_POST['uuid_menu'];
        $uuid_usuario = $_POST['uuid_usuario'];
        /* enlace del domicilio */
        $enlace = "";
        /* Verifico que variable contiene la informacion del enlace enviado */
        if ($valorEnviado != true){
            if (empty ($numero_llamada = $_POST['numero_llamada'])){
                $valorEnviado = false;
            } else{
                $valorEnviado = true;
                $enlace = $numero_llamada = $_POST['numero_llamada'];
                $domicilioAdicional = "tel:+502";
                $enlace = $domicilioAdicional . $enlace;
            }

            if (empty ($messenger = $_POST['messenger'])){
                $valorEnviado = false;
            } else {
                $valorEnviado = true;
                $enlace = $messenger = $_POST['messenger'];

            }

            if (empty ($whatsapp = $_POST['whatsapp'])){
                $valorEnviado = false;
            } else{
                $valorEnviado = true;
                $enlace = $whatsapp = $_POST['whatsapp'];
                $whatsAdicional = "https://api.whatsapp.com/send?phone=+502 ";
                $enlace = $whatsAdicional . $enlace;
                echo "<script>console.log('Enlace de whatsapp: " . $enlace . "' );</script>";
            }

            if (empty ($Telegram = $_POST['Telegram'])){
                $valorEnviado = false;
            } else{
                $valorEnviado = true;
                $enlace = $Telegram = $_POST['Telegram'];
                $telegramAdicional = "https://t.me/";
                $enlace = $telegramAdicional . $enlace;
            }

            if (empty ($Web = $_POST['Web'])) {
                $valorEnviado = false;     
            } else{
                $valorEnviado = true;
                $enlace = $Web = $_POST['Web'];
                $webAdicional = "https://";
                $enlace = $webAdicional . $enlace;
            }  
        } 

        $archivo = $_FILES['imagen']['name'];
        //Recogemos el archivo enviado por el formulario
        $ruta = '../../../Cliente/domicilios/'.$nombre_domicilio.'/'.$archivo; 
        $path = "../../../Cliente/domicilios/".$nombre_domicilio; //directorio donde se va colocar la imagen

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
                echo "<script>console.log( 'Llega aca' );</script>";
                $uuid_domicilio = uniqid('', true);
                $sql = "INSERT INTO domicilios (uuid_domicilio, nombre_domicilio, enlace_domicilio, ruta_imagen, uuid_usuario, uuid_menu) VALUES ('$uuid_domicilio','$nombre_domicilio', '$enlace', '$ruta', '$uuid_usuario', '$uuid_menu')";
                if (mysqli_query($conn, $sql)) {
                    include 'mensajes/mensajeCreacion.php';
                
                } else {
                    include 'mensajes/mensajeError.php';
                }
                mysqli_close($conn);
            }   

        }    
        
    }/* Domicilios */

?>

</body>
</html>

<?php } ?>
