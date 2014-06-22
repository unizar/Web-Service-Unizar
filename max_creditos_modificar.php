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

$totalCreditos = $_POST['totalCreditos'];
$usuario = $_POST['user'];

$resultado = array();
if($db->ModificarCreditosMaximos($totalCreditos,$usuario)){
	$resultado[] = array("Resultado"=>"true");
}else 
	$resultado[] = array("Resultado"=>"false");
	
echo json_encode($resultado);
?>