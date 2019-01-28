<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();
$servername = "localhost";
$username = "usuariosim";
$password = "";
$dbname = "sim";


if(isset($_GET["habitaciones"]))
	{
		$habitaciones = $_GET["habitaciones"];

		if($habitaciones == "traer")
			$consulta = "CALL p_s_traer_habitaciones()";
		else if($habitaciones == "ocupacion")
				$consulta = "SELECT * FROM view_ocupaciones";
			else $consulta = "SELECT * FROM view_ocupaciones WHERE NumeroHab=$habitaciones";

		$conexion = mysqli_connect($servername,$username,$password, $dbname);
		if (!$conexion) {
			die("Connection failed: " . mysqli_connect_error());
		}
		$resultado = mysqli_query($conexion, $consulta);
		$datos = array();

		while($row = mysqli_fetch_assoc($resultado))
			$datos[] = $row;

		echo json_encode($datos);
	}

	// ========= TRAE LA LISTA DE PRECIOS activada
	if(isset($_POST["lista_precios"]))
	{
		$lista_precios = $_POST["lista_precios"];
		if($lista_precios == "traer"){
			$conexion = mysqli_connect($servername,$username,$password, $dbname);

			$consulta = "SELECT f_lista_activa() as lista_activa";

			if (!$conexion) {
				die("Connection failed: " . mysqli_connect_error());
			}
			$resultado = mysqli_query($conexion, $consulta);

			$datos = array();

			while($row = mysqli_fetch_assoc($resultado))
				$datos[] = $row;

			echo json_encode($datos);
		}
	}

?>
