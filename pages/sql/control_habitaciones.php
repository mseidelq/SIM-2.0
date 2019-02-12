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

	// PRECIOS PARA LA LISTA DE PRECIO ACTIVA

	if(isset($_POST["lista_activa"]))
	{
		$listaSeleccionada = $_POST["lista_activa"];
		$tipo = $_POST["tipo"];

		$conexion = mysqli_connect($servername,$username,$password, $dbname);

		$consulta = "CALL s_precios_lista_habitacion($listaSeleccionada,$tipo)";

		if (!$conexion) {
			die("Connection failed: " . mysqli_connect_error());
		}

		$resultado = mysqli_query($conexion, $consulta);
		$datos = array();

		while($row = mysqli_fetch_assoc($resultado))
			$datos[] = $row;

		echo json_encode($datos);
	}

	// INSERTAR OCUPACION DE LA HABITACION
	if(isset($_POST['ocupacion'])){

		$datos = $_POST['ocupacion'];

		$insertar  = "CALL p_i_iniciar_ocupacion($datos[0], $datos[1], $datos[2], $datos[3], $datos[4], $datos[5], '$datos[6]', '$datos[7]' , $datos[8])";
		// YA GUARDA EN LA BASE DE DATOS DE OCUPACION

		//** verificar si la habitacion ya está ocupada
		$conexion = mysqli_connect($servername,$username,$password, $dbname);

		if (!$conexion) {
			die("Connection failed: " . mysqli_connect_error());
		}
		$resultado = mysqli_query($conexion, $insertar);

		if($resultado)
		{

			//$consulta = "SELECT ocupacion_id FROM h_ocupacion WHERE habitacion_id = $datos[0] AND estado = 'OCUPADO'";
			//$resultado2 = mysqli_query($conexion, $consulta);

			//$data [] = "Exito";
			while($row = mysqli_fetch_assoc($resultado))
				$data = $row;

			echo json_encode($data);
		}
		else
		{
			$data [] = "Error";
			$data [] = "La habitacion ya esta ocupada";
			echo json_encode($data);
		}

	}

	if(isset($_POST['ocupadas'])){

		$datos = $_POST['ocupadas'];

		$insertar  = "SELECT * FROM v_habitaciones_ocupadas";

		$conexion = mysqli_connect($servername,$username,$password, $dbname);

		if (!$conexion) {
			die("Connection failed: " . mysqli_connect_error());
		}
		$resultado = mysqli_query($conexion, $insertar);
		$datos = array();
		if($resultado)
		{
			while($row = mysqli_fetch_assoc($resultado))
				$data [] = $row;

			echo json_encode($data);
		}
		else{
			$data = "NO";
			echo json_encode($data);
		}

	}

	if(isset($_POST['placas'])){

		$conexion = mysqli_connect($servername,$username,$password, $dbname);

		$consulta = "SELECT * FROM i_placas";

		if (!$conexion) {
			die("Connection failed: " . mysqli_connect_error());
		}

		$resultado = mysqli_query($conexion, $consulta);
		$datos = array();

		while($row = mysqli_fetch_assoc($resultado)){

			$nom = (object)array('label'=>$row['no_placa']." [".$row['tipo_vehiculo']."]", 'value'=>$row['no_placa']." [".$row['tipo_vehiculo']."]", 'id'=>$row['placa_id']);
			//$nom = $row['no_placa']." [".$row['tipo_vehiculo']."]";
			$datos[] = $nom;
		}

		echo json_encode($datos);
	}

	//INSERTAR PLACA NUEVA
	if(isset($_POST['tipo_vehiculo'])){

		$tipo = $_POST['tipo_vehiculo'];
		$placa = $_POST['placa'];

		$insertar  = "CALL p_i_insertar_placa('$placa','$tipo')";

		$conexion = mysqli_connect($servername,$username,$password, $dbname);

		if (!$conexion) {
			die("Connection failed: " . mysqli_connect_error());
		}
		$resultado = mysqli_query($conexion, $insertar);

		if($resultado)
		{
			while($row = mysqli_fetch_assoc($resultado))
				$data = $row;

			echo json_encode($data);
		}
		else
		{
			$data [] = "ERROR";
			echo json_encode($data);
		}

	}

?>
