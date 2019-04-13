<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();
$servername = "localhost";
$username = "usuariosim";
$password = "";
$dbname = "sim";
// INSERTA LOS CONSUMOS
if(isset($_POST['valor_pagando'])){

    $ocupacion = $_POST['ocupacion_id'];
    $turno = $_POST['turno'];
    $valor_pagando = $_POST['valor_pagando'];
    $medio = $_POST['medio'];
    $comprobante = $_POST['comprobante'];
    $conexion = mysqli_connect($servername,$username,$password, $dbname);

    $consulta = "CALL p_i_pagos($turno, $valor_pagando,$medio,'$comprobante',$ocupacion)";

    if (!$conexion) {
      die("Connection failed: " . mysqli_connect_error());
    }

    $resultado = mysqli_query($conexion, $consulta);
    //$datos = array();
    if($resultado)
    { while($row = mysqli_fetch_assoc($resultado))
        $datos = $row;
    }
    else {
      $datos = "No se agrego el pago";
    }

    echo json_encode($datos);
  }

  if(isset($_POST['medios_pago'])){

      $conexion = mysqli_connect($servername,$username,$password, $dbname);

      $consulta = "CALL p_s_medios_de_pago()";

      if (!$conexion) {
        die("Connection failed: " . mysqli_connect_error());
      }

      $resultado = mysqli_query($conexion, $consulta);
      $datos = array();

      while($row = mysqli_fetch_assoc($resultado))
        $datos[] = $row;

      echo json_encode($datos);
    }

    if(isset($_POST['traer_pagos'])){

        $ocupacion = $_POST['traer_pagos'];
        $conexion = mysqli_connect($servername,$username,$password, $dbname);

        $consulta = "CALL traer_pagos_ocupacion($ocupacion)";

        if (!$conexion) {
          die("Connection failed: " . mysqli_connect_error());
        }

        $resultado = mysqli_query($conexion, $consulta);
        $datos = array();

        while($row = mysqli_fetch_assoc($resultado))
          $datos[] = $row;

        echo json_encode($datos);
      }

  ?>
