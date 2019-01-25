<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();
$servername = "localhost";
$username = "usuariosim";
$password = "";
$dbname = "sim";

//EMPEZAR TURNO
if(isset($_POST["iniciar_turno"])){
  $usuario_id = $_SESSION['usuario_id'];
  $conexion = mysqli_connect($servername,$username,$password, $dbname);
  $comando = "CALL p_i_inicar_turno($usuario_id)";

  if (!$conexion) {
    die("Connection failed: " . mysqli_connect_error());
  }
  else{
    // RESULTADO DEL COMANDO
    $resultado = mysqli_query($conexion, $comando);
    $datos = array();

    if($resultado)
    {
      while($row = mysqli_fetch_assoc($resultado))
         $datos = $row;

      if(!$datos){
        $datos = "NO";
      }
      else{
        $_SESSION['turno_activo'] = $datos['turno_id'];
        $_SESSION['fecha_hora_inicio'] = $datos['fecha_inicio'];
      }
      echo json_encode($datos);
    }
    else{
      $datos = "error";
      echo json_encode($datos);
    }
    mysqli_close($conexion);
  }
}

// CONSULTAR TURNOS
if(isset($_POST["turnos"])){
  $usuario_id = $_SESSION['usuario_id'];
  $conexion = mysqli_connect($servername,$username,$password, $dbname);
  $comando = "CALL p_s_consultar_turnos($usuario_id)";
  //REVISA SI LA CONEXION FUE EXITOSA
  if (!$conexion) {
    die("Connection failed: " . mysqli_connect_error());
  }
  else{
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
      else{
        $_SESSION['turno_activo'] = $datos['turno_id'];
        $_SESSION['fecha_hora_inicio'] = $datos['fecha_inicio'];
      }
      echo json_encode($datos);
    }
    else{
      $datos = "error";
      echo json_encode($datos);
    }
    mysqli_close($conexion);
  }
}

?>
