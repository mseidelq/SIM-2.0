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

	<div class="modal fade bd-example-modal-lg" id="modal_administrar_habitacion" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-keyboard=false data-backdrop=static >
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

								<div class="col-lg-12 panel_productos" id="">
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
								<div class="col-lg-12 panel_productos">
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
												<th><div id="vlrConsumos" class="moneda"></div></th>
												<th>-----</th>
											</tfoot>
										</table>

							  		</div>
								</div>

								<div class="col-lg-12">
									<div class="table-responsive">

										<table id="tablaResumenHabitacion" class="table-hover display table" style="width:100%" border>
											<thead>
											<tr>
												<th class="bg-info" width="14%">Vlr Servicio</th>
												<th class="bg-info" width="14%">Vlr H. Extra</th>
												<th class="bg-info" width="14%">Vlr Productos</th>
												<th class="bg-info" width="14%">Vlr P. adicional</th>
												<th class="bg-primary" width="16%">Valor Total</th>
												<th class="bg-success" width="14%">Pagado</th>
												<th class="bg-danger"  width="14%">Saldo</th>
											</tr>
											</thead>
											<tr>
												<td><div id="vlrServicio" class="moneda">0</div></td>
												<td><div id="vlrExtra" class="moneda">0</div></td>
												<td><div id="vlrProductos" class="moneda">0</div></td>
												<td><div id="vlrPadicional" class="moneda"></div></td>
												<td><div id="vlrTotal" class="moneda">0</div></td>
												<td><div id="vlrPagado" class="moneda">0</div></td>
												<td><a><div id="vlrSaldo" class="moneda">0</div></a></td>
											</tr>
											<tr>
												<td>
													<div class="servicio ui-front">
														<input class="form-control" id="placa2" maxlength="6">
													</div>
												</td>
												<td colspan="7"><textarea  class="form-control" name="" value="" id="observaciones2"></textarea></td>
											</tr>
											<tbody>
											</tbody>

										</table>

										</div>
								</div>
								<!-- DIV PARA REALIZAR PAGO
								<div class="col-lg-12" style="display:none" id="panel_pagos">
								-->
								<div class="col-lg-12 padding-costados-0" style="display:none" id="panel_pagos">
									<div class="col-lg-7 padding-costados-0">
										<div class="col-lg-6 divmodal">
										  <div class=""><label>Valor a pagar: </label></div>
										  <div id="valor_a_pagar" class="moneda form-control "></div>
										</div>
										<div class="col-lg-6 divmodal">
										  <div class=""><label>Faltante: </label></div>
										  <div id="faltante_x_pagar" class="moneda form-control "></div>
										</div>
										<div class="col-lg-12">
											<hr>
										</div>
										<div class="col-lg-5 divmodal">
										  <div class=""><label>Tarjeta: </label></div>
											<select class="form-control" name="select_medio" id="select_medio" placeholder="Seleccione medio" required>
											</select>
										</div>
										<div class="col-lg-4 divmodal">
										  <div class=""><label>Valor a pagar: </label></div>
										  <input id="valor_pagando" class="moneda form-control " value="0">
										</div>
										<div class="col-lg-3 divmodal" id="comprobante" style="display:none">
										  <div class=""><label>No. Comp: </label></div>
											<input id="numero_comprobante" class="form-control ">
										</div>
										<div class="divmodal col-lg-6">
											<button type="button" id="ingresa_pago" class="btn btn-info btn-formulario" style="width:100%">Realizar pago</button>
										</div>
										<div class="divmodal col-lg-6">
											<button type="button" id="cancela_pago" class="btn btn-danger btn-formulario" style="width:100%">Cancelar</button>
										</div>
										<div class="col-lg-12 divmodal margin-top-5">
												<div class="alert alert-danger" hidden role="alert" id="error_pago"></div>
										</div>

									</div>

									<div class="table-responsive col-lg-5">

										<table id="tabla_pagos_realizados" class="table-hover display table" style="width:100%; font-size:11px;" border>
											<thead class="bg-primary">
											<tr>

												<th width="25%">Pagado</th>
												<th width="45%">Hora</th>
												<th width="30%">Medio</th>
											</tr>
											</thead>

											<tbody>
											</tbody>

											<tfoot class="bg-success">
												<th><div id="total_pagado" class="moneda">0</div>
												</th>
												<th></th>
												<th></th>

											</tfoot>
										</table>

									</div>

								</div>

					  </div>

					</div>
				</div>

				<hr>
				<div class="form-group">
					<button type="button" id="" class="btn btn-info hidden">Finalizar servicio</button>
					<button type="button" id="realizar_pago" class="btn btn-info">Realizar pago</button>
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
