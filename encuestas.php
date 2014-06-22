<?php
/************************************************************************************
*Proyecto: Campus unizar
*Sección: Web Service
*Autores:
*			María Armero Guerra
*			Adrián Sanchez Sanchez
*			Lorena Suarez Vaquero
***************************************************************************************/
/*LISTA ACTIVIDADES CON POSIBILIDAD DE REALIZAR ENCUESTA*/

require_once 'funciones_bd.php';
$db = new funciones_BD();
$usuario = $_POST['usuario'];
echo json_encode($db->asignaturasEncuesta($usuario));

?>