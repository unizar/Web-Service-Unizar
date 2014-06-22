<?php
/************************************************************************************
*Proyecto: Campus unizar
*Sección: Web Service
*Autores:
*			María Armero Guerra
*			Adrián Sanchez Sanchez
*			Lorena Suarez Vaquero
***************************************************************************************/
/*Mostrar Alertas de la actividad recibida por parámetro*/
require_once 'funciones_bd.php';
$db = new funciones_BD();
$result = array();
$resultado = array();
if(isset($_POST['idActividad'])){
	$idActividad = $_POST['idActividad'];
	if($result = $db->alertasActividad($idActividad)){
		while($row = mysql_fetch_assoc($result)) 
		{
			$resultado[] = array_map('utf8_encode', $row);
		}
	}else
		$resultado[] = array("Error"=>"2");
}else
	$resultado[] = array("Error"=>"1");

echo json_encode($resultado);
?>