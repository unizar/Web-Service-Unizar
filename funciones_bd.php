<?php
 /************************************************************************************
*Proyecto: Campus unizar
*Sección: Web Service
*Autores:
*			María Armero Guerra
*			Adrián Sanchez Sanchez
*			Lorena Suarez Vaquero
***************************************************************************************/
class funciones_BD {
 
    private $db;
 
    // constructor

    function __construct() {
        require_once 'connectbd.php';
        // connecting to database

        $this->db = new DB_Connect();
        $this->db->connect();

    }
 
    // destructor
    function __destruct() {
 
    }
 
	public function login($user,$passw){

	$result=mysql_query("SELECT COUNT(*) FROM usuarios WHERE Usuario='$user' AND password='$passw' AND tipo_usuario='Alumno'"); 
	$count = mysql_fetch_row($result);

	/*como el usuario debe ser unico cuenta el numero de ocurrencias con esos datos*/
		if ($count[0]==0){
			return true;
		}else{
			return false;
		}
	}
	/*ADRIAN*/
	public function publicActiv(){

		$result=mysql_query("SELECT nombre,fecha,hora,Lugar,Duracion,Informacion,id_actividad,Creditos FROM actividades"); 
		$numFilas = mysql_num_rows($result);
		$actividades=array();
		for ($i = 0; $i < $numFilas; $i++) {
			$fila=mysql_fetch_assoc($result);
			$actividades[] = array_map('utf8_encode', $fila);
		}
		return $actividades;
	}

