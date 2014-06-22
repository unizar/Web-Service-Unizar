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

$idAsignatura = $_POST['idAsignatura'];
$usuario = $_POST['user'];

$resultado = array();
if($db->sendPeticionInscripcion($idAsignatura,$usuario)){
	$resultado[] = array("Resultado"=>"true");
}else 
	$resultado[] = array("Resultado"=>"false");
	
echo json_encode($resultado);
?>