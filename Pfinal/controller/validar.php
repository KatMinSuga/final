<?php

if($_POST['loginUsername'] == "admin" && $_POST['loginPassword']=="unach"){
	session_start();
	$_SESSION['login'] = "true";
	$_SESSION['nomusuario'] = $_POST['loginUsername'];
	
	//header("location: menu.php");
	echo json_encode(array('success' => 1));
}
else{
	//header("location: index.php");	
	echo json_encode(array('success' => 0));
}	

?>


<!-----?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['loginUsername'];
    $password = $_POST['loginPassword'];

    include('conexion.php'); 
    $con = conectaDB();

   
    $query = $con->prepare("SELECT * FROM tb_usuarios WHERE NomUser = ? AND Passwd = ?");
    $query->bind_param("ss", $username, $password);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        $_SESSION['login'] = true;
        $_SESSION['nomusuario'] = $username;
        $_SESSION['nom_completo'] = $row['NomCompleto'];

        header("Location:dashboard.php");
        exit();
    } else {
        echo json_encode(array('success' => 0));
    }
} else {
    echo "Error: Acceso no permitido.";
}
?------>
