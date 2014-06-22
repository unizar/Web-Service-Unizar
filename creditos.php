<?php
/************************************************************************************
*Proyecto: Campus unizar
*Sección: Web Service
*Autores:
*			María Armero Guerra
*			Adrián Sanchez Sanchez
*			Lorena Suarez Vaquero
***************************************************************************************/
$usuario = $_POST['usuario'];

require_once 'funciones_bd.php';
$db = new funciones_BD();
	
	$sql = $db->actividadesUsuario($usuario);
	$resultado = array();
	$i = 0;
	while($row = mysql_fetch_assoc($sql)) 
	{
		$resultado[] = array_map('utf8_encode', $row);
	}
	if ($resultado==null) {
	    $sql = $db->consultaCreditosMaximos($usuario);
	    $row = mysql_fetch_assoc($sql);
	    $creditos = $row['creditos_maximos'];
	    $resultado[]=array("maxCreditos"=>$creditos);		
	}

echo json_encode($resultado);

?>



