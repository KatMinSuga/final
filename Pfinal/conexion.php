<?php
function conectaDB() 
{ 
  	$host = 'localhost'; 
	$user = 'id22201448_user24';  //nombre de Usuario que proporciona 000webhost
	$pass = 'Gatitos01$';

   if (!( $link = @mysqli_connect($host,$user,$pass)) )
   {
      echo "Error al realizar la conexión a la base de datos.";
      exit();
   }

   if (!mysqli_select_db($link,"id22201448_miempresa")) //nombre dela BD que proporciona 000webhost
   { 
      echo "Error al seleccionar la base de datos."; 
      exit(); 
   }return $link;     
   
} 

?>