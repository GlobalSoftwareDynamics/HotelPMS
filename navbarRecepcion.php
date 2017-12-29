<header class="container-fluid bg-light">
	<section class="container">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand" href="mainRecepcion.php"><img src="img/logoNavbar.png" height="60" width="auto" alt=""></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link" href="agenda.php">Agenda de Eventos</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Reportes
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="reporteEmpresas.php">Reporte de Empresas</a>
							<a class="dropdown-item" href="reporteGestion.php">Reporte de Gestión</a>
						</div>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Gestión de Información
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="gestionHabitaciones.php">Habitaciones</a>
                            <a class="dropdown-item" href="gestionTipoHabitaciones.php">Tipo de Habitaciones</a>
							<a class="dropdown-item" href="gestionPaquetes.php">Paquetes</a>
							<a class="dropdown-item" href="gestionTarifas.php">Tarifas</a>
							<a class="dropdown-item" href="gestionClientes.php">Clientes</a>
							<a class="dropdown-item" href="gestionEmpresas.php">Empresas</a>
							<a class="dropdown-item" href="gestionUsuarios.php">Usuarios</a>
						</div>
					</li>
				</ul>
				<form class="form-inline my-2 my-lg-0 ml-1" action="index.php" method="post">
					<button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Cerrar Sesión</button>
				</form>
			</div>
		</nav>
	</section>
</header>