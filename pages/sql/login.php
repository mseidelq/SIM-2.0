<?php
$servername = "localhost";
$username = "usuariosim";
$password = "administrarsim";
$dbname = "sim";

	// FUNCION PARA CREAR TIPO DE HABITACION
	if(isset($_GET["usr"])){
    $usr = $_GET["usr"]."-".$_GET['contrasena'];
    echo json_encode($usr);
    //echo $usr;
  }
?>
