<?php
/************************************************************************************
*Proyecto: Campus unizar
*Sección: Web Service
*Autores:
*			María Armero Guerra
*			Adrián Sanchez Sanchez
*			Lorena Suarez Vaquero
***************************************************************************************/

/*ACTUALIZA LA TABLA usuariosactividades PONIENDO A '1' LA COLUMNA 'Realizada'*/
$usuario = $_POST['usuario'];
$id_actividad = $_POST['id_actividad'];

require_once 'funciones_bd.php';
$db = new funciones_BD();

if($db->actualizaEncuestaRealizada($usuario,$id_actividad)){
	$array_resultado[]=array("acualizado"=>"si");
}else{
	$array_resultado[]=array("acualizado"=>"no");
}
echo json_encode($array_resultado);
?>