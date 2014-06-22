<?php
/************************************************************************************
*Proyecto: Campus unizar
*Sección: Web Service
*Autores:
*			María Armero Guerra
*			Adrián Sanchez Sanchez
*			Lorena Suarez Vaquero
***************************************************************************************/
/*Mostrar actividades con Alerta*/
require_once 'funciones_bd.php';
$db = new funciones_BD();
$result = array();
if($result = $db->actividadesConAlertas()){
	while($row = mysql_fetch_assoc($result)) 
	{
		$resultado[] = array_map('utf8_encode', $row);
	}
}else
	$resultado[] = array("Error"=>"1");
	
	echo json_encode($resultado);
?>