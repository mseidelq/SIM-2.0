<!-- MODAL DE OCUPAR HABITACION -->

	<div class="modal fade fixed-top modalCrear" id="modal_ocupar_habitacion" role="dialog">
	<div class="modal-dialog">

	  <!-- Modal content-->
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <h4 class="modal-title" id="titulo_modal">Ocupar habitacion</h4>
		</div>
		<div class="modal-body">

			  <div class="form-group"  style="width:100%">
					<div class="col-lg-6 servicio">
						<label for="select_servicio">Que servicio deseas tomar ?</label>
						<select class="form-control" name="select_servicio" id="select_servicio" placeholder="Seleccione servicio" required>
				  	</select>
					</div>
					<div class="col-lg-6 servicio ui-front">
						<label for="placa">Placa vehiculo</label>
						<input class="form-control" id="placa" maxlength="6">
					</div>


			  </div>
				<div class="form-group"  style="width:100%" >
					<div class="col-lg-12 servicio">
						<label for="observaciones">Observaciones</label>
						<textarea  class="form-control" name="" value="" id="observaciones"></textarea>
					</div>
					<div class="servicio">
						<button type="button" id="btn_ocupar" class="btn btn-info servicio"  data-dismiss="modal">Ocupar habitacion</button>
					</div>

			  </div>

			<div class="alert alert-success hidden alertaCrear" role="alert" id=""></div>

		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		</div>

	  </div>

	</div>
	</div>


	<!-- MODAL DE AGREGAR ARTICULOS O FINALIZAR SERVICIO HABITACION -->

	<div class="modal fade bd-example-modal-lg" id="modal_administrar_habitacion" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg"  role="document">

	  <!-- Modal content-->
	  <div class="modal-content fixed-top" id="administrarHabitacion2">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <h4 class="modal-title" id="tituloModalAdmin">Administrar habitacion</h4>
		</div>
		<div class="modal-body">

			<div class="container-fluid">
				<div class="row">

					<div class="panel panel-info">
						  <div class="panel-heading">VENTA DE PRODUCTOS</div>
						  <div class="panel-body" >
							<div class="col-lg-12">
								<div class="col-lg-6 divmodal ui-front">
								  <label>Productos: </label>
								  <input id="productos" class="form-control ">
								</div>
								<div class="col-lg-2 divmodal">
								  <div class=""><label>Valor: </label></div>
								  <div id="valor_producto" class="moneda"></div>
								</div>
								<div class=" col-lg-2 divmodal">
								  <label for="cantidad_producto">Cant: </label><br>
								  <input type="number" id="cantidad_producto" maxlength="2" class="form-control ">
								</div>
								<div class="col-lg-2 divmodal">
								  <div class=""><label>Total: </label></div>
								  <div id="valor_total_producto" class="moneda"></div>
								</div>
							</div>
							<div class="col-lg-12"><hr></div>
							<div class="col-lg-12">
								<div class="table-responsive">

									<table id="tablaProductosAgregados" class="table-hover display table" style="width:100%" border>
										<thead class="bg-primary">
										<tr>

											<th >Producto</th>
											<th >Valor</th>
											<th >Cant</th>
											<th >Valor Total</th>
											<th >Acciones</th>
										</tr>
										</thead>

										<tbody>
										</tbody>

										<tfoot class="bg-success">
											<th colspan="3">
												Total consumos
											</th>
											<th><div id="vlrConsumo1" class="moneda"></div></th>
											<th>-----</th>
										</tfoot>
									</table>

						  		</div>
							</div>

					  </div>
					  <div class="panel-footer" >

					  </div>
					</div>
				</div>

				<div class="panel panel-info">
					<div class="panel-heading">TOTALES</div>
					<div class="panel-body" >
						<div class="col-lg-12">
							<div class="table-responsive">

								<table id="tablaResumenHabitacion" class="table-hover display table" style="width:100%" border>
									<thead class="bg-warning">
									<tr>
										<th >Vlr Servicio</th>
										<th >Vlr Extra</th>
										<th >Vlr Consumos</th>
										<th >Vlr Total</th>
										<th >Pagado</th>
										<th >Saldo</th>
									</tr>
									</thead>
									<tr>
										<td><div id="vlrServicio" class="moneda">0</div></td>
										<td><div id="vlrExtra" class="moneda">0</div></td>
										<td><div id="vlrConsumo2" class="moneda"></div></td>
										<td><div id="vlrTotal" class="moneda">0</div></td>
										<td><div id="vlrPagado" class="moneda">0</div></td>
										<td><div id="vlrSaldo" class="moneda">0</div></td>
									</tr>
									<tbody>
									</tbody>

								</table>

								</div>
						</div>
					</div>
				</div>

				<hr>
				<div class="form-group">
					<button type="button" id="" class="btn btn-info">Finalizar servicio</button>
					<button type="button" id="" class="btn btn-info">Realizar pago</button>
				</div>

				<div class="alert alert-success hidden alertaCrear" role="alert" id=""></div>
			</div>

		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		</div>

	  </div>

	</div>
	</div>
