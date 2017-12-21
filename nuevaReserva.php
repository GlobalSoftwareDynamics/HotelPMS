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
						<div class="float-right">
							<button type="button" class="btn btn-sm btn-light" data-toggle="modal" data-target="#modalReserva">Nueva Reserva</button>
						</div>
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
						<div class="row">
							<div class="col-12 text-center">
								<button type="button" class="btn btn-sm btn-primary">Añadir / Editar Detalles</button>
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
										<th>Acciones</th>
									</tr>
									</thead>
								</table>
								<button class="btn btn-sm btn-primary">Añadir Huésped</button>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-12 text-center">
								<h6><strong>Preferencias</strong></h6>
								<textarea class="form-control"></textarea>
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
										<th>Monto</th>
										<th>Noches</th>
									</tr>
									</thead>
								</table>
								<button class="btn btn-sm btn-primary">Cambiar Tarifa/Paquete</button>
								<button class="btn btn-sm btn-primary">Agregar Descuento</button>
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