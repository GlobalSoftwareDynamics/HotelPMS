<?php
function autocompletar($table,$campo,$link){
    $array = '[';
    $query = mysqli_query($link,"SELECT * FROM {$table}");
    $aux = 0;
    $numrows = mysqli_num_rows($query);
    while ($row = mysqli_fetch_array($query)){
        $aux++;
        if($aux == $numrows){
            $array .= "'".$row[$campo]."']";
        }else{
            $array .= "'".$row[$campo]."',";
        }
    }
    return $array;
}

function idgen($clase){
    date_default_timezone_set('America/Lima');
    $hora = date('H:i:s');
    $fecha = date('m/d/y');
    $hora=explode(":",$hora);
    $fecha=explode("/",$fecha);
    $aux="";
    switch ($hora[0]) {
        case 1:
            $aux = "A";
            break;
        case 2:
            $aux = "B";
            break;
        case 3:
            $aux = "C";
            break;
        case 4:
            $aux = "D";
            break;
        case 5:
            $aux = "E";
            break;
        case 6:
            $aux = "F";
            break;
        case 7:
            $aux = "G";
            break;
        case 8:
            $aux = "H";
            break;
        case 9:
            $aux = "I";
            break;
        case 10:
            $aux = "J";
            break;
        case 11:
            $aux = "K";
            break;
        case 12:
            $aux = "L";
            break;
        case 13:
            $aux = "M";
            break;
        case 14:
            $aux = "N";
            break;
        case 15:
            $aux = "O";
            break;
        case 16:
            $aux = "P";
            break;
        case 17:
            $aux = "Q";
            break;
        case 18:
            $aux = "R";
            break;
        case 19:
            $aux = "S";
            break;
        case 20:
            $aux = "T";
            break;
        case 21:
            $aux = "U";
            break;
        case 22:
            $aux = "V";
            break;
        case 23:
            $aux = "W";
            break;
        case 0:
            $aux = "X";
            break;
    }
    switch ($fecha[0]) {
        case 1:
            $fecha[0] = "A";
            break;
        case 2:
            $fecha[0] = "B";
            break;
        case 3:
            $fecha[0] = "C";
            break;
        case 4:
            $fecha[0] = "D";
            break;
        case 5:
            $fecha[0] = "E";
            break;
        case 6:
            $fecha[0] = "F";
            break;
        case 7:
            $fecha[0] = "G";
            break;
        case 8:
            $fecha[0] = "H";
            break;
        case 9:
            $fecha[0] = "I";
            break;
        case 10:
            $fecha[0] = "J";
            break;
        case 11:
            $fecha[0] = "K";
            break;
        case 12:
            $fecha[0] = "L";
            break;
    }
    $id=$clase.$fecha[2].$fecha[0].$fecha[1].$aux.$hora[1].$hora[2];
    return $id;
}

function timeInterval ($fechaInicio, $fechaFin){
    $fechaInicio = explode(" ",$fechaInicio);
    $fechaInicio = explode("-",$fechaInicio[0]);
    $date1 = date_create("{$fechaInicio[0]}-{$fechaInicio[1]}-{$fechaInicio[2]}");
    $fechaFin = explode(" ",$fechaFin);
    $fechaFin = explode("-",$fechaFin[0]);
    $date2 = date_create("{$fechaFin[0]}-{$fechaFin[1]}-{$fechaFin[2]}");
    $interval = date_diff($date1,$date2);
    $interval = $interval->d;
    if($date1 == $date2){
        $interval = $interval +1;
    }
    return $interval;
}

function claseAgenda ($estadoActual, $modificadorActual, $estadoAnterior, $modificadorAnterior){

    switch ($modificadorActual){

        case 0 && $modificadorAnterior == 0: $fin = "49"; $inicio = "51"; $medio = "50";break;
        case 2 && $modificadorAnterior == 0: $fin = "49"; $inicio = "51"; $medio = "50";break;
        case 4 && $modificadorAnterior == 0: $fin = "49"; $inicio = "51"; $medio = "50";break;
        case 0 && $modificadorAnterior == 1: $fin = "49"; $inicio = "51"; $medio = "50";break;
        case 2 && $modificadorAnterior == 1: $fin = "49"; $inicio = "51"; $medio = "50";break;
        case 4 && $modificadorAnterior == 1: $fin = "49"; $inicio = "51"; $medio = "50";break;
        case 0 && $modificadorAnterior == 4: $fin = "49"; $inicio = "51"; $medio = "50";break;
        case 2 && $modificadorAnterior == 4: $fin = "49"; $inicio = "51"; $medio = "50";break;
        case 4 && $modificadorAnterior == 4: $fin = "49"; $inicio = "51"; $medio = "50";break;
        case 0 && $modificadorAnterior == 5: $fin = "49"; $inicio = "51"; $medio = "50";break;
        case 2 && $modificadorAnterior == 5: $fin = "49"; $inicio = "51"; $medio = "50";break;
        case 4 && $modificadorAnterior == 5: $fin = "49"; $inicio = "51"; $medio = "50";break;
        default: $fin = "50"; $inicio = "50"; $medio = "50";break;

    }

    switch ($estadoActual){

        case 3 && $estadoAnterior == 3: $color1 = "0a6187"; $color2 = "0a6187";break;
        case 4 && $estadoAnterior == 3: $color1 = "389438"; $color2 = "0a6187";break;
        case 5 && $estadoAnterior == 3: $color1 = "c3c3c3"; $color2 = "0a6187";break;
        case 3 && $estadoAnterior == 4: $color1 = "0a6187"; $color2 = "389438";break;
        case 4 && $estadoAnterior == 4: $color1 = "389438"; $color2 = "389438";break;
        case 5 && $estadoAnterior == 4: $color1 = "c3c3c3"; $color2 = "389438";break;
        case 3 && $estadoAnterior == 5: $color1 = "0a6187"; $color2 = "c3c3c3";break;
        case 4 && $estadoAnterior == 5: $color1 = "389438"; $color2 = "c3c3c3";break;
        case 5 && $estadoAnterior == 5: $color1 = "c3c3c3"; $color2 = "c3c3c3";break;
        default: $color1 = "ffffff"; $color2 = "ffffff"; break;

    }

    $clase = "
    background: #ffffff;
background: -moz-linear-gradient(-45deg, #{$color2} 0%, #{$color2} {$fin}%, #ffffff {$medio}%, #{$color1} {$inicio}%, #{$color1} 100%);
background: -webkit-gradient(left top, right bottom, color-stop(0%, #{$color2}), color-stop({$fin}%, #{$color2}), color-stop({$medio}%, #ffffff), color-stop({$inicio}%, #{$color1}), color-stop(100%, #{$color1}));
background: -webkit-linear-gradient(-45deg, #{$color2} 0%, #{$color2} {$fin}%, #ffffff {$medio}%, #{$color1} {$inicio}%, #{$color1} 100%);
background: -o-linear-gradient(-45deg, #{$color2} 0%, #{$color2} {$fin}%, #ffffff {$medio}%, #{$color1} {$inicio}%, #{$color1} 100%);
background: -ms-linear-gradient(-45deg, #{$color2} 0%, #{$color2} {$fin}%, #ffffff {$medio}%, #{$color1} {$inicio}%, #{$color1} 100%);
background: linear-gradient(135deg, #{$color2} 0%, #{$color2} {$fin}%, #ffffff {$medio}%, #{$color1} {$inicio}%, #{$color1} 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#{$color2}', endColorstr='#{$color1}', GradientType=1 );
    ";

    return $clase;
}