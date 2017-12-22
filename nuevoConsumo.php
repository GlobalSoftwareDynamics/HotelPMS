<?php
include('session.php');
if(isset($_SESSION['login'])){
	include('header.php');
	include('navbarRecepcion.php');
	?>

	<section class="container">
		<div class="row">
			<div class="col-12">
				<div class="card mb-3">
					<div class="card-header">
						<i class="fa fa-table"></i> Listado de Consumos
						<div class="float-right">
							<form method="post">
								<button type="button" class="btn btn-sm btn-light" data-toggle="modal" data-target="#modalConsumo">Nuevo Consumo</button>
							</form>
						</div>
					</div>
					<div class="card-body">
						<table class="table">
							<thead>
							<tr>
								<th>Fecha y Hora</th>
								<th>Descripción</th>
								<th># Folio</th>
								<th>Descuento</th>
								<th>Monto (Incl. tax)</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td>07/03/2018 08:17pm</td>
								<td>Consumo de Minibar - Cerveza Cusqueña 330ml</td>
								<td>33082</td>
								<td>-</td>
								<td>S/. 6.00</td>
							</tr>
							<tr>
								<td colspan="4" class="text-center"><strong>Totales</strong></td>
								<td>S/. 6.00</td>
							</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-4 offset-8">
				<div class="card mb-3">
					<div class="card-header">
						<i class="fa fa-dollar"></i> Balance
						<div class="float-right">

						</div>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-7">
								<p><strong>Total de Reserva incl. Tax</strong></p>
							</div>
							<div class="col-5">
								<p>S/. 262.40</p>
							</div>
						</div>
						<div class="row">
							<div class="col-7">
								<p><strong>Otros Cargos incl. Tax</strong></p>
							</div>
							<div class="col-5">
								<p>S/. 6</p>
							</div>
						</div>
						<div class="row">
							<div class="col-7">
								<p><strong>Total Descuentos</strong></p>
							</div>
							<div class="col-5">
								<p>S/. 10.00</p>
							</div>
						</div>
						<div class="col-12">
							<hr>
						</div>
						<div class="row">
							<div class="col-7">
								<p><strong>Total</strong></p>
							</div>
							<div class="col-5">
								<p>S/. 258.40</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<form method="post" action="#">
		<div class="modal fade" id="modalConsumo" tabindex="-1" role="dialog" aria-labelledby="modalConsumo" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Nuevo Consumo</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="container-fluid">
							<div class="form-group row">
								<label class="col-form-label" for="folio"># Folio:</label>
								<input type="text" class="form-control" name="folio" id="folio">
							</div>
							<div class="form-group row">
								<label class="col-form-label" for="descripcion">Descripcion:</label>
								<input type="text" class="form-control" name="descripcion" id="descripcion">
							</div>
							<div class="form-group row">
								<label class="col-form-label" for="descuento">Descuento:</label>
								<input type="number" step="0.01" class="form-control" name="descuento" id="descuento">
							</div>
							<div class="form-group row">
								<label class="col-form-label" for="monto">Monto:</label>
								<input type="number" step="0.01" class="form-control" name="monto" id="monto">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-secondary" data-dismiss="modal" value="Cerrar">
						<input type="submit" class="btn btn-primary" name="addReserva" value="Guardar Cambios">
					</div>
				</div>
			</div>
		</div>
	</form>

	<?php
	include('footer.php');
}
?>