<?php
/************************************************************************************
*Proyecto: Campus unizar
*Sección: Web Service
*Autores:
*			María Armero Guerra
*			Adrián Sanchez Sanchez
*			Lorena Suarez Vaquero
***************************************************************************************/
/*GUARDA LA ENCUESTA REALIZADA POR EL USUARIO*/
$id_pregunta = $_POST['id_pregunta'];
$id_encuesta = $_POST['id_encuesta'];
$respuesta = $_POST['respuesta'];
$id_actividad = $_POST['id_actividad'];

require_once 'funciones_bd.php';
$db = new funciones_BD();

if($db->guardarEncuesta($id_pregunta,$id_encuesta,$respuesta,$id_actividad)){
	$array_resultado[]=array("guardada"=>"si");
}else{
	$array_resultado[]=array("guardada"=>"no");
}
echo json_encode($array_resultado);
?>