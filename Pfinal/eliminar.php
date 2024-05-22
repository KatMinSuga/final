<?php
$par1 = $_GET['idp'];


include('conexion.php');
$con = conectaDB();
$sql ="delete from tb_productos where idPro=".$par1;

mysqli_query($con,$sql); 

header("location:dashboard.php");

?>