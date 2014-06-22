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

$password = $_POST['newPassword'];
$usuario = $_POST['usuario'];

$resultado = array();
if($db->ModificarContrasena($usuario,$password)){
	$resultado[] = array("Resultado"=>"true");
}else 
	$resultado[] = array("Resultado"=>"false");
	
echo json_encode($resultado);
?>