<?php
	session_start();
	if (!isset($_SESSION['login']))
		header("location: index.php");	
?>
<html>
<head>
	<title>Sistema de Pruebas UNACH</title>
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/cerulean/bootstrap.min.css">
	<link href="css/cmce-styles.css" rel="stylesheet">
	<!-- Bootstrap core JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>    
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	<!-- Boton guardar JavaScript -->
	<script>
    function enviarDatos() {
        var idPro = document.getElementById("idPro").value;
        var Nombre = document.getElementById("Nombre").value;
        var Precio = document.getElementById("Precio").value;
        var Ext = document.getElementById("Ext").value;

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "insertar.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                alert(xhr.responseText);
                location.reload();  // Recargar la página para ver los nuevos datos
            }
        };

        var params = "idPro=" + encodeURIComponent(idPro) +
                     "&Nombre=" + encodeURIComponent(Nombre) +
                     "&Precio=" + encodeURIComponent(Precio) +
                     "&Ext=" + encodeURIComponent(Ext);
        xhr.send(params);
    }
    </script>

</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
	<div class="container-fluid">
    	<a class="navbar-brand"><b>Nombre de usuario:</b> <?php echo $_SESSION['nomusuario']; ?> [ <?php echo $nom_completo; ?> ]</a> 
		<a href="cerrar.php"><button class="btn btn-warning">Cerrar Sesión</button></a>
  </div>
</nav> 
<center>
	<br><br><br><br>
		

	<form action="dashboard.php" method="GET">
	<div class="formpanel" id="f1">
		<b>Buscar producto por precio mayor a:</b> <input type="text" name="pre" size="4">
		<button class="btn btn-primary" type="submit">Buscar</button>
	</div>
	</form>
	
	<br><br>
		<hr>
	<br><br>

	<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
  		Nuevo Producto
	</button>

	<br><br>
<?php

	include('conexion.php');
	$con = conectaDB();
	if(isset($_GET['pre'])==true)		
		$sql ="select idPro,Nombre,Precio from tb_productos where Precio > ".$_GET['pre'];
	else
		$sql ="select idPro,Nombre,Precio from tb_productos";
		
	echo "<table class='table' style='width:570;'>";
	echo "<thead class='table-dark'>";
	echo "<th>Nombre</th>";
	echo "<th>Precio</th>";
	echo "<th></th>";
	echo "</thead>";
	echo "<tbody>";
	
	$resultado = mysqli_query($con,$sql);  
	while($fila = mysqli_fetch_row($resultado)){
 	
		echo "<tr>";
			echo "<td>".$fila[1]."</td>";
			echo "<td>".$fila[2]."</td>";
			echo "<td><a href='eliminar.php?idp=".$fila[0]."'><img src='iconoeliminar.png' width='20' heigth='20'></a></td>";
		echo "</tr>";
	
	}
	
	echo "</tbody> </table>";
?>
<br><br>
	<!-- Modal Ventada de Nuevo Producto -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registrar nuevo producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      
<!-- Modal registro nuevo producto -->

	<table>
        <tr>
            <td>id-Producto:</td>
            <td><input type="text" id="idPro"></td>
        </tr>
        <tr>
            <td>Nombre:</td>
            <td><input type="text" id="Nombre"></td>
        </tr>
        <tr>
            <td>Precio:</td>
            <td><input type="text" id="Precio"></td>
        </tr>
        <tr>
            <td>Existencia:</td>
            <td><input type="num" id="Ext"></td>
        </tr>
    </table>

	
<!-- Modal registro nuevo producto -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
         <button type="button" class="btn btn-success" onclick="enviarDatos()">Guardar</button>
        
      </div>
    </div>
  </div>
</div>


</center>

    <!-- Footer -->
    <footer class="footer bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white" ><b> UC: Desarrollo de aplicaciones web y móviles   [ Dr. Christian Mauricio Castillo Estrada ] </b></p>
      </div>
    </footer>

</body>
</html>