<?php
    session_start();
    $usuario = $_SESSION['username'];
    
    if(!isset($usuario)){
        header("location: ../../../login/login.php");
    } else{
      ?>
<?php 
    include '../conexion/conn.php';

  if (isset($_POST['registrarPresentacion'])) {
    $mensaje = $_POST['mensaje'];
    $archivo = $_FILES['imagen']['name'];
    $presentacion = "Presentacion";
    //Recogemos el archivo enviado por el formulario
    $ruta = '../../../Cliente/imagenes/'.$presentacion.'/'.$archivo; 
    $path = "../../../Cliente/imagenes/".$presentacion; //directorio donde se va colocar la imagen
    

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
            echo "<script>console.log( 'Llega aca con todo bueno' );</script>";
            $sql = "INSERT INTO presentacion (mensaje_presentacion, url_imagen_presentacion) VALUES ('$mensaje', '$ruta')";
            if (mysqli_query($conn, $sql)) {
                echo "<script>console.log( 'Almacena la imagen' );</script>";
                echo'<script type="text/javascript">
                alert("Datos Almacenados correctamente");
                window.location.href="presentacion.php";
                </script>';
                
      } else {
        echo'<script type="text/javascript">
                alert("A ocurrido un error al ingresar los Datos, por favor intente más tarde");
                window.location.href="presentacion.php";
                </script>';
      }
      mysqli_close($conn);
        }      
    }
}




if (isset($_POST['editarPresentacion'])) {
  $mensaje_presentacion = $_POST['mensaje_presentacion'];
  $id_presentacion = $_POST['id_presentacion'];
  $presentacion = "Presentacion";
  /* cuando no viene la imagen */
  if (empty($_FILES['imagen']['name'])) {
      echo "<script>console.log( 'Ingreso sin imagen' );</script>";
      $sql = "UPDATE presentacion SET mensaje_presentacion = '$mensaje_presentacion' WHERE id_presentacion = '$id_presentacion'";
          if (mysqli_query($conn, $sql)) {
              echo'<script type="text/javascript">
              alert("Datos actualizados correctamente");
              window.location.href="presentacion.php";
              </script>';
          } else {
              echo'<script type="text/javascript">
              alert("A ocurrido un error al ingresar los Datos, por favor intente más tarde");
              window.location.href="presentacion.php";
              </script>';
          }
          mysqli_close($conn);
    } else{
      $mensaje_presentacion = $_POST['mensaje_presentacion'];
      $id_presentacion = $_POST['id_presentacion'];
      $archivo = $_FILES['imagen']['name'];
      //Recogemos el archivo enviado por el formulario
      $ruta = '../../../Cliente/imagenes/'.$presentacion.'/'.$archivo; 
      $path = "../../../Cliente/imagenes/".$presentacion; //directorio donde se va colocar la imagen

  
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
              window.location.href="presentacion.php";
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
              $sql = "UPDATE presentacion SET mensaje_presentacion = '$mensaje_presentacion', url_imagen_presentacion = '$ruta' WHERE id_presentacion = '$id_presentacion'";
              if (mysqli_query($conn, $sql)) {
                  echo'<script type="text/javascript">
                  alert("Datos actualizados correctamente");
                  window.location.href="presentacion.php";
                  </script>';
              } else {
                  echo'<script type="text/javascript">
                  alert("A ocurrido un error al ingresar los Datos, por favor intente más tarde");
                  window.location.href="presentacion.php";
                  </script>';
              }
              mysqli_close($conn);
          }      
      }
    }
}


if (isset($_POST['eliminarPresentacion'])) {
  include '../conexion/conexion.php';
  $id = $_POST['id_presentacion'];

  if ($id != ''){
      // Check connection
      if ($mysqli->connect_error) {
          die("Connection failed: " . $mysqli->connect_error);
       } 
       $sql = "DELETE FROM presentacion WHERE `id_presentacion` = '".$id."'";

       if (mysqli_query($mysqli, $sql)) {
          echo'<script type="text/javascript">
          alert("Datos Eliminados correctamente.");
          window.location.href="presentacion.php";
          </script>';
       } else {
          echo "Error: " . $sql . "" . mysqli_error($mysqli);
       }
       $mysqli->close();
  }
}
?>

<?php
      echo "<a href='salir.php'>Salir</a>";
    }
?>
