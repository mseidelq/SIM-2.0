<!-- MODAL DE OCUPAR HABITACION -->

	<div class="modal fade fixed-top modalCrear" id="modal_ocupar_habitacion" role="dialog">
	<div class="modal-dialog">

	  <!-- Modal content-->
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <h4 class="modal-title" id="tituloModal">Ocupar habitacion</h4>
		</div>
		<div class="modal-body">

			  <div class="form-group">
				<label for="select_servicio">Que servicio deseas tomar ?</label>
				<select class="form-control" name="select_servicio" id="select_servicio" placeholder="Seleccione servicio" required>
			  </select>

			  </div>

			  <div class="form-group">
				<button type="button" id="btn_ocupar" class="btn btn-info"  data-dismiss="modal">Ocupar habitacion</button>
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
