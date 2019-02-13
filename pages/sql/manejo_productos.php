<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();
$servername = "localhost";
$username = "usuariosim";
$password = "";
$dbname = "sim";

if(isset($_POST['trae_productos'])){
		$conexion = mysqli_connect($servername,$username,$password, $dbname);

		$consulta = "SELECT * FROM v_lista_productos";

		if (!$conexion) {
			die("Connection failed: " . mysqli_connect_error());
		}

		$resultado = mysqli_query($conexion, $consulta);
		$datos = array();

		while($row = mysqli_fetch_assoc($resultado)){

			$nom = (object)array('label'=>$row['nombre_producto']." [".$row['marca']."]", 'value'=>$row['nombre_producto']." [".$row['marca']."]", 'id'=>$row['producto_id']);
			//$nom = $row['no_placa']." [".$row['tipo_vehiculo']."]";
			$datos[] = $nom;
		}

		echo json_encode($datos);
}

if(isset($_GET['producto_id']) || isset($_GET['producto_cb'])){

		//$producto = $_GET['productoId'];
		$conexion = mysqli_connect($servername,$username,$password, $dbname);


		if(isset($_GET['producto_id'])){
			$producto = $_GET['producto_id'];
			$consulta = "SELECT * FROM v_lista_productos WHERE producto_id = $producto";
		}
		else{
			$producto = $_GET['producto_cb'];
			$consulta = "SELECT * FROM v_lista_productos WHERE codigo_barras = '$producto'";
		}

		if (!$conexion) {
			die("Connection failed: " . mysqli_connect_error());
		}

		$resultado = mysqli_query($conexion, $consulta);
		$datos = array();

		while($row = mysqli_fetch_assoc($resultado))
			$datos = $row;

		echo json_encode($datos);
	}

?>
