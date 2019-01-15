<?php
$servername = "localhost";
$username = "usuariosim";
$password = "";
$dbname = "sim";

	// FUNCION PARA BUSCAR EL USUARIO Y TRAER LA INFORMACION
	if(isset($_GET["usr"])){
    $usr = $_GET["usr"];
    $con = $_GET['contrasena'];
    // CONEXION Y COMANDO
    $conexion = mysqli_connect($servername,$username,$password, $dbname);
    $comando = "CALL p_s_consultar_usuarios('$usr','$con')";
    //REVISA SI LA CONEXION FUE EXITOSA
    if (!$conexion) {
			die("Connection failed: " . mysqli_connect_error());
		}
    // RESULTADO DEL COMANDO
		$resultado = mysqli_query($conexion, $comando);
    $datos = array();

    if($resultado)
    {
		  while($row = mysqli_fetch_assoc($resultado))
			   $datos = $row;

      if(!$datos)
        $datos = "Error: El usuario no existe o la contrasena esta errada";
      echo json_encode($datos);
    }
    else{
      $datos = "error";
      echo json_encode($datos);
    }

  }
?>
