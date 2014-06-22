<?
/************************************************************************************
*Proyecto: Campus unizar
*Sección: Web Service
*Autores:
*			María Armero Guerra
*			Adrián Sanchez Sanchez
*			Lorena Suarez Vaquero
***************************************************************************************/
/*Mostrar actividades públicas*/

require_once 'funciones_bd.php';
$db = new funciones_BD();
$result = actividadesPublicas();
$array_resultado = array();
$i=0;
while($row = mysql_fetch_array($result)){
	$array_resultado[i] = ("id"=>"".$row['id']."","nombre"=>"".$row['nombre']."");
	$i++;
}

echo json_encode($array_resultado);
?>