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
                    $paquete = $fila2['descripcion'];
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
                    <title>Registro de Check Out</title>
                    <link href="css/bootstrap.css" rel="stylesheet">
                    <link href="css/Formatospdf.css" rel="stylesheet">
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
                </head>
                <body class="portrait">
    ';

    $html .='
        <section class="container">
            <div class="row" style="border-bottom: 1px solid black">
                <div class="col-12 bordes">
                    <h6 style="padding-top: 10px">Datos de Reserva</h6>
                </div>
                <div class="col-12 bordeslados">
                    <div class="spacer10"></div>
                    <div style="font-size: 12px">
                         <div><p style="margin-bottom: 0;"><span style="font-weight: bold">Reserva:</span> '.$_POST['idReserva'].'</p></div>
                         <div><p style="margin-bottom: 0;"><span style="font-weight: bold">Habitación:</span> '.$_POST['idHabitacion'].'</p></div>
                         <div><p style="margin-bottom: 0;"><span style="font-weight: bold">Paquete:</span> '.$paquete.'</p></div>
                         <div><p style="margin-bottom: 0;"><span style="font-weight: bold">Huesped Titular: </span>'.$nombreCompleto.'</p></div>
                         <div><p style="margin-bottom: 0;"><span style="font-weight: bold">Empresa:</span> '.$nombreEmpresa.'</p></div>
                         <div><p style="margin-bottom: 0;"><span style="font-weight: bold">Check In:</span> '.$fechaCheckIn.'</p></div>
                         <div><p style="margin-bottom: 0;"><span style="font-weight: bold">Check Out:</span> '.$fechaCheckOut.'</p></div>
                    </div>
                    <div class="spacer10"></div>
                </div>
            </div>
            <div class="spacer10"></div>
            <div class="row">
                <h6 style="font-weight: bold; padding-left: 5px;">Resumen de Consumos:</h6>
            </div>
            <div class="spacer10"></div>
            <div class="row" style="border-bottom: 1px solid black">
                <div class="col-12 bordes">
                    <h6 style="padding-top: 10px">Hospedaje</h6>
                </div>
                <div class="col-12 bordeslados">
                <div class="spacer10"></div>
                    <table class="tabla">
                        <thead>
                            <tr class="trborder">
                                <th>Nro. Noches</th>
                                <th>Tipo Habitación</th>
                                <th>Tarifa</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
    ';
    $totalhabitaciones = 0;
    $subtotal = 0;
    $impestos = 0;
    $totalEstadia = 0;
    $cargoExtra = 0;
    $result = mysqli_query($link,"SELECT * FROM HabitacionReservada WHERE idReserva = '{$_POST['idReserva']}' AND idHabitacion = '{$_POST['idHabitacion']}'");
    while ($fila = mysqli_fetch_array($result)){
        $result1 = mysqli_query($link,"SELECT * FROM TipoHabitacion WHERE idTipoHabitacion IN (SELECT idTipoHabitacion FROM Habitacion WHERE idHabitacion = '{$_POST['idHabitacion']}')");
        while ($fila1 = mysqli_fetch_array($result1)){
            $tipoHabitacion = $fila1['descripcion'];
        }
        $fechaInicio = explode(" ",$fila['fechaInicio']);
        $fechaInicio = explode("-",$fechaInicio[0]);
        $date1 = date_create("{$fechaInicio[0]}-{$fechaInicio[1]}-{$fechaInicio[2]}");
        $fechaFin = explode(" ",date("Y-m-d H:m:s"));
        $fechaFinHora = $fechaFin[1];
        $fechaFin = explode("-",$fechaFin[0]);
        $date2 = date_create("{$fechaFin[0]}-{$fechaFin[1]}-{$fechaFin[2]}");
        $interval = date_diff($date1,$date2);
        $interval = $interval->d;
        if($date1 == $date2){
            $interval = $interval +1;
        }
        $result1 = mysqli_query($link,"SELECT * FROM Tarifa WHERE idTarifa = '{$fila['idTarifa']}'");
        while ($fila1 = mysqli_fetch_array($result1)){
            $valorTarifa = $fila1['valor'];
            $moneda = $fila1['moneda'];
        }
        $lateCheckOutTime = date("12:00:00");
        if ($fechaFinHora > $lateCheckOutTime || $fila['modificadorCheckIO'] == 2 || $fila['modificadorCheckIO'] == 1){
            $cargoExtra = $valorTarifa / 2;
        }elseif ($fila['modificadorCheckIO'] == 3){
            $cargoExtra = $valorTarifa;
        }
        $totalhabitaciones = $valorTarifa * $interval;
    }
    $totalhabitaciones = $totalhabitaciones + $valorPaquete;

    $html .= "<tr>";
    $html .= "<td>{$interval}</td>";
    $html .= "<td>{$tipoHabitacion}</td>";
    $html .= "<td>{$moneda} {$valorTarifa}</td>";
    $html .= "<td>{$moneda} {$totalhabitaciones}</td>";
    $html .= "</tr>";

    $html .= "
                        </tbody>
                    </table>
                </div>
            </div>
            <div class='spacer10'></div>
            <div class=\"row\" style=\"border-bottom: 1px solid black\">
                <div class=\"col-12 bordes\">
                    <h6 style=\"padding-top: 10px\">Consumos de Cafetería</h6>
                </div>
                <div class=\"col-12 bordeslados\">
                <div class=\"spacer10\"></div>
                    <table class=\"tabla\">
                        <thead>
                            <tr class=\"trborder\">
                                <th>Fecha</th>
                                <th>Descripción</th>
                                <th>Monto</th>
                            </tr>
                        </thead>
                        <tbody>
    ";

    $totalConsumo = 0;
    $totalCafeteria = 0;
    $result = mysqli_query($link,"SELECT * FROM Transaccion WHERE idReserva = '{$_POST['idReserva']}' AND idHabitacion = '{$_POST['idHabitacion']}' AND tipo = 'Cafetería'");
    while ($fila = mysqli_fetch_array($result)){
        $html .= "<tr>";
        $html .= "<td>{$fila['fechaTransaccion']}</td>";
        $html .= "<td>{$fila['detalle']}</td>";
        $html .= "<td>S/. {$fila['monto']}</td>";
        $html .= "</tr>";
        $totalCafeteria += $fila['monto'];
        $totalConsumo = $totalConsumo + $fila['monto'];
    }

    $html .= "<tr>";
    $html .= "<td colspan='2' class='text-right' ='border-top: 1px solid grey'>Total</td>";
    $html .= "<td style='border-top: 1px solid grey'>S/. {$totalCafeteria}</td>";
    $html .= "</tr>";

    $html .= "
                        </tbody>
                    </table>
                </div>
            </div>
            <div class='spacer10'></div>
            <div class=\"row\" style=\"border-bottom: 1px solid black\">
                <div class=\"col-12 bordes\">
                    <h6 style=\"padding-top: 10px\">Consumos de Lavandería</h6>
                </div>
                <div class=\"col-12 bordeslados\">
                <div class=\"spacer10\"></div>
                    <table class=\"tabla\">
                        <thead>
                            <tr class=\"trborder\">
                                <th>Fecha</th>
                                <th>Descripción</th>
                                <th>Monto</th>
                            </tr>
                        </thead>
                        <tbody>
    ";

    $totalLavanderia = 0;
    $result = mysqli_query($link,"SELECT * FROM Transaccion WHERE idReserva = '{$_POST['idReserva']}' AND idHabitacion = '{$_POST['idHabitacion']}' AND tipo = 'Lavandería'");
    while ($fila = mysqli_fetch_array($result)){
        $html .= "<tr>";
        $html .= "<td>{$fila['fechaTransaccion']}</td>";
        $html .= "<td>{$fila['detalle']}</td>";
        $html .= "<td>S/. {$fila['monto']}</td>";
        $html .= "</tr>";
        $totalLavanderia += $fila['monto'];
        $totalConsumo = $totalConsumo + $fila['monto'];
    }

    $html .= "<tr>";
    $html .= "<td colspan='2' class='text-right' ='border-top: 1px solid grey'>Total</td>";
    $html .= "<td style='border-top: 1px solid grey'>S/. {$totalLavanderia}</td>";
    $html .= "</tr>";

    $html .= "
                        </tbody>
                    </table>
                </div>
            </div>
            <div class='spacer10'></div>
            <div class=\"row\" style=\"border-bottom: 1px solid black\">
                <div class=\"col-12 bordes\">
                    <h6 style=\"padding-top: 10px\">Consumos Telefax</h6>
                </div>
                <div class=\"col-12 bordeslados\">
                <div class=\"spacer10\"></div>
                    <table class=\"tabla\">
                        <thead>
                            <tr class=\"trborder\">
                                <th>Fecha</th>
                                <th>Descripción</th>
                                <th>Monto</th>
                            </tr>
                        </thead>
                        <tbody>
    ";

    $totalTelefax = 0;
    $result = mysqli_query($link,"SELECT * FROM Transaccion WHERE idReserva = '{$_POST['idReserva']}' AND idHabitacion = '{$_POST['idHabitacion']}' AND tipo = 'Telefax'");
    while ($fila = mysqli_fetch_array($result)){
        $html .= "<tr>";
        $html .= "<td>{$fila['fechaTransaccion']}</td>";
        $html .= "<td>{$fila['detalle']}</td>";
        $html .= "<td>S/. {$fila['monto']}</td>";
        $html .= "</tr>";
        $totalTelefax += $fila['monto'];
        $totalConsumo = $totalConsumo + $fila['monto'];
    }

    $html .= "<tr>";
    $html .= "<td colspan='2' class='text-right' ='border-top: 1px solid grey'>Total</td>";
    $html .= "<td style='border-top: 1px solid grey'>S/. {$totalTelefax}</td>";
    $html .= "</tr>";

    $html .= "
                        </tbody>
                    </table>
                </div>
            </div>
            <div class='spacer10'></div>
            <div class=\"row\" style=\"border-bottom: 1px solid black\">
                <div class=\"col-12 bordes\">
                    <h6 style=\"padding-top: 10px\">Otros</h6>
                </div>
                <div class=\"col-12 bordeslados\">
                <div class=\"spacer10\"></div>
                    <table class=\"tabla\">
                        <thead>
                            <tr class=\"trborder\">
                                <th>Fecha</th>
                                <th>Descripción</th>
                                <th>Monto</th>
                            </tr>
                        </thead>
                        <tbody>
    ";

    $totalOtros = 0;
    $result = mysqli_query($link,"SELECT * FROM Transaccion WHERE idReserva = '{$_POST['idReserva']}' AND idHabitacion = '{$_POST['idHabitacion']}' AND tipo = 'Otros'");
    while ($fila = mysqli_fetch_array($result)){
        $html .= "<tr>";
        $html .= "<td>{$fila['fechaTransaccion']}</td>";
        $html .= "<td>{$fila['detalle']}</td>";
        $html .= "<td>S/. {$fila['monto']}</td>";
        $html .= "</tr>";
        $totalOtros += $fila['monto'];
        $totalConsumo = $totalConsumo + $fila['monto'];
    }

    $html .= "<tr>";
    $html .= "<td colspan='2' class='text-right' ='border-top: 1px solid grey'>Total</td>";
    $html .= "<td style='border-top: 1px solid grey'>S/. {$totalOtros}</td>";
    $html .= "</tr>";

    $subtotal = $totalhabitaciones + $totalConsumo + $cargoExtra;
    $impestos = $subtotal * 0.18;
    $subtotalSinImpuestos = $subtotal - $impestos;
    $totalEstadia = $subtotalSinImpuestos + $impestos;

    $html .= '
                        </tbody>
                    </table>
                </div>
            </div>
            <div class=\'spacer10\'></div>
            <div class="row" style="border-bottom: 1px solid black; width: 8cm;">
                <div class="col-12 bordes">
                    <h6 style="padding-top: 10px">Balance</h6>
                </div>
                <div class="col-12 bordeslados">
                <div class="spacer10"></div>
                    <table class="tabla">
                        <tbody>
                            <tr>
                                <th>Total Habitación:</th>
                                <td>S/. '.round($totalhabitaciones,2).'</td>
                            </tr>
                            <tr>
                                <th>Total Consumos:</th>
                                <td>S/. '.round($totalConsumo,2).'</td>
                            </tr>
                            <tr>
                                <th>Impuestos:</th>
                                <td>S/. '.round($impestos,2).'</td>
                            </tr>
                            <tr>
                                <th>Cargos:</th>
                                <td>S/. '.round($cargoExtra,2).'</td>
                            </tr>
                            <tr>
                                <th>Total a Pagar:</th>
                                <td>S/. '.round($totalEstadia,2).'</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
    ';

    $html .='
            </section>
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
    $nombredearchivo = 'RegistroCheckOut'.$_POST['idReserva'].'_'.$_POST['idHabitacion'].'.pdf';
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