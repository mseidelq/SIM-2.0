<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();
$servername = "localhost";
$username = "usuariosim";
$password = "";
$dbname = "sim";


if(isset($_GET["turnos"])){
  $usuario_id = $_SESSION['usuario_id'];
  $conexion = mysqli_connect($servername,$username,$password, $dbname);
  $comando = "CALL p_s_consultar_turnos($usuario_id)";
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
       $datos [] = $row;

    if(!$datos){
      $datos = "NO";
    }
    echo json_encode($datos);
  }
  else{
    $datos = "error";
    echo json_encode($datos);
  }
}
?>
