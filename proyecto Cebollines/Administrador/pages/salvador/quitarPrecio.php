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
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    
    <title></title>
</head>
<body>
<?php 
    include '../conexion/conexion.php';
    $uuid_item = $_GET['uuid_item_sv'];
    $item_contiene_precio = 0;
    if ($uuid_item != ''){
        // Check connection
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        } else{
            $sql = "UPDATE preciossv SET item_contiene_precio_sv = $item_contiene_precio WHERE uuid_item_sv = '$uuid_item'";
            
            if (mysqli_query($mysqli, $sql)) {
                include 'mensajes/mensajeActualizacion.php';
            } else {
                include 'mensajes/mensajeError.php';
            }
        }
        $mysqli->close();
    } else{
        
?>
<script LANGUAGE="javascript">
    $(document).ready(function() {
        Swal.fire({
        title: 'Campos incompletos',
        text: "Algunos campos no estan completos, por favor verifique. =)",
        icon: 'info',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "menusSalvador.php";
        }
        })
    });
</script>                
<?php 


    }

?>

</body>
</html>
<?php } ?>