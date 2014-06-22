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

echo json_encode($db->publicActiv());

?>