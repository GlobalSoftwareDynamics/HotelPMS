<?php
include('session.php');
if(isset($_SESSION['login'])){
	include('header.php');
	include('navbarRecepcion.php');
	?>

	<section class="container">
		<div class="row">
			<div class="col-6">
				<div class="card mb-3">
					<div class="card-header">
						<i class="fa fa-table"></i> Detalles del Huésped
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-6">
								<p><strong>Nombre:</strong> Juan Pérez Salinas</p>
								<p><strong>Teléfono:</strong> 975685485</p>
							</div>
							<div class="col-6">
								<p><strong>DNI:</strong> 29240383</p>
								<p><strong>Email:</strong> Juan.Perez@correo.com</p>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-12 text-center">
								<table class="table">
									<thead>
									<tr>
										<th>Nombres</th>
										<th>Fechas</th>
										<th>Noches</th>
										<th>Tipo</th>
										<th>Cargos</th>
									</tr>
									</thead>
									<tbody>
									<tr>
										<td>Juan Pérez</td>
										<td>03/03/2018</td>
										<td>4</td>
										<td>Adulto</td>
										<td>Sí</td>
									</tr>
									</tbody>
								</table>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-12 text-center">
								<h6><strong>Preferencias</strong></h6>
								<textarea class="form-control" rows="9" disabled>Tener barras de proteina en la habitación</textarea>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-6">
				<div class="card mb-3">
					<div class="card-header">
						<i class="fa fa-table"></i> Detalles Generales</div>
					<div class="card-body">
						<div class="row">
							<div class="col-6">
								<p class="text-center"><strong>Detalles de la Estadía</strong></p>
								<p><strong>Check-in:</strong> 03/03/2018</p>
								<p><strong>Duración:</strong> 4 Noches</p>
								<p><strong>Check-out:</strong> 07/03/2018</p>
								<hr>
								<p class="text-center"><strong>Detalles del Recojo</strong></p>
								<p><strong>Tipo:</strong> Aeropuerto</p>
								<p><strong>Fecha:</strong> 03/03/2018</p>
								<p><strong>Hora:</strong> 08:00pm</p>
							</div>
							<div class="col-6">
								<p class="text-center"><strong>Detalles del Pago</strong></p>
								<p><strong>Tarifa:</strong> S/. 180.00</p>
								<p><strong>Impuesto:</strong> S/. 32.40</p>
								<p><strong>Cargos Adicionales:</strong> S/. 50.00</p>
								<hr>
								<p><strong>Subtotal:</strong> S/. 262.40</p>
								<p><strong>Descuento:</strong> S/. 10.00</p>
								<hr>
								<p><strong>Total:</strong> S/. 252.40</p>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-12 text-center">
								<h6><strong>Tarifas/Paquetes</strong></h6>
								<table class="table">
									<thead>
									<tr>
										<th>Paquete/Tarifa</th>
										<th>Fecha</th>
										<th>Monto (S/.)</th>
										<th>Noches</th>
									</tr>
									</thead>
									<tbody>
									<tr>
										<td>Paquete Completo</td>
										<td>03/03/2018 - 07/03/2018</td>
										<td>300</td>
										<td>4</td>
									</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="card mb-3">
					<div class="card-header">
						<i class="fa fa-table"></i> Listado de Consumos
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
							<form method="post">
							<input type="submit" class="btn btn-sm btn-light" value="Check-Out" formaction="agenda.php">
							</form>
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

	<?php
	include('footer.php');
}
?>