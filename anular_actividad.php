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

if($db->anularActividad($actividad,$usuario)){
	$array_resultado[]=array("anulada"=>"si");
}else{
	$array_resultado[]=array("anulada"=>"no");
}
echo json_encode($array_resultado);
?>