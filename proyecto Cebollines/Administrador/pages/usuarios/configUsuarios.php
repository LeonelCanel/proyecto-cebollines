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

    /* Creacion de usuarios para el ingreso al sistema */
    include '../conexion/conexion.php';
    if (isset($_POST['registrar'])) {
        echo "<script>console.log( 'Esta ingresando aca' );</script>";
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $usuario = $_POST['usuario'];
        $correo = $_POST['correo'];
        $contrasena = $_POST['contrasena'];
        $confContrasena = $_POST['confirmacion'];
        $tipoUsuario = $_POST['tipo_usuario'];

        $uuid_usuario = uniqid('', true);
        
        /* Se trasladan todas las variables a mayusculas */
        $nombres = strtoupper($nombres);
        $apellidos = strtoupper($apellidos);
        $usuario = strtoupper($usuario);
        $correo = strtoupper($correo);
        $tipoUsuario = strtoupper($tipoUsuario);

        
        $clave = md5($contrasena);
        if ($nombres != '' && $apellidos != '' && $usuario != '' && $correo != '' && $contrasena != '' && $confContrasena != '' && $tipoUsuario != ''){
            // Check connection
            if ($mysqli->connect_error) {
                die("Connection failed: " . $mysqli->connect_error);
            } else{
                if($confContrasena == $contrasena){
                    $sql = "INSERT INTO usuarios(uuid_usuario, usuario, contrasena, nombres_usuario, apellidos_usuario, correo, uuid_rol)VALUES ('$uuid_usuario','$usuario', '$clave', '$nombres', '$apellidos', '$correo', '$tipoUsuario')";
                    if (mysqli_query($mysqli, $sql)) {
                        include 'mensajes/mensajeCreacion.php';
                    } else {
                        include 'mensajes/mensajeError.php';
                    }
                } else{ 
                    include 'mensajes/mensajeContraseña.php';
                }
            }
            $mysqli->close();
        } else{
            include 'mensajes/mensajeError.php';
        }
    }/* Creacion de usuarios para el ingreso al sistema */



    /* Editar usuarios ya registrados */
    include '../conexion/conexion.php';
    if (isset($_POST['editarRegistro'])) {
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $usuario = $_POST['usuario'];
        $correo = $_POST['correo'];
        $uuid_usuario = $_POST['uuid_usuario'];
        $tipo_usuario = $_POST['tipo_usuario'];
        
        echo "<script>console.log('Tipo usuario enviado: " . $tipo_usuario . "' );</script>";

        $nombres = strtoupper($nombres);
        $apellidos = strtoupper($apellidos);
        $usuario = strtoupper($usuario);
        $correo = strtoupper($correo);

        

        if ($nombres != '' && $apellidos != '' && $usuario != '' && $correo != '' && $tipo_usuario != ''){
            // Check connection
            if ($mysqli->connect_error) {
                die("Connection failed: " . $mysqli->connect_error);
            } else{
                $sql = "UPDATE usuarios SET usuario = '$usuario', nombres_usuario = '$nombres', apellidos_usuario = '$apellidos', correo = '$correo', uuid_rol = '$tipo_usuario'  WHERE uuid_usuario = '$uuid_usuario'";
                if (mysqli_query($mysqli, $sql)) {
                    include 'mensajes/mensajeActualizacion.php';
                }
            }
            $mysqli->close();
        } else{
            include 'mensajes/mensajeError.php';
        }
    }/* Editar usuarios ya registrados */



    /* Eliminar registro de usuarios */
    if (isset($_POST['eliminarRegistro'])) {
        $uuid_usuario = $_POST['uuid_usuario'];

        if ($uuid_usuario != ''){
            // Check connection
            if ($mysqli->connect_error) {
                die("Connection failed: " . $mysqli->connect_error);
            } 
            $sql = "DELETE FROM usuarios WHERE `uuid_usuario` = '".$uuid_usuario."'";

            if (mysqli_query($mysqli, $sql)) {
                include 'mensajes/mensajeEliminacion.php';
            } else {
                include 'mensajes/mensajeError.php';
            }
            $mysqli->close();
        }
    }/* Eliminar registro de usuarios */


    /* Cambio de contraseña a usuarios */
    include '../conexion/conexion.php';
    if (isset($_POST['cambioContraseña'])) {
        echo "<script>console.log( 'Esta ingresando aca' );</script>";
        $contrasenia = $_POST['contrasenia'];
        $confirmacion = $_POST['confirmacion'];
        $uuid_usuario = $_POST['uuid_usuario'];
        

        if ($contrasenia != '' && $confirmacion != '' ){
            // Check connection
            if ($mysqli->connect_error) {
                die("Connection failed: " . $mysqli->connect_error);
            } else{
                if($contrasenia == $confirmacion){
                    $clave = md5($contrasenia);
                    $sql = "UPDATE usuarios SET contrasena = '$clave' WHERE uuid_usuario = '$uuid_usuario'";
                    if (mysqli_query($mysqli, $sql)) {
                        include 'mensajes/mensajeActualizacion.php';
                    }
                } else{
                    include 'mensajes/mensajeContraseña.php';
                }

            }
            $mysqli->close();
        } else{
            include 'mensajes/mensajeError.php';
        }
    }/* Cambio de contraseña a usuarios */


    /* Registro de rol para usuarios */
    include '../conexion/conexion.php';
    if (isset($_POST['registrar_rol'])) {
        
        $nombre_rol = $_POST['rol'];
        $uuid_rol = uniqid('', true);
        $nombre_rol = strtoupper($nombre_rol);
        // Check connection
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
            } else{
                $sql = "INSERT INTO rol(uuid_rol, tipo_rol)VALUES ('$uuid_rol', '$nombre_rol')";
                if (mysqli_query($mysqli, $sql)) {
                    include 'mensajes/mensajeCreacion.php';
                }else {
                    include 'mensajes/mensajeError.php';
                }
            }
        $mysqli->close();
    }/* Registro de rol para usuarios */
?>



<?php
    }
?>




<!-- <script>
    var btn = document.getElementById("consultar");
    btn.addEventListener("click", function()){
        var id_usuario = document.getElementById("")
    }
</script> -->