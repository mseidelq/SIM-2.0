<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();
$servername = "localhost";
$username = "usuariosim";
$password = "";
$dbname = "sim";

	// FUNCION PARA BUSCAR EL USUARIO Y TRAER LA INFORMACION
	if(isset($_POST["usr"])){
    $usr = $_POST["usr"];
    $con = $_POST['contrasena'];
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

      if(!$datos){
        $datos = "El usuario no existe o la contrasena esta errada";
			}
			else{
				if($datos["estado"]!="ACTIVO"){
					$datos = "El usuario se encuentra en estado: ".$datos["estado"];
				}
				else{
					$_SESSION['cedula'] = $datos['cedula'];				$_SESSION['nombres'] = $datos['nombres'];				$_SESSION['apellidos'] = $datos['apellidos'];
					$_SESSION['telefono'] = $datos['telefono'];		$_SESSION['usuario_id'] = $datos['usuario_id'];	$_SESSION['usuario'] = $datos['usuario'];
					$_SESSION['email'] = $datos['email'];					$_SESSION['usuario_contra'] = $datos['usuario_contra'];
					$_SESSION['direccion'] = $datos['direccion'];		$_SESSION['foto'] = $datos['foto'];	$_SESSION['estado'] = $datos['estado'];
					$_SESSION['turno_activo'] = 0; $_SESSION['fecha_hora_inicio']=0;

					//header("Location: principal.php");
				}
			}
      echo json_encode($datos);
    }
    else{
      $datos = "error";
      echo json_encode($datos);
    }

  }
?>
