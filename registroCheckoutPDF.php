<?php
include('session.php');
include('declaracionFechas.php');
include ('funciones.php');
require_once __DIR__ . '/lib/mpdf/mpdf.php';

if(isset($_SESSION['login'])){

    $duracionPaquete = 0;
    $valorPaquete = 0;
    $result = mysqli_query($link,"SELECT * FROM Reserva WHERE idReserva = '{$_POST['idReserva']}'");
    while ($fila = mysqli_fetch_array($result)){
        $result1 = mysqli_query($link,"SELECT * FROM HabitacionReservada WHERE idReserva = '{$_POST['idReserva']}' AND idHabitacion = '{$_POST['idHabitacion']}'");
        while ($fila1 = mysqli_fetch_array($result1)){
            $fechaCheckIn = $fila1['fechaInicio'];
            $fechaCheckOut = $fila1['fechaFin'];
        }
        $result1 =  mysqli_query($link,"SELECT * FROM ReservaPaquete WHERE idReserva = '{$_POST['idReserva']}'");
        $numrow = mysqli_num_rows($result1);
        if ($numrow == 0){

        }else{
            while ($fila1 =  mysqli_fetch_array($result1)){
                $result2 = mysqli_query($link,"SELECT * FROM Paquete WHERE idPaquete = '{$fila1['idPaquete']}'");
                while ($fila2 = mysqli_fetch_array($result2)){
                    $duracionPaquete = $fila2['duracion'];
                    $valorPaquete = $fila2['valor'];
                    $totalhabitaciones = 0;
                    $result3 = mysqli_query($link,"SELECT * FROM TipoHabitacionPaquete WHERE idPaquete = '{$fila2['idPaquete']}'");
                    $numFilas = mysqli_num_rows($result3);
                    if($numFilas == 0){
                        $totalhabitaciones = 0;
                    }else{
                        while ($fila3 = mysqli_fetch_array($result1)){
                            $result4 = mysqli_query($link,"SELECT * FROM Tarifa WHERE idTarifa = '{$fila3['idTarifa']}'");
                            while ($fila4 = mysqli_fetch_array($result4)){
                                $valorTarifa = $fila4['valor'];
                            }

                            $valorHabitacion  = $fila3['nroHabitaciones'] * $valorTarifa;
                            $totalhabitaciones = $totalhabitaciones + $valorHabitacion;

                        }
                    }

                    $totalpaquete = ($totalhabitaciones * $fila2['duracion']) + $fila2['valor'];
                }
            }
        }
        $result1 = mysqli_query($link,"SELECT * FROM Ocupantes WHERE idReserva = '{$_POST['idReserva']}' AND idHabitacion = '{$_POST['idHabitacion']}' AND cargos = 1");
        while ($fila1 = mysqli_fetch_array($result1)){
            $result2 = mysqli_query($link,"SELECT * FROM Huesped WHERE idHuesped = '{$fila1['idHuesped']}'");
            while ($fila2 = mysqli_fetch_array($result2)){
                $nombreCompleto = $fila2['nombreCompleto'];
                $idHuespedCargos = $fila2['idHuesped'];
                $result3 = mysqli_query($link,"SELECT * FROM Empresa WHERE idEmpresa = '{$fila2['idEmpresa']}'");
                while ($fila3 = mysqli_fetch_array($result3)){
                    $nombreEmpresa = $fila3['razonSocial'];
                }
            }
        }
    }
    ?>

    <?php
    $html .='
            <html lang="es">
                <head>
                    <meta charset="utf-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1">    
                    <title>Listado de Desayunos</title>
                    <link href="css/bootstrap.css" rel="stylesheet">
                    <link href="css/Formatospdf.css" rel="stylesheet">
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
                </head>
                <body class="portrait">
    ';

    $html .='
        <section class="container">
            <div class="row">
                <div class="col-12 bordes">
                    <h6>Datos de Reserva</h6>
                </div>
                <div class="col-12 bordeslados">
                    <div class="col-6">
                         <div class="row">
                            <div class="col-5"><p><b>Reserva:</b></p></div>
                            <div class="col-7"><p>'.$_POST['idReserva'].'</p></div>
                         </div>
                         <div class="row">
                             <div class="col-5"><p><b>Habitación:</b></p></div>
                             <div class="col-7"><p>'.$_POST['idHabitacion'].'</p></div>
                         </div>
                         <div class="row">
                             <div class="col-5"><p><b>Huesped Titular:</b></p></div>
                             <div class="col-7"><p>'.$nombreCompleto.'</p></div>
                         </div>
                         <div class="row">
                             <div class="col-5"><p><b>Empresa:</b></p></div>
                             <div class="col-7"><p>'.$nombreEmpresa.'</p></div>
                         </div>
                    </div>
                    <div class="col-6">
                         <div class="row">
                             <div class="col-5"><p><b>Check In:</b></p></div>
                             <div class="col-7"><p>'.$fechaCheckIn.'</p></div>
                         </div>
                         <div class="row">
                             <div class="col-5"><p><b>Check Out:</b></p></div>
                             <div class="col-7"><p>'.$fechaCheckOut.'</p></div>
                         </div>
                    </div>
</div>
</div>
</section>
    ';

    $html .='
        </body>
    </html>
    ';

    $htmlheader='
        <header>
            <div id="descripcionbrand">
                <img style="margin-top: 10px" width="auto" height="60" src="img/logoNavbar.png"/>
            </div>
            <div id="tituloreporte">
                <h4>Registro de CheckOut</h4>
            </div>
        </header>
    ';
    $htmlfooter='
          <div class="footer">
                <span style="font-size: 10px;">Hotel PMS </span>
                                   
                                 
                              
                <span style="font-size: 10px">© 2017 by Global Software Dynamics.Visítanos en <a target="GSD" href="http://www.gsdynamics.com/">GSDynamics.com</a></span>
          </div>
    ';
    $nombredearchivo = 'ListadoDesayunos'.$date.'.pdf';
    $mpdf = new mPDF('','A4',0,'','15',15,35,35,6,6);

// Write some HTML code:
    $mpdf->SetHTMLHeader($htmlheader);
    $mpdf->SetHTMLFooter($htmlfooter);
    $mpdf->WriteHTML($html);

// Output a PDF file directly to the browser
    $mpdf->Output($nombredearchivo,'D');
    ?>

    <?php
}else{
    echo "Usted no está autorizado para ingresar a esta sección. Por favor vuelva a la página de inicio de sesión e identifíquese.";
}
?>