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
					<div class="col-lg-6 servicio">
						<label for="placa">Placa vehiculo</label>
						<input class="form-control" type="text" name="" value="">
					</div>


			  </div>
				<div class="form-group"  style="width:100%" >
					<div class="col-lg-12 servicio">
						<label for="observaciones">Observaciones</label>
						<textarea  class="form-control" name="" value=""></textarea>
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
