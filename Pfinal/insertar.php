<?php
$idPro = $_POST['idPro'];
$Nombre = $_POST['Nombre'];
$Precio = $_POST['Precio'];
$Ext = $_POST['Ext'];

include('conexion.php');
$con = conectaDB();

$sql = "INSERT INTO tb_productos VALUES(" . $idPro . ", '" . $Nombre . "', " . $Precio . ", " . $Ext . ")";

if (mysqli_query($con, $sql)) {
    echo "Nuevo registro creado exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}

mysqli_close($con);
?>
