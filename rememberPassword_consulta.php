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
$result = array();

$usuario = $_POST['usuario'];

	if(!$db->usuarioExiste($usuario)){

		$resultado[] = array("Pregunta"=>"No Existe");
	}
	else
	{
		if($result = $db->preguntaRespuestaUsuario($usuario)){
			$array_resultado[] = array();
			$i = 0;
			
			while($row = mysql_fetch_assoc($result)) 
			{
				$resultado[] = array_map('utf8_encode', $row);
			}
		}else
			$resultado[] = array("Pregunta"=>"Error");
		
	}
echo json_encode($resultado);
?>