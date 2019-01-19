	<!-- MODAL INICAR TURNO-->

	<div class="modal fade fixed-top" id="modalIniciarTurno" role="dialog">
		<div class="modal-dialog">

	  <!-- Modal content-->
		  <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title">Iniciar Turno</h4>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<div class="row">

							<div class="panel panel-info">
								  <div class="panel-heading">TURNOS INICIADOS</div>
								  <div class="panel-body" >

									<div class="col-lg-12">
										<div class="table-responsive">

											<table id="tablaTurnosAbiertos" class="table-hover display table" style="width:100%" border>
												<thead class="bg-primary">
												<tr>
													<th >Fecha</th>
													<th >Hora</th>
													<th >Accion</th>
												</tr>
												</thead>

												<tbody>
												</tbody>

												<tfoot class="bg-success">

												</tfoot>
											</table>

								  		</div>
									</div>

							  </div>
							  <div class="panel-footer" >

							  </div>
							</div>
						</div>

						<!-- INICIAR TURNO -->
						<div class="row">

							<div class="panel panel-info">
								  <div class="panel-heading">INICIAR TURNO</div>
								  <div class="panel-body" >

									<div class="col-lg-12">
										<div class="table-responsive">
													<label>Deseas iniciar Turno de caja: </label>
													<button type="button" id="btn_IniciarTurno" class="btn btn-info block">Si</button>
													<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
								  	</div>
									</div>

							  </div>
							  <div class="panel-footer" >

							  </div>
							</div>
						</div>

			  </div>

			</div>
		</div>
	</div>
</div>
