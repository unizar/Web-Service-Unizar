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

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$usuario = $_POST['usuario'];
$password = $_POST['password'];
$dni = $_POST['dni'];
$email = $_POST['email'];
$pregunta = $_POST['pregunta'];
$respuesta = $_POST['respuesta'];

$resultado = array();

if($db->usuarioExiste($usuario)){

	$resultado[] = array("Resultado"=>"Existe");
}
else
{
	if($db->adduser($nombre,$apellidos,$usuario,$password,$dni,$email,$pregunta,$respuesta))
	{	$resultado[] = array("Resultado"=>"true");
	}else
	{
		$resultado[] = array("Resultado"=>"false");
	}		
}
echo json_encode($resultado);


?>


