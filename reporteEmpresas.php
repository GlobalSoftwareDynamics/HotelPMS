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
						<i class="fa fa-table"></i> Reporte de Empresas

					</div>
					<div class="card-body">

					</div>
				</div>
			</div>
		</div>
	</section>

	<?php
	include('footer.php');
}
?>