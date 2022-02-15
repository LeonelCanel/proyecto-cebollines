<?php 
    include '../conexion/conn.php';
  if (isset($_POST['registrarSlogan'])) {
    $slogan = $_POST['slogan'];
    $nombre_restaurante = $_POST['nombre_restaurante'];
    $telefono = $_POST['telefono'];
    $archivo = $_FILES['imagen']['name'];
    //Recogemos el archivo enviado por el formulario
    $ruta = '../../../Cliente/imagenes/Slogan/'.$nombre_restaurante.'/'.$archivo; 
    $path = "../../../Cliente/imagenes/Slogan/".$nombre_restaurante; //directorio donde se va colocar la imagen
    

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
            $temp = $_FILES['imagen']['tmp_name'];
            move_uploaded_file($temp,$ruta); 
            echo "<script>console.log( 'Llega aca' );</script>";
            $sql = "INSERT INTO informacion (telefono_restaurante, nombre_restaurante, url_logo_restaurante, slogan_restaurante, id_usuario) VALUES ('$telefono', '$nombre_restaurante', '$ruta', '$slogan', 1)";
            if (mysqli_query($conn, $sql)) {
                echo "<script>console.log( 'Almacena la imagen' );</script>";
                echo'<script type="text/javascript">
                alert("Datos Almacenados correctamente");
                window.location.href="sloganRestaurante.php";
                </script>';
                
      } else {
        echo'<script type="text/javascript">
                alert("A ocurrido un error al ingresar los Datos, por favor intente más tarde");
                window.location.href="sloganRestaurante.php";
                </script>';
      }
      mysqli_close($conn);
        }      
    }
}




if (isset($_POST['editarSlogan'])) {
    $slogan = $_POST['slogan'];
    $telefono = $_POST['telefono'];
    $id_informacion = $_POST['id_informacion'];
    $nombre_restaurante = $_POST['nombre_restaurante'];
    /* cuando no viene la imagen */
    if (empty($_FILES['imagen']['name'])) {
        echo "<script>console.log( 'Ingreso sin imagen' );</script>";
        $sql = "UPDATE informacion SET telefono = '$telefono', nombre_restaurante = '$nombre_restaurante', slogan_restaurante = '$slogan', id_usuario = 1 WHERE id_informacion = '$id_informacion'";
            if (mysqli_query($conn, $sql)) {
                echo'<script type="text/javascript">
                alert("Datos actualizados correctamente");
                window.location.href="menus.php";
                </script>';
            } else {
                echo'<script type="text/javascript">
                alert("A ocurrido un error al ingresar los Datos, por favor intente más tarde");
                window.location.href="sloganRestaurante.php";
                </script>';
            }
            mysqli_close($conn);
      } else{
        $slogan = $_POST['slogan'];
        $telefono = $_POST['telefono'];
        $id_informacion = $_POST['id_informacion'];
        $nombre_restaurante = $_POST['nombre_restaurante'];
        $archivo = $_FILES['imagen']['name'];
        //Recogemos el archivo enviado por el formulario
        $ruta = '../../../Cliente/imagenes/Slogan/'.$nombre_restaurante.'/'.$archivo; 
        $path = "../../../Cliente/imagenes/Slogan/".$nombre_restaurante; //directorio donde se va colocar la imagen
    
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
            
            
            echo "<script>console.log( 'No corresponde la imagen' );</script>";
            echo'<script type="text/javascript">
                alert("Extención no valida");
                window.location.href="sloganRestaurante.php";
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
                $sql = "UPDATE informacion SET telefono_restaurante = '$telefono', nombre_restaurante = '$nombre_restaurante', url_logo_restaurante = '$ruta', slogan_restaurante = '$slogan', id_usuario = 1 WHERE id_informacion = '$id_informacion'";
                if (mysqli_query($conn, $sql)) {
                    echo'<script type="text/javascript">
                    alert("Datos actualizados correctamente");
                    window.location.href="sloganRestaurante.php";
                    </script>';
                } else {
                    echo'<script type="text/javascript">
                    alert("A ocurrido un error al ingresar los Datos, por favor intente más tarde");
                    window.location.href="sloganRestaurante.php";
                    </script>';
                }
                mysqli_close($conn);
            }      
        }
      }
}



if (isset($_POST['eliminarSlogan'])) {
    include '../conexion/conexion.php';
    $id = $_POST['id_informacion'];

    if ($id != ''){
        // Check connection
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
         } 
         $sql = "DELETE FROM informacion WHERE `id_informacion` = '".$id."'";

         if (mysqli_query($mysqli, $sql)) {
            echo'<script type="text/javascript">
            alert("Datos Eliminados correctamente.");
            window.location.href="sloganRestaurante.php";
            </script>';
         } else {
            echo "Error: " . $sql . "" . mysqli_error($mysqli);
         }
         $mysqli->close();
    }
}



?>