<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/functions.js"></script>

<script>
    $('#modalHabitacion').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var idHabitacion = button.data('habitacion');
        var idHabitacionReservada = button.data('habitacionreservada');
        var idReserva = button.data('reserva');
        var preferencias = button.data('preferencias'); // Extract info from data-* attributes
        var checkinedit = button.data('checkinedit');
        var checkoutedit = button.data('checkoutedit');
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);
        modal.find('.checkinedit').val(checkinedit);
        modal.find('.checkoutedit').val(checkoutedit);
        modal.find('.preferencias').val(preferencias);
        modal.find('.idHabitacion').val(idHabitacion);
        modal.find('.idHabitacionReservada').val(idHabitacionReservada);
        modal.find('.idReserva').val(idReserva);
    })
</script>

<footer class="footer navbar-light bg-faded" style="padding: 10px 0px;">
	<div class="container col-sm-6 col-sm-offset-3 text-center">
		<span>© 2017 by Global Software Dynamics. Visítanos en <a target="GSD" href="http://www.gsdynamics.com/">GSDynamics.com</a></span>
	</div>
</footer>

</body>
</html>
