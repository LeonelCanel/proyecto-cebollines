<?php
    session_start();
    $usuario = $_SESSION['username'];
    $uuid_usuario = substr($usuario, 0, 23);
    if(!isset($usuario)){
        header("location: ../../login/login.php");
    } else{
?>
<!DOCTYPE html>
<html lang="es">
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
    /* ---------------------------- Menus ------------------------------------------- */
    /* Creacion del menu */
    if (isset($_POST['registrarMenu_SV'])) {
        $nombre_menu_sv = $_POST['nombre_menu_sv']; 
        $uuid_usuario_sv = $_POST['uuid_usuario_sv'];
        $nombre_menu_sv = strtoupper($nombre_menu_sv);
        $uuid_menu = uniqid('', true);
        $items = filter_input(INPUT_POST, 'item', FILTER_VALIDATE_BOOLEAN);
        if (!isset($_POST['item']))
        $items = 0;
        $sql = "INSERT INTO menusv (uuid_menu_sv, nombre_menu_sv, secciones_sv, uuid_usuario) VALUES ('$uuid_menu', '$nombre_menu_sv', $items, '$uuid_usuario_sv')";
        if (mysqli_query($conn, $sql)) {
            include 'mensajes/mensajeCreacion.php';   
        } else {
            include 'mensajes/mensajeError.php';   
        }
        mysqli_close($conn);
    }/* Creacion del menu */


    /* Creacion del menu */
    if (isset($_POST['editarMenuSV'])) {
        include '../conexion/conexion.php';
        $uuid_menu_sv = $_POST['uuid_menu_sv'];
        $nombre_menu_sv = $_POST['nombre_menu_sv'];
        $uuid_usuario = $_POST['uuid_usuario'];
        $nombre_menu_sv = strtoupper($nombre_menu_sv);
        $sql = "UPDATE menusv SET nombre_menu_sv = '$nombre_menu_sv', uuid_menu_sv = '$uuid_menu_sv' WHERE `uuid_menu_sv` = '".$uuid_menu_sv."'";
        if (mysqli_query($mysqli, $sql)) {
            include 'mensajes/mensajeActualizacion.php';   
        } else {
            include 'mensajes/mensajeError.php';   
        }
        $mysqli->close();
    }/* Creacion del menu */


    /* Eliminar Menu */
    if (isset($_POST['eliminarMenuSV'])) {
        include '../conexion/conexion.php';
        $uuid_menu_sv = $_POST['uuid_menu_sv'];

        if ($uuid_menu_sv != ''){
            // Check connection
            if ($mysqli->connect_error) {
                die("Connection failed: " . $mysqli->connect_error);
            } 
            $sql = "DELETE FROM menusv WHERE `uuid_menu_sv` = '".$uuid_menu_sv."'";

            if (mysqli_query($mysqli, $sql)) {
                include 'mensajes/mensajeEliminacion.php';   
            } else {
                include 'mensajes/mensajeError.php';   
            }
            $mysqli->close();
        }
    }/* Eliminar Menu */

    /* ----------------------------Menus ------------------------------------------- */



    /* ----------------------------secciones----------------------------------------- */

    /* Crear Seccion */
    if (isset($_POST['registrarSeccionSV'])) {
        $nombre_seccion_sv = $_POST['nombre_seccion_sv'];
        $uuid_menu_sv  = $_POST['uuid_menu_sv'];
        $items = filter_input(INPUT_POST, 'item', FILTER_VALIDATE_BOOLEAN);
        $uuid_usuario = $_POST['uuid_usuario'];
        $nombre_seccion_sv = strtoupper($nombre_seccion_sv);
        $uuid_seccion_sv = uniqid('', true);

        if (!isset($_POST['item']))
        $items = 0;
        $nombre_seccion_sv = strtoupper($nombre_seccion_sv);
        $archivo = $_FILES['imagen']['name'];
        $archivo2 = $_FILES['imagen2']['name'];

        $item2 = filter_input(INPUT_POST, 'item2', FILTER_VALIDATE_BOOLEAN);
        if (!isset($_POST['item2']))
        $item2 = 0;


        if (($archivo =='' || $archivo == null) && ($archivo2 == '' || $archivo2 == null)){
            $ruta = null;
            $sql = "INSERT INTO seccionessv (uuid_seccion_sv, nombre_seccion_sv, items, ruta, uuid_menu_sv, uuid_usuario) VALUES ('$uuid_seccion_sv', '$nombre_seccion_sv', '$items', '$ruta', '$uuid_menu_sv', '$uuid_usuario')";
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
            $ruta = '../../../Salvador/imagenes/secciones/'.$nombre_seccion_sv.'/'.$archivoEnviar; 
            $path = "../../../Salvador/imagenes/secciones/".$nombre_seccion_sv; //directorio donde se va colocar la imagen
            if (isset($archivoEnviar) && $archivoEnviar != "") {
                //Obtenemos algunos datos necesarios sobre el archivo
                $tipo = $_FILES[$imagenUsar]['type'];
                $tamano = $_FILES[$imagenUsar]['size'];
                $temp = $_FILES[$imagenUsar]['tmp_name'];
                echo "<script>console.log( 'Valida imagen tipo, tamaño' );</script>";
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
                    $temp = $_FILES[$imagenUsar]['tmp_name'];
                    move_uploaded_file($temp,$ruta); 
                    echo "<script>console.log( 'Llega aca' );</script>";
                    $sql = "INSERT INTO seccionessv (uuid_seccion_sv, nombre_seccion_sv, items, imagen, ruta, uuid_menu_sv, uuid_usuario) VALUES ('$uuid_seccion_sv', '$nombre_seccion_sv', '$items', '$item2', '$ruta', '$uuid_menu_sv', '$uuid_usuario')";
                    if (mysqli_query($conn, $sql)) {
                        include 'mensajes/mensajeCreacion.php'; 
                        
                    } else {
                        include 'mensajes/mensajeError.php'; 
                    }
                    mysqli_close($conn);
                }      
            }
        }
        
    } /* Crear Seccion */


    /* Editar Secciones */
    if (isset($_POST['editarSeccionSV'])) {
        $uuid_seccion_sv = $_POST['uuid_seccion_sv'];
        $nombre_seccion_sv = $_POST['nombre_seccion_sv'];
        $uuid_usuario = $_POST['uuid_usuario'];
        $nombre_seccion_sv = strtoupper($nombre_seccion_sv);
        /* cuando no viene la imagen */
        if (empty($_FILES['imagen']['name'])) {
            echo "<script>console.log('Esta ingresando sin imagen' );</script>";
            $sql = "UPDATE seccionessv SET nombre_seccion_sv = '$nombre_seccion_sv', uuid_usuario = '$uuid_usuario' WHERE uuid_seccion_sv = '$uuid_seccion_sv'";
                if (mysqli_query($conn, $sql)) {
                    include 'mensajes/mensajeActualizacion.php'; 
                } else {
                    include 'mensajes/mensajeError.php'; 
                }
                mysqli_close($conn);
        } else{
            $archivo = $_FILES['imagen']['name'];
            //Recogemos el archivo enviado por el formulario
            $ruta = '../../../Salvador/imagenes/items/'.$nombre_seccion_sv.'/'.$archivo; 
            $path = "../../../Salvador/imagenes/items/".$nombre_seccion_sv; //directorio donde se va colocar la imagen
        
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
                    $sql = "UPDATE seccionessv SET nombre_seccion_sv = '$nombre_seccion_sv', ruta = '$ruta', uuid_usuario = '$uuid_usuario' WHERE uuid_seccion_sv = '$uuid_seccion_sv'";
                    if (mysqli_query($conn, $sql)) {
                        include 'mensajes/mensajeActualizacion.php'; 
                    } else {
                        include 'mensajes/mensajeError.php'; 
                    }
                    mysqli_close($conn);
                }      
            }
        }
    }/* Editar Secciones */


    /* Eliminar Secciones */
    if (isset($_POST['eliminarSeccionSV'])) {
        include '../conexion/conexion.php';
        $uuid_seccion_sv = $_POST['uuid_seccion_sv'];
    
        if ($uuid_seccion_sv != ''){
            // Check connection
            if ($mysqli->connect_error) {
                die("Connection failed: " . $mysqli->connect_error);
             } 
             $sql = "DELETE FROM seccionessv WHERE `uuid_seccion_sv` = '".$uuid_seccion_sv."'";
    
             if (mysqli_query($mysqli, $sql)) {
                include 'mensajes/mensajeEliminacion.php'; 
             } else {
                include 'mensajes/mensajeError.php'; 
             }
             $mysqli->close();
        }
    }/* Eliminar Secciones */

    /* ----------------------------secciones----------------------------------------- */


    /* ---------------------------- Items ----------------------------------------- */

    /* ingreso de los items */
    if (isset($_POST['registrarItemSV'])) {

        $uuid_seccion_sv = $_POST['uuid_seccion_sv'];
        $uuid_usuario = $_POST['uuid_usuario'];
        $nombre_item_sv = $_POST['nombre_item_sv'];
        $descripcion = $_POST['descripcion'];
        $archivo = $_FILES['imagen']['name'];
        $uuid_item_sv = uniqid('', true);
        $uuid_precio_sv = uniqid('', true);
        $contieneDescripcion = FALSE;
        if (empty($descripcion)){
            $contieneDescripcion = 0;
            $descripcion = NULL;
        } else{
            $contieneDescripcion = TRUE;
        } 

        $itemPrecio_sv = filter_input(INPUT_POST, 'itemPrecio', FILTER_VALIDATE_BOOLEAN);
        if (!isset($_POST['itemPrecio'])){
            $itemPrecio_sv = 0;
        } else{
            $itemPrecio_sv = 1;
        }
        
        //Recogemos el archivo enviado por el formulario
        $ruta = '../../../Salvador/imagenes/items/'.$nombre_item_sv.'/'.$archivo; 
        $path = "../../../Salvador/imagenes/items/".$nombre_item_sv; //directorio donde se va colocar la imagen
        

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
                $sql = "INSERT INTO itemssv (uuid_item_sv, nombre_item_sv, url_imagen_item_sv, descripcion_item_sv, contiene_descripcion_sv, uuid_seccion_sv, uuid_usuario) VALUES ('$uuid_item_sv','$nombre_item_sv', '$ruta', '$descripcion', $contieneDescripcion, '$uuid_seccion_sv', '$uuid_usuario')";
                if (mysqli_query($conn, $sql)) {
                    $sql1 = "INSERT INTO preciossv (uuid_precio_sv, precio_normal_sv, precio_doble_sv, precio_promocion_sv, item_contiene_precio_sv, uuid_item_sv) VALUES ('$uuid_precio_sv', 0,0,0, $itemPrecio_sv, '$uuid_item_sv')";
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


    /* Editar items */
    if (isset($_POST['editarItemSV'])) {
        $descripcion = $_POST['descripcion'];
        $uuid_item_sv = $_POST['uuid_item_sv'];
        $uuid_usuario = $_POST['uuid_usuario'];
        $nombre_item_sv = $_POST['nombre_item_sv'];
        /* cuando no viene la imagen */
        if (empty($_FILES['imagen']['name'])) {
            echo "<script>console.log( 'Ingreso sin imagen' );</script>";
            $sql = "UPDATE itemssv SET nombre_item_sv = '$nombre_item_sv', descripcion_item_sv = '$descripcion', uuid_usuario = '$uuid_usuario' WHERE uuid_item_sv = '$uuid_item_sv'";
                if (mysqli_query($conn, $sql)) {
                    include 'mensajes/mensajeActualizacion.php'; 
                } else {
                    include 'mensajes/mensajeActualizacion.php'; 
                }
                mysqli_close($conn);
        } else{
            $archivo = $_FILES['imagen']['name'];
            //Recogemos el archivo enviado por el formulario
            $ruta = '../../../Salvador/imagenes/items/'.$nombre_item_sv.'/'.$archivo; 
            $path = "../../../Salvador/imagenes/items/".$nombre_item_sv; //directorio donde se va colocar la imagen
        
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
                    move_uploaded_file($temp, $ruta); 
                    echo "<script>console.log( 'Llega aca' );</script>";
                    $sql = "UPDATE itemssv SET nombre_item_sv = '$nombre_item_sv', url_imagen_item_sv = '$ruta', descripcion_item_sv = '$descripcion', uuid_usuario = '$uuid_usuario' WHERE uuid_item_sv = '$uuid_item_sv'";
                    if (mysqli_query($conn, $sql)) {
                        include 'mensajes/mensajeActualizacion.php'; 
                    } else {
                        include 'mensajes/mensajeError.php'; 
                    }
                    mysqli_close($conn);
                }      
            }
        }
    }/* Editar items */


    /* Eliminar Items */
    if (isset($_POST['eliminarItemSV'])) {
        include '../conexion/conexion.php';
        $uuid_item_sv = $_POST['uuid_item_sv'];

        if ($uuid_item_sv != ''){
            // Check connection
            if ($mysqli->connect_error) {
                die("Connection failed: " . $mysqli->connect_error);
            } 
            $sql = "DELETE FROM itemssv WHERE `uuid_item_sv` = '".$uuid_item_sv."'";

            if (mysqli_query($mysqli, $sql)) {
                include 'mensajes/mensajeEliminacion.php'; 
            } else {
                include 'mensajes/mensajeError.php'; 
            }
            $mysqli->close();
        }
    }/* Eliminar Items */

    /* ---------------------------- Items ----------------------------------------- */


    /* ---------------------------- Precios ----------------------------------------- */
    
    /* Creacion de precios a los items */
    include '../conexion/conexion.php';
    if (isset($_POST['registrarPrecioSV'])) {
        $precio_regular_sv = $_POST['precio_regular_sv'];
        $precio_doble_sv = $_POST['precio_doble_sv'];
        $precio_promocion_sv = $_POST['precio_promocion_sv'];
        $uuid_item_sv = $_POST['uuid_item_sv'];
        
        if (empty($precio_doble_sv)) 
        {
            $precio_doble_sv = 0;
        }
        
        if (empty($precio_promocion_sv)) 
        {
            $precio_promocion_sv = 0;
        }
        if ($precio_regular_sv != ''){
            // Check connection
            if ($mysqli->connect_error) {
                die("Connection failed: " . $mysqli->connect_error);
            } else {
                $sql = "UPDATE preciossv SET precio_normal_sv = $precio_regular_sv, precio_doble_sv = $precio_doble_sv, precio_promocion_sv = $precio_promocion_sv WHERE uuid_item_sv = '$uuid_item_sv'";
                
                if (mysqli_query($mysqli, $sql)) {
                    include 'mensajes/mensajeActualizacion.php'; 
                } else {
                    include 'mensajes/mensajeError.php'; 
                }
            }
            $mysqli->close();
        } else {
            include 'mensajes/mensajeError.php'; 
        }
    }/* Creacion de precios a los items */
    
    /* ---------------------------- Precios ----------------------------------------- */


    
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
                $domicilioAdicional = "tel:+503";
                $enlace = $domicilioAdicional . $enlace;
            }

            if (empty ($whatsapp = $_POST['whatsapp'])){
                $valorEnviado = false;
            } else{
                $valorEnviado = true;
                $enlace = $whatsapp = $_POST['whatsapp'];
                $whatsAdicional = "https://api.whatsapp.com/send?phone=+503 ";
                $enlace = $whatsAdicional . $enlace;
                echo "<script>console.log('Enlace de whatsapp: " . $enlace . "' );</script>";
            } 
        } 

        $archivo = $_FILES['imagen']['name'];
        //Recogemos el archivo enviado por el formulario
        $ruta = '../../../domicilios/'.$nombre_domicilio.'/'.$archivo; 
        $path = "../../../domicilios/".$nombre_domicilio; //directorio donde se va colocar la imagen

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
                $uuid_domicilio = uniqid('', true);
                $sql = "INSERT INTO domiciliossv (uuid_domicilio_sv, nombre_domicilio_sv, enlace_domicilio, ruta_imagen_sv, uuid_usuario, uuid_menu) VALUES ('$uuid_domicilio','$nombre_domicilio', '$enlace', '$ruta', '$uuid_usuario', '$uuid_menu')";
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