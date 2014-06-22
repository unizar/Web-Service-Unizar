<?php
/************************************************************************************
*Proyecto: Campus unizar
*Sección: Web Service
*Autores:
*			María Armero Guerra
*			Adrián Sanchez Sanchez
*			Lorena Suarez Vaquero
***************************************************************************************/
require_once 'funciones_bd.php';
$db = new funciones_BD();

$usuario = $_POST['usuario'];
if($db->insertHoraConexion($usuario)){
	$resultado[]=array("logstatus"=>"1");
}else{
	$resultado[]=array("logstatus"=>"0");
}

echo json_encode($resultado);

?>