	public function actividadUsu($actividad, $usuario){

		$result=mysql_query("SELECT usuario FROM usuariosactividades WHERE id_actividad='$actividad' and usuario='$usuario'");
		if(mysql_num_rows($result) == 0){
			$insert=mysql_query("INSERT INTO usuariosactividades (usuario,id_actividad,encuestaRealizada) VALUES ('$usuario','$actividad','0')");
		}
		return $result;
	}
	public function superaCreditos($usuario){
		$result=mysql_query("SELECT SUM(a.Creditos) as creditos,u.creditos_maximos as maxCreditos
								FROM usuariosactividades ua INNER JOIN actividades a on ua.id_actividad = a.id_actividad 
															INNER JOIN Usuarios u ON ua.Usuario=u.Usuario 
								WHERE ua.Usuario='$usuario'");
		return $result;
	}

	public function anularActividad($actividad,$usuario){
		if (mysql_query("DELETE FROM usuariosactividades WHERE id_actividad='$actividad' and usuario='$usuario'")){
			return true;
		}
		return false;
	}

	public function asignaturasEncuesta($usuario){
		$result = mysql_query("SELECT actividades.nombre, actividades.id_actividad 
								FROM actividades	
									LEFT JOIN usuariosactividades ON actividades.id_actividad = usuariosactividades.id_actividad
								WHERE usuariosactividades.encuestaRealizada =  '0'
									AND usuariosactividades.Usuario = '$usuario'
									AND actividades.fecha < CURDATE( ) AND actividades.encuesta!='0'");
		$numFilas = mysql_num_rows($result);
		$actividades=array();
		for ($i = 0; $i < $numFilas; $i++) {
			$fila=mysql_fetch_assoc($result);
			$actividades[] = array_map('utf8_encode', $fila);
		}
		return $actividades;
	}

	public function encuesta($id_actividad){
		$result = mysql_query("SELECT encuestas.titulo, preguntas_encuesta.pregunta, encuestas.idEncuesta, preguntas_encuesta.idPregunta
								FROM encuestas
									LEFT JOIN preguntas_encuesta ON preguntas_encuesta.idEncuesta=encuestas.idEncuesta
									LEFT JOIN actividades ON actividades.Encuesta=encuestas.idEncuesta
								WHERE actividades.id_actividad='$id_actividad'");
		$numFilas = mysql_num_rows($result);
		$actividades=array();
		for ($i = 0; $i < $numFilas; $i++) {
			$fila=mysql_fetch_assoc($result);
			$actividades[] = array_map('utf8_encode', $fila);
		}
		return $actividades;
	}

	public function guardarEncuesta($id_pregunta,$id_encuesta,$respuesta,$id_actividad){

		$result=mysql_query("SELECT `$respuesta` FROM actividad_encuesta where `idEncuesta`='$id_encuesta' AND `idPregunta`='$id_pregunta' AND `id_actividad`='$id_actividad'");
		$fila=mysql_fetch_row($result);

		$numResp=$fila[0];
		$numResp+=1;
		if (mysql_query("UPDATE `actividad_encuesta` SET `$respuesta`='$numResp' WHERE `idEncuesta`='$id_encuesta' AND `idPregunta`='$id_pregunta' AND `id_actividad`='$id_actividad'"))
			return true;
		return false;
	}

	public function actualizaEncuestaRealizada($usuario,$id_actividad){
		if (mysql_query("UPDATE  `usuariosactividades` SET  `encuestaRealizada` =  '1' WHERE  `Usuario` =  '$usuario' AND  `id_actividad` =  '$id_actividad'"))
			return true;
		return false;
	}
	/*MARIA*/	
	//Esta función escribe lo que le pases por parámetro en un fichero llamado log.txt
	public function writeInLog($texto){
		$fp = fopen('log.txt', 'a');
		fwrite($fp, $texto."\n");
		fclose($fp);
	}
	public function actividadesPrivadas($user){
		$result = mysql_query("SELECT Nombre as Nombre, asignaturas.idAsignatura as idAsignatura 
		                       FROM asignaturas, usuarioasignaturas 
							   WHERE  usuarioasignaturas.usuario='$user' and usuarioasignaturas.idAsignatura = asignaturas.idAsignatura and inscrito='1'");
		return $result;
	}
	
	public function actividadesPendientes($usuario){
		$result = mysql_query("SELECT Nombre as NombreAsignatura, idAsignatura 
							   FROM asignaturas
							   WHERE  idAsignatura <> ALL (SELECT idAsignatura 
													  FROM usuarioasignaturas
													  WHERE usuario='$usuario'
													  GROUP BY idAsignatura)");
		return $result;
	}
	
	public function actividadPrivadaActual($actividad){
		$result = mysql_query("SELECT Asignatura, Asignaturas.Nombre as NombreAsignatura, Asignaturas.Informacion, Usuarios.Nombre as Profesor, apellidos, mail 
		                       FROM asignaturas, usuarios 
							   WHERE  idAsignatura='$actividad' and Usuario = idProfesor");
		return $result;
	}
	
	public function sendPeticionInscripcion($idAsignatura,$usuario){
		$result = mysql_query("SELECT * 
							   FROM usuarioasignaturas 
							   WHERE usuario='$usuario' and idAsignatura='$idAsignatura'");
		if(mysql_num_rows($result) == 0){
			if (mysql_query("INSERT INTO usuarioasignaturas (usuario,idAsignatura,inscrito )
						     VALUES ('$usuario','$idAsignatura',0)")){
				return true;
			}
		}
		return false;
	}
	
	public function actividadesConAlertas(){
		$result = mysql_query("SELECT actividades.nombre,alertas.id_actividad
							   FROM actividades,alertas
							   WHERE actividades.id_actividad = alertas.id_actividad
							   GROUP BY alertas.id_actividad");
		return $result;
	}
	
	public function alertasActividad($idActividad){
		$result = mysql_query("SELECT id_profesor,alertas.nombre as nombreAlerta,informacion,usuarios.Nombre as nombreProfesor,usuarios.Apellidos
							   FROM alertas,usuarios
							   WHERE id_actividad = '$idActividad' and id_profesor = usuarios.Usuario and tipo_usuario='Profesor'");
		return $result;
	}
	
	public function alertasPendientesAviso($usuario){
		$sql = "SELECT * 
				FROM ultimaconexionusuario
				WHERE id_usuario = '$usuario'";
		$primeraVezLogueo = mysql_query($sql);
		if(mysql_num_rows($primeraVezLogueo) != 0){
			$result = mysql_query("SELECT actividades.nombre
								   FROM alertas,actividades,ultimaconexionusuario
								   WHERE alertas.id_actividad = actividades.id_actividad and alertas.id_profesor = actividades.id_profesor and id_usuario='$usuario' and  FechaAlta>=fechaConexion");
		}else{
			$result = mysql_query("SELECT actividades.nombre
								   FROM alertas,actividades
								   WHERE alertas.id_actividad = actividades.id_actividad and alertas.id_profesor = actividades.id_profesor
								   GROUP BY actividades.nombre");
		}
		return $result;
	}
	
	public function insertHoraConexion($usuario){
		$fecha=getdate();
		$fecha_alta= $fecha['year']."-".$fecha['mon']."-".$fecha['mday'];
		$sql="SELECT id_usuario
			  FROM ultimaconexionusuario
			  WHERE id_usuario='$usuario'";
		$result=mysql_query($sql);
		if(mysql_num_rows ($result) == 0){
			$sql = "INSERT INTO ultimaconexionusuario(id_usuario,fechaConexion) 
			VALUES('$usuario', '$fecha_alta')";
			if(mysql_query($sql))
				return true;
			else return false;
		}else{
			$sql="UPDATE ultimaconexionusuario SET fechaConexion='".$fecha_alta."'";
			if(mysql_query($sql))
				return true;
			else return false;
		};
	}
	/*LORENA*/
	public function actividadesUsuario($user){
		$result=mysql_query("SELECT a.id_actividad as idActividad,a.nombre as Nombre ,a.Creditos as Creditos,u.creditos_maximos as maxCreditos
							FROM usuariosactividades ua INNER JOIN actividades a on ua.id_actividad = a.id_actividad 
														INNER JOIN Usuarios u ON ua.Usuario=u.Usuario 
							WHERE ua.Usuario='$user'"); 
		return $result;
	}
	public function consultaCreditosMaximos($user){
		$result=mysql_query("select creditos_maximos from usuarios WHERE Usuario='$user'"); 
		return $result;
	}
	
	public function ModificarCreditosMaximos($totalCreditos,$user){
	$result=mysql_query("UPDATE usuarios SET creditos_maximos='$totalCreditos' WHERE Usuario='$user'"); 
	return $result;
	}
	
	public function adduser($nombre,$apellidos,$usuario,$password,$dni,$email,$pregunta,$respuesta) {
		$sql = "INSERT INTO usuarios(Usuario,Nombre,apellidos,dni,mail,password,tipo_usuario,creditos_maximos,pregunta_seg,respuesta_seg) 
		VALUES('$usuario', '$nombre', '$apellidos', '$dni', '$email', '$password', 'Alumno','0','$pregunta', '$respuesta')";
		if(mysql_query($sql))
			return true;
		else return false;
	}
	
	public function usuarioExiste($usuario) {
		$consulta = "SELECT Usuario from usuarios WHERE Usuario='$usuario'";
        $result = mysql_query($consulta);
        $num_rows = mysql_num_rows($result); //numero de filas retornadas
        if ($num_rows > 0) {
			//El usuario existe
            return true;
        } else {
            //El usuario no existe
            return false;
        }
    }
	
	public function preguntaRespuestaUsuario($usuario) {
		$result=mysql_query("SELECT pregunta_seg as Pregunta, respuesta_seg as Respuesta from usuarios WHERE Usuario='$usuario'");
        return $result;
    }
	
	public function ModificarContrasena($user,$password){
	$result=mysql_query("UPDATE usuarios SET password='$password' WHERE Usuario='$user'"); 
	return $result;
	}
}
 
?>
