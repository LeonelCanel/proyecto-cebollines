<?php
include '../pages/conexion/conexion.php';
session_start();
$correo = $_POST['correo'];
$contrasenia = $_POST['contrasena'];

$query = "SELECT uuid_usuario, usuario, contrasena, nombres_usuario, apellidos_usuario, correo FROM usuarios WHERE correo = '$correo' ";
$consulta  =  mysqli_query($mysqli, $query);
while ($row = mysqli_fetch_assoc($consulta)){
    $correo = $row['correo'];    
    $contra = $row['contrasena'];
    $nombres = $row['nombres_usuario'];
    $apellidos = $row['apellidos_usuario'];
    $usuario = $row['usuario'];
    $uuid_usuario = $row['uuid_usuario'];
}

$contrasenia = md5($contrasenia);


$loguear =  "SELECT COUNT(*) as contar FROM usuarios WHERE correo = '$correo' AND contrasena = '$contrasenia'";
$respuesta =  mysqli_query($mysqli, $loguear);
$array = mysqli_fetch_array($respuesta);
if ($array['contar']>0){
    $_SESSION['username'] = $uuid_usuario.' '.$nombres;
    echo "<script>console.log('Console: " . $_SESSION['username'] . "' );</script>";
    header("location: ../index.php");
}else{
    echo'<script type="text/javascript">
    alert("Las contraseñas no coinciden, por favor Verifique");
    window.location.href="usuarios.php";
    </script>';
    header("location: login.php");
}
?>