<?php
include('session.php');
include('declaracionFechas.php');
include ('funciones.php');
require_once __DIR__ . '/lib/mpdf/mpdf.php';

if(isset($_SESSION['login'])){
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

    $html .= '<section class="container">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width: 15%">Habitación</th>
                        <th style="width: 15%">Nro. Ocupantes</th>
                        <th style="width: 15%">Resv.</th>
                        <th style="width: 55%">Titular (Nombres/Apellidos)</th>
                    </tr>
                    </thead>
                    <tbody>
    ';
    $cantidadHuespedesDia = 0;
    $cantidadTotal = 0;
    $result = mysqli_query($link,"SELECT * FROM Habitacion WHERE idTipoHabitacion <> '6' ORDER BY idHabitacion ASC");
    while ($fila = mysqli_fetch_array($result)){
        $html .= '<tr>';
        $cantidadHuespedesDia = 0;
        $nobmreCompleto = "";
        $result1 = mysqli_query($link,"SELECT * FROM HabitacionReservada WHERE idEstado IN (4) AND idHabitacion = '{$fila['idHabitacion']}'");
        while ($fila1 = mysqli_fetch_array($result1)){
            $arrayFechasOcupadas = array();
            $fechaInicio = explode(" ",$fila1['fechaInicio']);
            $fechaFin = explode(" ",$fila1['fechaFin']);
            $intervala = timeInterval($fechaInicio[0],$fechaFin[0]);
            $date2 = date('Y-m-d', strtotime($fechaInicio[0] . ' -1 day'));

            switch($fila1['modificadorCheckIO']){
                case 0:
                    $intervala -= 1;
                    break;
                case 1:
                    $intervala -= 1;
                    $date2 = date('Y-m-d', strtotime($date2 . ' -1 day'));
                    break;
                case 2:
                    break;
                case 3:
                    $date2 = date('Y-m-d', strtotime($date2 . ' -1 day'));
                    break;
            }

            for($j = 0; $j <= $intervala; $j++){
                $date2 = date('Y-m-d', strtotime($date2 . ' +1 day'));
                $arrayFechasOcupadas[$j] = $date2;
            }

            if(in_array($date,$arrayFechasOcupadas)){
                $result2 = mysqli_query($link,"SELECT COUNT(*) AS cantidad FROM Ocupantes WHERE idHabitacion = '{$fila1['idHabitacion']}' AND idReserva = '{$fila1['idReserva']}'");
                while ($fila2 = mysqli_fetch_array($result2)){
                    $cantidadHuespedesDia += $fila2['cantidad'];
                }
                $result2 = mysqli_query($link,"SELECT * FROM Huesped WHERE idHuesped IN (SELECT idHuesped FROM Ocupantes WHERE idHabitacion = '{$fila1['idHabitacion']}' AND idReserva = '{$fila1['idReserva']}' AND cargos = 1)");
                while ($fila2 = mysqli_fetch_array($result2)){
                    $nobmreCompleto = $fila2['nombreCompleto'];
                }
            }else{
                $cantidadHuespedesDia = 0;
            }
            $cantidadTotal += $cantidadHuespedesDia;
        }
        if($cantidadHuespedesDia == 0){
            $html .= "<td style ='padding-bottom: 7px; padding-top: 7px;'>{$fila['idHabitacion']}</td>";
            $html .= "<td style ='padding-bottom: 7px; padding-top: 7px;'>{$cantidadHuespedesDia}</td>";
            $html .= "<td style ='padding-bottom: 7px; padding-top: 7px;'></td>";
            $html .= "<td style ='padding-bottom: 7px; padding-top: 7px;'></td>";
            $html .= "</tr>";
        }else{
            $html .= "<td style ='padding-bottom: 7px; padding-top: 7px;'>{$fila['idHabitacion']}</td>";
            $html .= "<td style ='padding-bottom: 7px; padding-top: 7px;'>{$cantidadHuespedesDia}</td>";
            $html .= "<td style ='padding-bottom: 7px; padding-top: 7px;'></td>";
            $html .= "<td style ='padding-bottom: 7px; padding-top: 7px;'>{$nobmreCompleto}</td>";
            $html .= "</tr>";
        }
    }

    $html .='        
                        <tr>
                            <th style =\'padding-bottom: 7px; padding-top: 7px;\'>Total</th>
                            <td style =\'padding-bottom: 7px; padding-top: 7px;\'>'.$cantidadTotal.'</td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </body>
    </html>
    ';

    $htmlheader='
        <header>
            <div id="descripcionbrand">
                <img style="margin-top: 10px" width="auto" height="70" src="img/LogoPDF.png"/>
            </div>
            <div id="tituloreporte">
                <h4>Listado de Desayunos</h4>
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