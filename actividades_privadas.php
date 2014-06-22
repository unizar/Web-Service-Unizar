
<?php
/************************************************************************************
*Proyecto: Campus unizar
*Sección: Web Service
*Autores:
*			María Armero Guerra
*			Adrián Sanchez Sanchez
*			Lorena Suarez Vaquero
***************************************************************************************/
/*Mostrar actividades privadas*/
require_once 'funciones_bd.php';
$db = new funciones_BD();
$result = array();

$usuario = $_POST['usuario'];
if($result = $db->actividadesPrivadas($usuario)){
	if(mysql_num_rows($result) == 0){
		return null;
	}else{
		while($row = mysql_fetch_array($result)) 
		{
			$resultado[] = array_map('utf8_encode', $row);
		}
	}
}else
	$resultado[] = array("Error"=>"1"); 
echo json_encode($resultado);
?>