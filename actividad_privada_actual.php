<?php
/************************************************************************************
*Proyecto: Campus unizar
*Sección: Web Service
*Autores:
*			María Armero Guerra
*			Adrián Sanchez Sanchez
*			Lorena Suarez Vaquero
***************************************************************************************/
/*LISTA ACTIVIDADES PUBLICAS*/

require_once 'funciones_bd.php';
$db = new funciones_BD();
$actividad = $_POST['idActividad'];
if($result = $db->actividadPrivadaActual($actividad)){
	if(mysql_num_rows($result) == 0){
		return null;
	}else{
		$row = mysql_fetch_assoc($result);
		$resultado[] = array_map('utf8_encode', $row);
	}
	
}else
	$resultado[] = array("Error"=>"1"); 

echo json_encode($resultado);
?>