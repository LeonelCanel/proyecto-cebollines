<?php
/**
 * Obtener y guardar la IP de un visitante en PHP
 *
 */
# Para obtener la fecha correcta hay que poner la zona horaria
date_default_timezone_set("America/Guatemala");
$fechaYHora = date("Y-m-d H:i:s");
# Si no hay REMOTE_ADDR entonces ponemos "Desconocida"
$ip = empty($_SERVER["REMOTE_ADDR"]) ? "Desconocida" : $_SERVER["REMOTE_ADDR"];
# Formatear mensaje
$mensaje = sprintf("La IP %s accedió en %s%s", $ip, $fechaYHora, PHP_EOL);

include '../Administrador/pages/conexion/conexion.php';
$uuid_visita_sv = uniqid('', true);
$fechaCreacion = date("Y-m-d H:i:s");
$result = mysqli_query($mysqli, "SELECT * FROM visitassv WHERE ip_visitante_sv = '$ip' ORDER BY fecha_creacion DESC LIMIT 1;");
while ($row = mysqli_fetch_assoc($result)){
    $fechaCreacion = $row['fecha_creacion'];
}
$horaAlmacenada = substr($fechaCreacion, 10,19);
$horaAdelantada =  substr($horaAlmacenada, 0,3);
$horaAdelantada = $horaAdelantada - 1;

$horaSis = substr($fechaYHora, 10,19);
$horaSisUtil = substr($horaSis,0,3);


$horaLocal = substr($fechaYHora, 10, 19);
$fechaYHora = substr($fechaYHora, 0,10);
$fechaCreacion = substr($fechaCreacion, 0,10);
echo "<script>console.log('Fecha obtenida en el sistema: " . $fechaYHora . "' );</script>";
echo "<script>console.log('Fecha recibida en base de datos: " . $fechaCreacion . "' );</script>";
echo "<script>console.log('hora adelantadas: " . $horaAdelantada . "' );</script>";
echo "<script>console.log('Hora sis: " . $horaSisUtil . "' );</script>";
echo "<script>console.log('Hora que esta almacenada: " . $horaAlmacenada . "' );</script>";
echo "<script>console.log('hora que se obtiene en el sistema: " . $horaLocal . "' );</script>";

/* Validar si es el mismo dia */
if ($fechaCreacion == $fechaYHora){
    echo "<script>console.log('es el mismo dia que inicio en el sistema' );</script>";
    if ($horaAdelantada == $horaSisUtil){
        echo "<script>console.log('La hora y dia es el mismo' );</script>";    
    } else {
        echo "<script>console.log('Es diferente hora' );</script>";        
        $sql = "INSERT INTO visitassv (uuid_visita_sv, ip_visitante_sv) VALUES ('$uuid_visita_sv', '$ip')";
        if (mysqli_query($mysqli, $sql)) {
            echo "<script>console.log('todo bien' );</script>";
        } else {
            echo "<script>console.log('todo mal' );</script>";
        }
        mysqli_close($conn);
        # Ya registramos la ip, ahora seguimos con el flujo normal ;)
    }
} else {
    echo "<script>console.log('fue diferente dia' );</script>";
    echo "<script>console.log('Es diferente hora ' );</script>";    
    $sql = "INSERT INTO visitassv (uuid_visita_sv, ip_visitante_sv) VALUES ('$uuid_visita_sv', '$ip')";
    if (mysqli_query($mysqli, $sql)) {
        echo "<script>console.log('todo bien' );</script>";
    } else {
        echo "<script>console.log('todo mal' );</script>";
    }
    mysqli_close($conn);
    # Ya registramos la ip, ahora seguimos con el flujo normal ;)
}





?>