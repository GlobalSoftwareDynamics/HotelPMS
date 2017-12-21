<?php
include('session.php');
if(isset($_SESSION['login'])){
	include('header.php');
	include('navbarRecepcion.php');
	?>

	<section class="container">
		<div class="row">
			<div class="col-4 mb-3">
				<div class="card text-white bg-card o-hidden h-100">
					<div class="card-body">
						<div class="card-body-icon">
							<i class="fa fa-fw fa-car"></i>
						</div>
						<div>11 Arribos</div>
					</div>
					<a class="card-footer text-white clearfix small z-1" href="#">
						<span class="float-left">Ver Listado</span>
						<span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
					</a>
				</div>
			</div>
			<div class="col-4 mb-3">
				<div class="card text-white bg-card o-hidden h-100">
					<div class="card-body">
						<div class="card-body-icon">
							<i class="fa fa-fw fa-tags"></i>
						</div>
						<div>13 Check-outs</div>
					</div>
					<a class="card-footer text-white clearfix small z-1" href="#">
						<span class="float-left">Ver Listado</span>
						<span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
					</a>
				</div>
			</div>
			<div class="col-4 mb-3">
				<div class="card text-white bg-card o-hidden h-100">
					<div class="card-body">
						<div class="card-body-icon">
							<i class="fa fa-fw fa-bed"></i>
						</div>
						<div>20 Habitaciones Ocupadas</div>
					</div>
					<a class="card-footer text-white clearfix small z-1" href="#">
						<span class="float-left">Ver Listado</span>
						<span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
					</a>
				</div>
			</div>
		</div>
		<div class="spacer20"></div>
		<div class="row">
			<div class="col-6">
				<div class="card mb-3">
					<div class="card-header">
						<i class="fa fa-table"></i> Reservas
						<div class="float-right">
							<button type="button" class="btn btn-sm btn-light" data-toggle="modal" data-target="#modalReserva">Nueva Reserva</button>
						</div>
					</div>
					<div class="card-body">
						<ul class="nav nav-tabs" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" data-toggle="tab" href="#arribos" role="tab">Arribos</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#checkout" role="tab">Check-outs</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#sobrestadia" role="tab">Sobrestadía</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#huespedes" role="tab">Huespedes Alojados</a>
							</li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="arribos" role="tabpanel">
								<ul class="nav nav-tabs" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" data-toggle="tab" href="#hoy" role="tab">Hoy</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#manana" role="tab">Mañana</a>
									</li>
								</ul>
								<div class="spacer10"></div>
								<div class="tab-content">
									<div class="tab-pane active" id="hoy" role="tabpanel">
										<table class="table">
											<thead>
											<tr>
												<th>Huésped</th>
												<th>ID Reserva</th>
												<th>Habitación</th>
												<th>Estado</th>
												<th>Acciones</th>
											</tr>
											</thead>
										</table>
									</div>
									<div class="tab-pane" id="manana" role="tabpanel">
										<table class="table">
											<thead>
											<tr>
												<th>Huésped</th>
												<th>ID Reserva</th>
												<th>Habitación</th>
												<th>Estado</th>
												<th>Acciones</th>
											</tr>
											</thead>
										</table>
									</div>
								</div>
							</div>
							<div class="tab-pane" id="checkout" role="tabpanel">
								<ul class="nav nav-tabs" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" data-toggle="tab" href="#hoy2" role="tab">Hoy</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#manana2" role="tab">Mañana</a>
									</li>
								</ul>
								<div class="spacer10"></div>
								<div class="tab-content">
									<div class="tab-pane active" id="hoy2" role="tabpanel">
										<table class="table">
											<thead>
											<tr>
												<th>Huésped</th>
												<th>ID Reserva</th>
												<th>Habitación</th>
												<th>Estado</th>
												<th>Acciones</th>
											</tr>
											</thead>
										</table>
									</div>
									<div class="tab-pane" id="manana2" role="tabpanel">
										<table class="table">
											<thead>
											<tr>
												<th>Huésped</th>
												<th>ID Reserva</th>
												<th>Habitación</th>
												<th>Estado</th>
												<th>Acciones</th>
											</tr>
											</thead>
										</table>
									</div>
								</div>
							</div>
							<div class="tab-pane" id="sobrestadia" role="tabpanel">
								<ul class="nav nav-tabs" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" data-toggle="tab" href="#hoy3" role="tab">Hoy</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#manana3" role="tab">Mañana</a>
									</li>
								</ul>
								<div class="spacer10"></div>
								<div class="tab-content">
									<div class="tab-pane active" id="hoy3" role="tabpanel">
										<table class="table">
											<thead>
											<tr>
												<th>Huésped</th>
												<th>ID Reserva</th>
												<th>Habitación</th>
												<th>Estado</th>
												<th>Acciones</th>
											</tr>
											</thead>
										</table>
									</div>
									<div class="tab-pane" id="manana3" role="tabpanel">
										<table class="table">
											<thead>
											<tr>
												<th>Huésped</th>
												<th>ID Reserva</th>
												<th>Habitación</th>
												<th>Estado</th>
												<th>Acciones</th>
											</tr>
											</thead>
										</table>
									</div>
								</div>
							</div>
							<div class="tab-pane" id="huespedes" role="tabpanel">
								<ul class="nav nav-tabs" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" data-toggle="tab" href="#hoy4" role="tab">Hoy</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#manana4" role="tab">Mañana</a>
									</li>
								</ul>
								<div class="spacer10"></div>
								<div class="tab-content">
									<div class="tab-pane active" id="hoy4" role="tabpanel">
										<table class="table">
											<thead>
											<tr>
												<th>Huésped</th>
												<th>ID Reserva</th>
												<th>Habitación</th>
												<th>Estado</th>
												<th>Acciones</th>
											</tr>
											</thead>
										</table>
									</div>
									<div class="tab-pane" id="manana4" role="tabpanel">
										<table class="table">
											<thead>
											<tr>
												<th>Huésped</th>
												<th>ID Reserva</th>
												<th>Habitación</th>
												<th>Estado</th>
												<th>Acciones</th>
											</tr>
											</thead>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-6">
				<div class="card mb-3">
					<div class="card-header">
						<i class="fa fa-table"></i> Actividad del día</div>
					<div class="card-body">
						<ul class="nav nav-tabs" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" data-toggle="tab" href="#checkin" role="tab">Check-In</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#checkout2" role="tab">Check-out</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#consumos" role="tab">Consumos</a>
							</li>
						</ul>
						<div class="spacer10"></div>
						<div class="tab-content">
							<div class="tab-pane active" id="checkin" role="tabpanel">
								<table class="table">
									<thead>
									<tr>
										<th>Huésped</th>
										<th>ID Reserva</th>
										<th>Habitación</th>
										<th>Hora</th>
										<th>Acciones</th>
									</tr>
									</thead>
								</table>
							</div>
							<div class="tab-pane" id="checkout2" role="tabpanel">
								<table class="table">
									<thead>
									<tr>
										<th>Huésped</th>
										<th>ID Reserva</th>
										<th>Habitación</th>
										<th>Hora</th>
										<th>Acciones</th>
									</tr>
									</thead>
								</table>
							</div>
							<div class="tab-pane" id="consumos" role="tabpanel">
								<table class="table">
									<thead>
									<tr>
										<th>Huésped</th>
										<th>ID Reserva</th>
										<th>Habitación</th>
										<th>Monto</th>
										<th>Detalle</th>
									</tr>
									</thead>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<form method="post" action="nuevaReserva.php">
		<div class="modal fade" id="modalReserva" tabindex="-1" role="dialog" aria-labelledby="modalReserva" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Nueva Reserva</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="container-fluid">
							<div class="form-group row">
								<label class="col-form-label" for="ruc">DNI:</label>
								<input type="text" name="ruc" id="ruc" class="form-control">
							</div>
							<div class="form-group row">
								<label class="col-form-label" for="razonSocial">Razón Social:</label>
								<input type="text" name="razonSocial" id="razonSocial" class="form-control">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary" form="formProducto" value="Submit" name="addCliente">Guardar Cambios</button>
					</div>
				</div>
			</div>
		</div>
	</form>

	<?php
	include('footer.php');
}
?>