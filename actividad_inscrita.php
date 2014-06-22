
<?php
/************************************************************************************
*Proyecto: Campus unizar
*Sección: Web Service
*Autores:
*			María Armero Guerra
*			Adrián Sanchez Sanchez
*			Lorena Suarez Vaquero
***************************************************************************************/

/*ACTIVIDAD INSCRITA POR EL USUARIO*/
$usuario = $_POST['usuario'];
$actividad = $_POST['actividad'];
require_once 'funciones_bd.php';
$db = new funciones_BD();

$result = array();

if($result = $db->actividadUsu($actividad,$usuario)){
	$array_resultado[] = array();
	$número_filas = mysql_num_rows($result);
	if($número_filas>0){
		$array_resultado[]=array("inscrita"=>"si");
	}else{
		$array_resultado[]=array("inscrita"=>"no");
		$superados = array();
		$superados = $db->superaCreditos($usuario);
		$row = mysql_fetch_assoc($superados);
		$array_resultado[]=array_map('utf8_encode', $row);
	}
}else
	$array_resultado[] = array("Error"=>"1"); 
echo json_encode($array_resultado);
?>
