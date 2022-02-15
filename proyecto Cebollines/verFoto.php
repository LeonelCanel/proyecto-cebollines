<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php
    require_once 'conexion.php';
    $sql = "SELECT foto FROM foto where id = 1"; 
    $result = mysql_query($sql);
?>
<?php
    while($row = mysql_fetch_array($result)) {
?>
//En $row["imageId"] debes cambiar imageId por como se llama en tu tabla la columna que tiene la id de la imagen
<img src="verFoto.php?image_id=<?php echo $row["foto"]; ?>" /><br/>
<?php       
    }
    mysql_close($conn);
?>
</body>
</html>