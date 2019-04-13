<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();
if(isset($_SESSION['cedula'])){
		$sesion = $_SESSION;
}
else {
	header('Location: ../index.php');
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SIM</title>
<!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
<script src="../js/jquery-1.11.3.min.js"></script>
<script src="../datatable/DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../priceformat/jquery.priceformat.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<link href="../datatable/DataTables-1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">

<!-- <link href="css/bootstrap.css" rel="stylesheet" type="text/css"> -->
<link href="../css/bootstrap-3.3.7.css" rel="stylesheet" type="text/css">
<link href="../css/csspropios.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../css/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="css/modal_control_habitacion.css">

</head>

<body style="padding-top: 60px">
<?php
include("menu.php");
include("modales/modales.php");
include("modales/modales_control_habitacion.php");

//include("phpFunciones/funciones.php");
	  //include("modales/modales.php");

?>

<div class="container" id="principal">

	<div class="col-lg-12 text-center alert-info" id="titulo">
		<h2 >CONTROL DE HABITACIONES</h1>
	</div>

  <div role="tabpanel">
	  <ul class="nav nav-tabs" role="tablist">
	    <li role="presentation" class="active"><a href="#habitaciones" data-toggle="tab" role="tab" aria-controls="tab1">Habitaciones</a></li>
	    <li role="presentation"><a href="#resumencaja" data-toggle="tab" role="tab" aria-controls="tab2">Resumen de caja</a></li>

	  </ul>
	  <div id="tabContent1" class="tab-content">
	    <div role="tabpanel" class="tab-pane fade in active" id="habitaciones">
	      	<ol class="breadcrumb">
				<li><a href="#">Inicio</a></li>
				<li class="active">Control Caja</li>
  			</ol>
      		<input type="text" id="codigobarras" hidden="true">
       		<div class="row">

				<div class="col-lg-12">
					<div class="panel panel-info">
					  <div class="panel-heading">OCUPACION HABITACIONES</div>
					  <div class="panel-body">

						<div style="width:100%">

							<div class="table-responsive">

								<table id="tabla_control_habitaciones" class="table-hover display table" style="width:100%" border>
									<thead class="bg-primary">
									<tr>
										<th style="width:5%">Hab</th>
										<th style="width:7%">Tipo</th>
										<th style="width:11%" colspan="2">Ingreso</th>
										<th style="width:11%" colspan="2">Salida</th>
										<th style="width:5%" >Faltante</th>
										<th style="width:5%" >H. Extra</th>
										<th style="width:5%" >Servicio</th>
										<!--<th >Vlr.Servicio</th>
										<th >Vlr.Extra</th>
										<th >Consumos</th>-->
										<th style="width:6%" >Valor Total</th>
										<th style="width:6%">Saldo</th>
										<th style="width:5%" >Placa</th>
										<th >Observaciones</th>
									</tr>
									</thead>

									<tbody>
									</tbody>

									<tfoot></tfoot>
								</table>

						  	</div>

						</div>

					</div>
				  </div>
				</div>

       		</div>

       		<audio id="15left">
       			<source src="/SIM 2.0/mp3/15left.mp3" type="audio/mp3" />
       		</audio>
       		<audio id="timeout">
       			<source src="/SIM 2.0/mp3/timeout.mp3" type="audio/mp3" />
       		</audio>
        </div>

        <div role="tabpanel" class="tab-pane fade" id="resumencaja">
	      	<ol class="breadcrumb">
				<li><a href="#">Inicio</a></li>
				<li class="active">Resumen de caja</li>
			</ol>
        </div>
    </div>
  </div>
</div>


<script src="../js/bootstrap-3.3.7.js"></script>
<script src="jquery/login.js"></script>

<script src="jquery/manejo_turnos.js"></script>
<script src="jquery/control_habitaciones.js"></script>
<script src="jquery/manejo_productos.js"></script>
<script src="jquery/pagos.js"></script>

<script type="text/javascript">
	// TRAE TODOS LOS DATOS DEL USUARIO Y LOS PONE EN LA VARIABLE usuario_jquery
	var usuario_jquery = <?php echo json_encode($sesion); ?>;
	var turno_usuario =  verficiar_Turnos();
	var turno_id;
	var ocupacion_id, pagos_realizados;
	var obj_admin_habitacion = new Admin_habitacion();
	//$('#modal_administrar_habitacion').modal({ backdrop: 'static', keyboard: false});

	var detectar="", sen=0;
	cargar_habitaciones();
	// DESPUES DE SELECCIONAR EL SERVICIO REQUERIDO SE DA CLICK EN OCUPAR



</script>




</body>
</html>
