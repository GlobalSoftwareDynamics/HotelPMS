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
                        <th style="width: 55%">Titular (Apellido/Nombre)</th>
                    </tr>
                    </thead>
                    <tbody>
    ';
    $result = mysqli_query($link,"SELECT * FROM Habitacion ORDER BY idHabitacion ASC");
    while ($fila = mysqli_fetch_array($result)){
        $html .= '<tr>';
        $result1 = mysqli_query($link,"SELECT idHuesped, COUNT(idHuesped) AS numero FROM Ocupantes WHERE idHabitacion IN (SELECT idHabitacion FROM HabitacionReservada WHERE fechaInicio <= '{$date} 23:59:59' AND fechaFin > '{$date}' AND idEstado = 4 AND idHabitacion = '{$fila['idHabitacion']}')");
        $numrow = mysqli_num_rows($result1);
        if($numrow > 0){
            while ($fila1 = mysqli_fetch_array($result1)){
                $result2 = mysqli_query($link,"SELECT * FROM Huesped WHERE idHuesped = '{$fila1['idHuesped']}'");
                while ($fila2 = mysqli_fetch_array($result2)){
                    $nombre = $fila2['nombreCompleto'];
                }
                $html .= '<td>'.$fila['idHabitacion'].'</td>';
                $html .= '<td>'.$fila1['numero'].'</td>';
                $html .= '<td></td>';
                $html .= '<td>'.$nombre.'</td>';
                $html .= '</tr>';
            }
        }else{
            $html .= '<td>'.$fila['idHabitacion'].'</td>';
            $html .= '<td></td>';
            $html .= '<td></td>';
            $html .= '<td></td>';
            $html .= '</tr>';
        }
    }

    $html .='        </tbody>
                </table>
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