<?php
/************************************************************************************
*Proyecto: Campus unizar
*Sección: Web Service
*Autores:
*			María Armero Guerra
*			Adrián Sanchez Sanchez
*			Lorena Suarez Vaquero
***************************************************************************************/
$usuario = $_POST['User'];

require_once 'funciones_bd.php';
$db = new funciones_BD();
	
	$sql = $db->consultaCreditosMaximos($usuario);
	$resultado = array();
	$i = 0;
	while($row = mysql_fetch_assoc($sql)) 
	{
		$nombre = json_encode($row['creditos_maximos']);
		$resultado[$i] = $nombre;
		$i = $i +1;
	}

echo json_encode($resultado);

?>