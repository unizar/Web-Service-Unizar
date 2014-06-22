<?php
/************************************************************************************
*Proyecto: Campus unizar
*Sección: Web Service
*Autores:
*			María Armero Guerra
*			Adrián Sanchez Sanchez
*			Lorena Suarez Vaquero
***************************************************************************************/
/*ENCUESTA DE LA ACTIVIDAD*/

require_once 'funciones_bd.php';
$db = new funciones_BD();
$id_actividad = $_POST['id_actividad'];
echo json_encode($db->encuesta($id_actividad));

?>