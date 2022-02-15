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


include 'Administrador/pages/conexion/conexion.php';
$uuid_producto_visitado = uniqid('', true);

$sql = "INSERT INTO productos_visitados (uuid_producto_visitado, nombre_producto_visitado, ip_visitante) VALUES ('$uuid_producto_visitado', '$nombre_item', '$ip')";
if (mysqli_query($mysqli, $sql)) {
    echo "<script>console.log('todo bien' );</script>";
} else {
    echo "<script>console.log('todo mal' );</script>";
}
mysqli_close($conn);
# Ya registramos la ip, ahora seguimos con el flujo normal ;)





?>