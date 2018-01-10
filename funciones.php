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

function idgenNum(){
    date_default_timezone_set('America/Lima');
    $hora = date('H:i:s');
    $fecha = date('m/d/y');
    $hora=explode(":",$hora);
    $fecha=explode("/",$fecha);
    $id=$fecha[2].$fecha[0].$fecha[1].$hora[0].$hora[1].$hora[2];
    return $id;
}