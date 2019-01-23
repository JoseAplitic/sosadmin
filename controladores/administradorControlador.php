<?php
	if($peticionAjax){
		require_once "../modelos/administradorModelo.php";
	}else{
		require_once "./modelos/administradorModelo.php";
	}

	class administradorControlador extends administradorModelo
	{

		//Obtener cantidad de registros de usuarios
		public function obtener_numero_usuarios_controlador()
		{
			$usuarios=mainModel::ejecutar_consulta_simple("SELECT * FROM admin;");
			$num = $usuarios->rowCount();
			return $num;
		}

		//Obtener info de un usuarios
		public function obtener_info_usuarios_controlador($codigo)
		{
			$sql=mainModel::conectar()->prepare("SELECT * FROM usuarios WHERE id=:Codigo");
			$clave=mainModel::decryption($codigo);
			$sql->bindParam(":Codigo",$clave);
			$sql->execute();
			return $sql;
		}


		//Obtener info de un usuarios
		public function obtener_info_perfil_controlador($codigo)
		{
			$sql=mainModel::conectar()->prepare("SELECT * FROM usuarios WHERE id=:Codigo");
			$sql->bindParam(":Codigo",$codigo);
			$sql->execute();
			return $sql;
		}

		//Controlador para agregar administrador
		public function agregar_administrador_controlador()
		{
			$nombre=mainModel::limpiar_cadena($_POST['usuario-nombre-nuevo']);
			$apellido=mainModel::limpiar_cadena($_POST['usuario-apellido-nuevo']);
			$usuario=mainModel::limpiar_cadena($_POST['usuario-usuario-nuevo']);
			$password1=mainModel::limpiar_cadena($_POST['usuario-contra1-nuevo']);
			$password2=mainModel::limpiar_cadena($_POST['usuario-contra2-nuevo']);
			$correo=mainModel::limpiar_cadena($_POST['usuario-correo-nuevo']);

			if ($password1 == $password2)
			{
				$verificar=administradorModelo::verificar_usuario_disponible($usuario);
				if ($verificar->rowCount() > 0)
				{
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrió un error",
						"Texto"=>"El usuario que ingresaste no esta disponible",
						"Tipo"=>"error"
					];
				}
				else
				{
					$clave=mainModel::encryption($password1);
					$dataAC=[
						"Nombre"=>$nombre,
						"Apellido"=>$apellido,
						"Usuario"=>$usuario,
						"Clave"=>$clave,
						"Correo"=>$correo
					];
					$guardarCuenta=administradorModelo::agregar_administrador_modelo($dataAC);
					if($guardarCuenta->rowCount()>=1)
					{
						$alerta=[
							"Alerta"=>"limpiar",
							"Titulo"=>"¡Administrador registrado!",
							"Texto"=>"El administrador se registró con éxito en el sistema",
							"Tipo"=>"success"
						];
					}
					else
					{
						$alerta=[
							"Alerta"=>"simple",
							"Titulo"=>"Ocurrió un error inesperado",
							"Texto"=>"No hemos podido registrar el administrador",
							"Tipo"=>"error"
						];
					}
				}
			}
			else
			{
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrio un error",
					"Texto"=>"Las contraseñas no coinciden",
					"Tipo"=>"error"
				];
			}

			return mainModel::sweet_alert($alerta);
		}

		//editar info mi perfil
		public function editar_perfil_controlador()
		{
			$codigo=mainModel::limpiar_cadena($_POST['usuario-id-editar-perfil']);
			$nombre=mainModel::limpiar_cadena($_POST['usuario-nombre-editar-perfil']);
			$apellido=mainModel::limpiar_cadena($_POST['usuario-apellido-editar-perfil']);
			$usuario=mainModel::limpiar_cadena($_POST['usuario-usuario-editar-perfil']);
			$correo=mainModel::limpiar_cadena($_POST['usuario-correo-editar-perfil']);
			$contra1=mainModel::limpiar_cadena($_POST['usuario-contra1-editar-perfil']);
			$contra2=mainModel::limpiar_cadena($_POST['usuario-contra2-editar-perfil']);
			if ($contra1 == $contra2)
			{
				$verificar=administradorModelo::verificar_usuario_disponible_actualizar($codigo, $usuario);
				if ($verificar->rowCount() > 0)
				{
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrió un error",
						"Texto"=>"El usuario que ingresaste no esta disponible",
						"Tipo"=>"error"
					];
				}
				else
				{
					$clave=mainModel::encryption($contra1);
					$datosEditar =
					[
						"Codigo"=>$codigo,
						"Nombre"=>$nombre,
						"Apellido"=>$apellido,
						"Usuario"=>$usuario,
						"Correo"=>$correo,
						"Clave"=>$clave
					];
					$ActAdmin=administradorModelo::editar_administrador_modelo($datosEditar);
					if($ActAdmin->rowCount()>=1)
					{
						$alerta=[
							"Alerta"=>"recargar",
							"Titulo"=>"Administrador Actualizado",
							"Texto"=>"El administrador fue editado con éxito",
							"Tipo"=>"success"
						];
					}
					else
					{
						$alerta=[
							"Alerta"=>"simple",
							"Titulo"=>"Ocurrió un error inesperado",
							"Texto"=>"No se puede actualizar este administrador en este momento, esto puede ser un error del sistema pero te recomendamos revisar la información que proporcionaste.",
							"Tipo"=>"error"
						];
					}
				}
			}
			else
			{
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrio un error",
					"Texto"=>"Las contraseñas no coinciden",
					"Tipo"=>"error"
				];
			}
			return mainModel::sweet_alert($alerta);
		}

		//editar info administradores
		public function editar_administrador_controlador()
		{
			$codigo=mainModel::decryption($_POST['usuario-id-editar']);
			$codigo=mainModel::limpiar_cadena($codigo);
			$nombre=mainModel::limpiar_cadena($_POST['usuario-nombre-editar']);
			$apellido=mainModel::limpiar_cadena($_POST['usuario-apellido-editar']);
			$usuario=mainModel::limpiar_cadena($_POST['usuario-usuario-editar']);
			$correo=mainModel::limpiar_cadena($_POST['usuario-correo-editar']);
			$contra1=mainModel::limpiar_cadena($_POST['usuario-contra1-editar']);
			$contra2=mainModel::limpiar_cadena($_POST['usuario-contra2-editar']);
			if ($contra1 == $contra2)
			{
				$verificar=administradorModelo::verificar_usuario_disponible_actualizar($codigo, $usuario);
				if ($verificar->rowCount() > 0)
				{
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrió un error",
						"Texto"=>"El usuario que ingresaste no esta disponible",
						"Tipo"=>"error"
					];
				}
				else
				{
					$clave=mainModel::encryption($contra1);
					$datosEditar =
					[
						"Codigo"=>$codigo,
						"Nombre"=>$nombre,
						"Apellido"=>$apellido,
						"Usuario"=>$usuario,
						"Correo"=>$correo,
						"Clave"=>$clave
					];
					$ActAdmin=administradorModelo::editar_administrador_modelo($datosEditar);
					if($ActAdmin->rowCount()>=1)
					{
						$alerta=[
							"Alerta"=>"recargar",
							"Titulo"=>"Administrador Actualizado",
							"Texto"=>"El administrador fue editado con éxito",
							"Tipo"=>"success"
						];
					}
					else
					{
						$alerta=[
							"Alerta"=>"simple",
							"Titulo"=>"Ocurrió un error inesperado",
							"Texto"=>"No se puede actualizar este administrador en este momento, esto puede ser un error del sistema pero te recomendamos revisar la información que proporcionaste.",
							"Tipo"=>"error"
						];
					}
				}
			}
			else
			{
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrio un error",
					"Texto"=>"Las contraseñas no coinciden",
					"Tipo"=>"error"
				];
			}
			return mainModel::sweet_alert($alerta);
		}


		// Controlador para paginar administradores
		public function paginador_administrador_controlador($pagina,$registros,$busqueda){

			$pagina=mainModel::limpiar_cadena($pagina);
			$registros=mainModel::limpiar_cadena($registros);
			$busqueda=mainModel::limpiar_cadena($busqueda);
			$tabla="";

			$pagina= (isset($pagina) && $pagina>0) ? (int) $pagina : 1;
			$inicio= ($pagina>0) ? (($pagina*$registros)-$registros) : 0;

			if(isset($busqueda) && $busqueda!=""){
				$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM usuarios WHERE nombre LIKE '%$busqueda%' OR apellido LIKE '%$busqueda%' ORDER BY id ASC LIMIT $inicio,$registros";
				$paginaurl="buscar-usuarios";
			}else{
				$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM usuarios ORDER BY id DESC LIMIT $inicio,$registros";
				$paginaurl="usuarios";
			}

			$conexion = mainModel::conectar();

			$datos = $conexion->query($consulta);
			$datos= $datos->fetchAll();

			$total= $conexion->query("SELECT FOUND_ROWS()");
			$total= (int) $total->fetchColumn();

			$Npaginas= ceil($total/$registros);

			$tabla.='
					<table class="table">
						<thead>
							<tr>
								<th>ID</th>
								<th>Nombre Completo</th>
								<th>Editar</th>
								<th>Eliminar</th>
							</tr>
						</thead>
						<tbody>
				';

			if($total>=1 && $pagina<=$Npaginas){
				$contador=$inicio+1;
				foreach($datos as $rows){
					$tabla.='
						<tr>
							<td>'.$rows['id'].'</td>
							<td>'.$rows['nombre'].' '.$rows['apellido'].'</td>
							<td>
								<form action="'.SERVERURL.'editar-usuario/" method="POST"  entype="multipart/form-data" autocomplete="off" style="display: inherit;">
									<input type="hidden" name="usuario-id-editar" value="'.mainModel::encryption($rows['id']).'">
									<button type="submit" class="btn btn-info">
										<i class="fas fa-pencil-alt"></i>
									</button>
								</form>
							</td>';
							if ($rows['id']!=1){
								$tabla.='
									<td>
										<form action="'.SERVERURL.'ajax/administradorAjax.php" method="POST" class="FormularioAjax" data-form="delete" entype="multipart/form-data" autocomplete="off" style="float: right;">
											<input type="hidden" name="usuario-id-eliminar" value="'.mainModel::encryption($rows['id']).'">
											<button type="submit" class="btn btn-danger">
												<i class="fas fa-times"></i>
											</button>
											<div class="RespuestaAjax"></div>
										</form>
									</td>';
							}
							$tabla.='</tr>';
							$contador++;
						}
			}else{
				if($total>=1){
					$tabla.='<script> window.location="'.SERVERURL.$paginaurl.'/" </script>;';
				}else{
					$tabla.='
						<tr>
							<td></td>
							<td>No hay registros en el sistema</td>
							<td></td>
							<td></td>
						</tr>
					';	
				}
			}

			$tabla.='</tbody></table>';

			if($total>=1 && $pagina<=$Npaginas){
				$tabla.='<nav aria-label="Page navigation example"><ul class="pagination justify-content-center">';

				if($pagina==1){
					$tabla.='<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">Anterior</a></li>';
				}else{
					$tabla.='<li class="page-item"><a class="page-link" href="'.SERVERURL.$paginaurl.'/'.($pagina-1).'/">Anterior</a></li>';
				}

				for($i=1; $i<=$Npaginas; $i++){
					if($pagina==$i){
						$tabla.='<li class="page-item active"><a class="page-link" href="'.SERVERURL.$paginaurl.'/'.$i.'/">'.$i.'</a></li>';
					}else{
						$tabla.='<li class="page-item"><a class="page-link" href="'.SERVERURL.$paginaurl.'/'.$i.'/">'.$i.'</a></li>';
					}
				}

				if($pagina==$Npaginas){
					$tabla.='<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">Siguiente</a></li>';
				}else{
					$tabla.='<li class="page-item"><a class="page-link" href="'.SERVERURL.$paginaurl.'/'.($pagina+1).'/">Siguiente</a></li>';
				}
				$tabla.='</ul></nav>';
			}

			return $tabla;
		}

		//eliminar administrador
		public function eliminar_administrador_controlador(){
			$codigo=mainModel::decryption($_POST['usuario-id-eliminar']);
			$codigo=mainModel::limpiar_cadena($codigo);
			$DelAdmin=administradorModelo::eliminar_administrador_modelo($codigo);
			if($DelAdmin->rowCount()>=1)
			{
				session_start(['name'=>'adminsoswebstore']);
				$sesid = $_SESSION['id'];
				if ($codigo == $sesid)
				{
					$alerta=[
						"Alerta"=>"loguear",
						"Titulo"=>"Administrador eliminado",
						"Texto"=>"El administrador fue eliminado del sistema con éxito",
						"Tipo"=>"success"
					];
				}
				else
				{
					$alerta=[
						"Alerta"=>"recargar",
						"Titulo"=>"Administrador eliminado",
						"Texto"=>"El administrador fue eliminado del sistema con éxito",
						"Tipo"=>"success"
					];
				}
			}
			else
			{
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"No podemos eliminar este administrador en este momento",
					"Tipo"=>"error"
				];
			}
			return mainModel::sweet_alert($alerta);
		}

		public function desencriptar($dato)
		{
			$desencriptado = mainModel::decryption($dato);
			return $desencriptado;
		}




		//editar foto administradores
		public function editar_administrador_foto_controlador()
		{
			$codigo=mainModel::decryption($_POST['usuario-id-editar']);
			$codigo=mainModel::limpiar_cadena($codigo);
			$BorrarFoto=administradorModelo::eliminar_foto_modelo($codigo);
			$foto=$_FILES['usuario-foto-editar'];
			if ($foto["error"] > 0)
			{
				if ($foto["error"] == 1)
				{
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrió un error inesperado",
						"Texto"=>"El servidor ha rechazado la imagen por que excede el tamaño admitido",
						"Tipo"=>"error"
					];
				}
				elseif ($foto["error"] == 2)
				{
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrió un error inesperado",
						"Texto"=>"La imagen se ha rechazado por que excede el tamaño admitido",
						"Tipo"=>"error"
					];
				}
				elseif ($foto["error"] == 3)
				{
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrió un error inesperado",
						"Texto"=>"La imagen no se ha logrado subir correctamente",
						"Tipo"=>"error"
					];
				}
				elseif ($foto["error"] == 4)
				{
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrió un error inesperado",
						"Texto"=>"La imagen no se ha logrado subir correctamente",
						"Tipo"=>"error"
					];
				}
				elseif ($foto["error"] == 6)
				{
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrió un error inesperado",
						"Texto"=>"Error al encontrar el archivo temporal",
						"Tipo"=>"error"
					];
				}
				elseif ($foto["error"] == 7)
				{
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrió un error inesperado",
						"Texto"=>"La imagen no se ha logrado subir correctamente",
						"Tipo"=>"error"
					];
				}
				elseif ($foto["error"] == 8)
				{
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrió un error inesperado",
						"Texto"=>"La imagen no se ha logrado subir correctamente",
						"Tipo"=>"error"
					];
				}
				else
				{
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrió un error inesperado",
						"Texto"=>"Ha ocurrido un error desconocido al subir el archivo la imagen",
						"Tipo"=>"error"
					];
				}
			}
			else
			{
				$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png", "image/PNG");
				if (in_array($foto['type'], $permitidos))
				{
					$hora = getdate();
					$fechaactual  = date("dmY");
					$no_aleatorio  = rand(10, 999);
					$extension = str_replace("image/", "", $foto['type']);
					$ruta = "../vistas/assets/fotos/foto-".$hora['hours'].$hora['minutes'].$hora['seconds'].'-'.$fechaactual.'-'.$no_aleatorio.'.'.$extension;
					if (!file_exists($ruta))
					{
						$resultado = @move_uploaded_file($foto["tmp_name"], $ruta);
						if ($resultado)
						{
							$fotobd = "foto-".$hora['hours'].$hora['minutes'].$hora['seconds'].'-'.$fechaactual.'-'.$no_aleatorio.'.'.$extension;
							$cambiar=administradorModelo::editar_foto_modelo($codigo, $fotobd);
							if($cambiar->rowCount()>=1)
							{
								session_start(['name'=>'adminsoswebstore']);
								$_SESSION['foto']=$fotobd;
								$alerta=[
									"Alerta"=>"recargar",
									"Titulo"=>"¡Administrador Actualizado!",
									"Texto"=>"La foto se actualizo correctamente",
									"Tipo"=>"success"
								];
							}
							else
							{
								$alerta=[
									"Alerta"=>"simple",
									"Titulo"=>"Ocurrió un error inesperado",
									"Texto"=>"No hemos podido actualizar la foto del administrador",
									"Tipo"=>"error"
								];
							}
						}
						else
						{
							$alerta=[
								"Alerta"=>"simple",
								"Titulo"=>"Ocurrió un error inesperado",
								"Texto"=>"Ha ocurrido un error desconocido al subir el archivo la imagen",
								"Tipo"=>"error"
							];
						}
					}
					else
					{
						$alerta=[
							"Alerta"=>"simple",
							"Titulo"=>"Ocurrió un error inesperado",
							"Texto"=>"Ya existe la imagen en el sistema, reintente por favor.",
							"Tipo"=>"error"
						];
					}
				}
				else
				{
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrió un error inesperado",
						"Texto"=>"El archivo tiene una extension no permitida, las permitidas son:<br>jpg<br>jpeg<br>png<br>gif",
						"Tipo"=>"error"
					];
				}
			}
			return mainModel::sweet_alert($alerta);
		}


		// Controlador para paginar noticias
		public function paginador_noticias_controlador($pagina,$registros,$busqueda){

			$pagina=mainModel::limpiar_cadena($pagina);
			$registros=mainModel::limpiar_cadena($registros);
			$busqueda=mainModel::limpiar_cadena($busqueda);
			$tabla="";

			$pagina= (isset($pagina) && $pagina>0) ? (int) $pagina : 1;
			$inicio= ($pagina>0) ? (($pagina*$registros)-$registros) : 0;

			if(isset($busqueda) && $busqueda!=""){
				$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM noticias WHERE titulo LIKE '%$busqueda%' OR contenido LIKE '%$busqueda%' OR fecha LIKE '%$busqueda%' ORDER BY fecha DESC LIMIT $inicio,$registros";
				$paginaurl="buscar-noticia";
			}else{
				$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM noticias ORDER BY id DESC LIMIT $inicio,$registros";
				$paginaurl="noticias";
			}

			$conexion = mainModel::conectar();

			$datos = $conexion->query($consulta);
			$datos= $datos->fetchAll();

			$total= $conexion->query("SELECT FOUND_ROWS()");
			$total= (int) $total->fetchColumn();

			$Npaginas= ceil($total/$registros);

			$tabla.='
			<div class="table-responsive">
				<table class="table table-hover text-center">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th class="text-center">TITULO</th>
							<th class="text-center">Fecha</th>
							<th class="text-center">EDITAR</th>
							<th class="text-center">ELIMINAR</th>
							';
							
			$tabla.='</tr>
					</thead>
					<tbody>
			';

			if($total>=1 && $pagina<=$Npaginas){
				$contador=$inicio+1;
				foreach($datos as $rows){
					$tabla.='
						<tr>
							<td>'.$contador.'</td>
							<td>'.$rows['titulo'].'</td>
							<td>'.$rows['fecha'].'</td>
							<td>
								<form action="'.SERVERURL.'editar-noticia/" method="POST"  entype="multipart/form-data" autocomplete="off">
									<input type="hidden" name="noticia-id-editar" value="'.mainModel::encryption($rows['id']).'">
									<button type="submit" class="btn btn-success">
										<i class="zmdi zmdi-refresh"></i>
									</button>
								</form>
							</td>
							<td>
								<form action="'.SERVERURL.'ajax/noticiaAjax.php" method="POST" class="FormularioAjax" data-form="delete" entype="multipart/form-data" autocomplete="off">
									<input type="hidden" name="noticia-id-eliminar" value="'.mainModel::encryption($rows['id']).'">
									<input type="hidden" name="privilegio-admin" value="asd">
									<button type="submit" class="btn btn-danger">
										<i class="zmdi zmdi-delete"></i>
									</button>
									<div class="RespuestaAjax"></div>
								</form>
							</td>';
							$tabla.='</tr>';
							$contador++;
						}
			}else{
				if($total>=1){
					$tabla.='<script> window.location="'.SERVERURL.$paginaurl.'/" </script>;';
				}else{
					$tabla.='
						<tr>
							<td colspan="5">No hay registros en el sistema</td>
						</tr>
					';	
				}
			}

			$tabla.='</tbody></table></div>';

			if($total>=1 && $pagina<=$Npaginas){
				$tabla.='<nav class="text-center"><ul class="pagination pagination-sm">';

				if($pagina==1){
					$tabla.='<li class="disabled"><a><i class="zmdi zmdi-arrow-left"></i></a></li>';
				}else{
					$tabla.='<li><a href="'.SERVERURL.$paginaurl.'/'.($pagina-1).'/"><i class="zmdi zmdi-arrow-left"></i></a></li>';
				}

				for($i=1; $i<=$Npaginas; $i++){
					if($pagina==$i){
						$tabla.='<li class="active"><a href="'.SERVERURL.$paginaurl.'/'.$i.'/">'.$i.'</a></li>';
					}else{
						$tabla.='<li><a href="'.SERVERURL.$paginaurl.'/'.$i.'/">'.$i.'</a></li>';
					}
				}

				if($pagina==$Npaginas){
					$tabla.='<li class="disabled"><a><i class="zmdi zmdi-arrow-right"></i></a></li>';
				}else{
					$tabla.='<li><a href="'.SERVERURL.$paginaurl.'/'.($pagina+1).'/"><i class="zmdi zmdi-arrow-right"></i></a></li>';
				}
				$tabla.='</ul></nav>';
			}

			return $tabla;
		}
		//Controlador para agregar administrador
		public function agregar_noticia_controlador()
		{
			$titulo=mainModel::limpiar_cadena($_POST['noticia-titulo-nueva']);
			$contenido=$_POST['noticia-contenido-nueva'];
			$foto=$_FILES['noticia-imagen-nueva'];
			if ($foto["error"] > 0)
			{
				if ($foto["error"] == 1)
				{
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrió un error inesperado",
						"Texto"=>"El servidor ha rechazado la imagen por que excede el tamaño admitido",
						"Tipo"=>"error"
					];
				}
				elseif ($foto["error"] == 2)
				{
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrió un error inesperado",
						"Texto"=>"La imagen se ha rechazado por que excede el tamaño admitido",
						"Tipo"=>"error"
					];
				}
				elseif ($foto["error"] == 3)
				{
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrió un error inesperado",
						"Texto"=>"La imagen no se ha logrado subir correctamente",
						"Tipo"=>"error"
					];
				}
				elseif ($foto["error"] == 4)
				{
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrió un error inesperado",
						"Texto"=>"La imagen no se ha logrado subir correctamente",
						"Tipo"=>"error"
					];
				}
				elseif ($foto["error"] == 6)
				{
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrió un error inesperado",
						"Texto"=>"Error al encontrar el archivo temporal",
						"Tipo"=>"error"
					];
				}
				elseif ($foto["error"] == 7)
				{
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrió un error inesperado",
						"Texto"=>"La imagen no se ha logrado subir correctamente",
						"Tipo"=>"error"
					];
				}
				elseif ($foto["error"] == 8)
				{
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrió un error inesperado",
						"Texto"=>"La imagen no se ha logrado subir correctamente",
						"Tipo"=>"error"
					];
				}
				else
				{
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrió un error inesperado",
						"Texto"=>"Ha ocurrido un error desconocido al subir el archivo la imagen",
						"Tipo"=>"error"
					];
				}
			}
			else
			{
				$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png", "image/PNG");
				if (in_array($foto['type'], $permitidos))
				{
					$hora = getdate();
					$fechaactual  = date("dmY");
					$no_aleatorio  = rand(10, 999);
					$extension = str_replace("image/", "", $foto['type']);
					$ruta = "../noticias/imagen-".$hora['hours'].$hora['minutes'].$hora['seconds'].'-'.$fechaactual.'-'.$no_aleatorio.'.'.$extension;
					if (!file_exists($ruta))
					{
						$resultado = @move_uploaded_file($foto["tmp_name"], $ruta);
						if ($resultado)
						{
							$fotobd = "imagen-".$hora['hours'].$hora['minutes'].$hora['seconds'].'-'.$fechaactual.'-'.$no_aleatorio.'.'.$extension;
							$fechahoy = date("d/m/Y");
							$horaactual = $hora['hours'].':'.$hora['minutes'];
							$fechaNoticia = $fechahoy.' a las '.$horaactual;
							session_start(['name'=>'adminsoswebstore']);
							$autor = $_SESSION['id'];
							$dataAN=[
								"Titulo"=>$titulo,
								"Contenido"=>$contenido,
								"Imagen"=>$fotobd,
								"Autor"=>$autor,
								"Fecha"=>$fechaNoticia
							];
							$guardarNoticia=administradorModelo::agregar_noticia_modelo($dataAN);
							if($guardarNoticia->rowCount()>=1)
							{
								$alerta=[
									"Alerta"=>"recargar",
									"Titulo"=>"¡Noticia registrada!",
									"Texto"=>"La noticia se registró con éxito en el sistema",
									"Tipo"=>"success"
								];
							}
							else
							{
								$alerta=[
									"Alerta"=>"simple",
									"Titulo"=>"Ocurrió un error inesperado",
									"Texto"=>"No hemos podido registrar la noticia",
									"Tipo"=>"error"
								];
							}
						}
						else
						{
							$alerta=[
								"Alerta"=>"simple",
								"Titulo"=>"Ocurrió un error inesperado",
								"Texto"=>"Ha ocurrido un error desconocido al subir el archivo la imagen",
								"Tipo"=>"error"
							];
						}
					}
					else
					{
						$alerta=[
							"Alerta"=>"simple",
							"Titulo"=>"Ocurrió un error inesperado",
							"Texto"=>"Ya existe la imagen en el sistema, reintente por favor.",
							"Tipo"=>"error"
						];
					}
				}
				else
				{
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrió un error inesperado",
						"Texto"=>"El archivo tiene una extension no permitida, las permitidas son:<br>jpg<br>jpeg<br>png<br>gif",
						"Tipo"=>"error"
					];
				}
			}
			return mainModel::sweet_alert($alerta);
		}
		//eliminar noticia
		public function eliminar_noticia_controlador(){
			$codigo=mainModel::decryption($_POST['noticia-id-eliminar']);
			$codigo=mainModel::limpiar_cadena($codigo);
			$BorrarFoto=administradorModelo::eliminar_foto_noticia_modelo($codigo);
			if ($BorrarFoto == false)
			{
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrio un error inesperado",
					"Texto"=>"La iamgen de la noticia no se ha eliminado, para evitar archivos basura eliminela manualmente",
					"Tipo"=>"success"
				];
			}
			$DelNoticia=administradorModelo::eliminar_noticia_modelo($codigo);
			if($DelNoticia->rowCount()>=1)
			{
				$alerta=[
					"Alerta"=>"recargar",
					"Titulo"=>"Noticia eliminada",
					"Texto"=>"La noticia fue eliminada del sistema con éxito",
					"Tipo"=>"success"
				];
			}
			else
			{
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"No podemos eliminar esta noticia en este momento",
					"Tipo"=>"error"
				];
			}
			return mainModel::sweet_alert($alerta);
		}
		//Obtener info de una noticia
		public function obtener_info_noticias_controlador($codigo)
		{
			$sql=mainModel::conectar()->prepare("SELECT * FROM noticias WHERE id=:Codigo");
			$clave=mainModel::decryption($codigo);
			$sql->bindParam(":Codigo",$clave);
			$sql->execute();
			return $sql;
		}
		//editar info noticia
		public function editar_noticia_controlador()
		{
			$codigo=mainModel::decryption($_POST['noticia-id-editar']);
			$codigo=mainModel::limpiar_cadena($codigo);
			$titulo=mainModel::limpiar_cadena($_POST['noticia-titulo-editar']);
			$contenido=($_POST['noticia-contenido-editar']);
			$datosEditar =
			[
				"Clave"=>$codigo,
				"Titulo"=>$titulo,
				"Contenido"=>$contenido
			];
			$ActNoticia=administradorModelo::editar_noticia_modelo($datosEditar);
			if($ActNoticia->rowCount()>=1)
			{
				$alerta=[
					"Alerta"=>"recargar",
					"Titulo"=>"Noticia Actualizada",
					"Texto"=>"La noticia fue editada con éxito",
					"Tipo"=>"success"
				];
			}
			else
			{
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"No se puede actualizar esta noticia en este momento, esto puede ser un error del sistema pero te recomendamos revisar la información que proporcionaste.",
					"Tipo"=>"error"
				];
			}
			return mainModel::sweet_alert($alerta);
		}
		//editar foto administradores
		public function editar_noticia_imagen_controlador()
		{
			$codigo=mainModel::decryption($_POST['noticia-id-editar']);
			$codigo=mainModel::limpiar_cadena($codigo);
			$BorrarFoto=administradorModelo::eliminar_foto_noticia_modelo($codigo);
			$foto=$_FILES['noticia-imagen-editar'];
			if ($foto["error"] > 0)
			{
				if ($foto["error"] == 1)
				{
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrió un error inesperado",
						"Texto"=>"El servidor ha rechazado la imagen por que excede el tamaño admitido",
						"Tipo"=>"error"
					];
				}
				elseif ($foto["error"] == 2)
				{
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrió un error inesperado",
						"Texto"=>"La imagen se ha rechazado por que excede el tamaño admitido",
						"Tipo"=>"error"
					];
				}
				elseif ($foto["error"] == 3)
				{
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrió un error inesperado",
						"Texto"=>"La imagen no se ha logrado subir correctamente",
						"Tipo"=>"error"
					];
				}
				elseif ($foto["error"] == 4)
				{
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrió un error inesperado",
						"Texto"=>"La imagen no se ha logrado subir correctamente",
						"Tipo"=>"error"
					];
				}
				elseif ($foto["error"] == 6)
				{
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrió un error inesperado",
						"Texto"=>"Error al encontrar el archivo temporal",
						"Tipo"=>"error"
					];
				}
				elseif ($foto["error"] == 7)
				{
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrió un error inesperado",
						"Texto"=>"La imagen no se ha logrado subir correctamente",
						"Tipo"=>"error"
					];
				}
				elseif ($foto["error"] == 8)
				{
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrió un error inesperado",
						"Texto"=>"La imagen no se ha logrado subir correctamente",
						"Tipo"=>"error"
					];
				}
				else
				{
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrió un error inesperado",
						"Texto"=>"Ha ocurrido un error desconocido al subir el archivo la imagen",
						"Tipo"=>"error"
					];
				}
			}
			else
			{
				$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png", "image/PNG");
				if (in_array($foto['type'], $permitidos))
				{
					$hora = getdate();
					$fechaactual  = date("dmY");
					$no_aleatorio  = rand(10, 999);
					$extension = str_replace("image/", "", $foto['type']);
					$ruta = "../noticias/imagen-".$hora['hours'].$hora['minutes'].$hora['seconds'].'-'.$fechaactual.'-'.$no_aleatorio.'.'.$extension;
					if (!file_exists($ruta))
					{
						$resultado = @move_uploaded_file($foto["tmp_name"], $ruta);
						if ($resultado)
						{
							$fotobd = "imagen-".$hora['hours'].$hora['minutes'].$hora['seconds'].'-'.$fechaactual.'-'.$no_aleatorio.'.'.$extension;
							$cambiar=administradorModelo::editar_imagen_modelo($codigo, $fotobd);
							if($cambiar->rowCount()>=1)
							{
								$alerta=[
									"Alerta"=>"recargar",
									"Titulo"=>"¡Noticia Actualizada!",
									"Texto"=>"La imagen se actualizo correctamente",
									"Tipo"=>"success"
								];
							}
							else
							{
								$alerta=[
									"Alerta"=>"simple",
									"Titulo"=>"Ocurrió un error inesperado",
									"Texto"=>"No hemos podido actualizar la imagen de la noticia",
									"Tipo"=>"error"
								];
							}
						}
						else
						{
							$alerta=[
								"Alerta"=>"simple",
								"Titulo"=>"Ocurrió un error inesperado",
								"Texto"=>"Ha ocurrido un error desconocido al subir el archivo la imagen",
								"Tipo"=>"error"
							];
						}
					}
					else
					{
						$alerta=[
							"Alerta"=>"simple",
							"Titulo"=>"Ocurrió un error inesperado",
							"Texto"=>"Ya existe la imagen en el sistema, reintente por favor.",
							"Tipo"=>"error"
						];
					}
				}
				else
				{
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrió un error inesperado",
						"Texto"=>"El archivo tiene una extension no permitida, las permitidas son:<br>jpg<br>jpeg<br>png<br>gif",
						"Tipo"=>"error"
					];
				}
			}
			return mainModel::sweet_alert($alerta);
		}

		// CONTROLADORES PARA CATEGORIAS
		public function agregar_categoria_controlador()
		{
			$nombre=mainModel::limpiar_cadena($_POST['categoria-nombre-nueva']);
			$slug=mainModel::limpiar_cadena($_POST['categoria-slug-nueva']);
			$descripcion=mainModel::limpiar_cadena($_POST['categoria-descripcion-nueva']);
			$padre=mainModel::limpiar_cadena($_POST['categoria-padre-nueva']);
			$icono=mainModel::limpiar_cadena($_POST['categoria-icono-nueva']);

			$verificar=administradorModelo::verificar_categoria_slug_disponible($slug);
			if ($verificar->rowCount() > 0)
			{
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error",
					"Texto"=>"El slug que ingresaste no esta disponible",
					"Tipo"=>"error"
				];
			}
			else
			{
				$dataAC=[
					"Nombre"=>$nombre,
					"Slug"=>$slug,
					"Descripcion"=>$descripcion,
					"Padre"=>$padre,
					"Icono"=>$icono
				];
				$guardarCategoria=administradorModelo::agregar_categoria_modelo($dataAC);
				if($guardarCategoria->rowCount()>=1)
				{
					$alerta=[
						"Alerta"=>"limpiar",
						"Titulo"=>"Categoria añadida",
						"Texto"=>"Se ha guardado correctamente la categoría en la tienda",
						"Tipo"=>"success"
					];
				}
				else
				{
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrió un error inesperado",
						"Texto"=>"No se ha podido guardar la categoría",
						"Tipo"=>"error"
					];
				}
			}

			return mainModel::sweet_alert($alerta);
		}

		public function paginador_categorias_controlador($pagina,$registros,$busqueda){

			$pagina=mainModel::limpiar_cadena($pagina);
			$registros=mainModel::limpiar_cadena($registros);
			$busqueda=mainModel::limpiar_cadena($busqueda);
			$tabla="";

			$pagina= (isset($pagina) && $pagina>0) ? (int) $pagina : 1;
			$inicio= ($pagina>0) ? (($pagina*$registros)-$registros) : 0;

			if(isset($busqueda) && $busqueda!=""){
				$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM taxonomias WHERE (nombre LIKE '%$busqueda%' OR slug LIKE '%$busqueda%' OR descripcion LIKE '%$busqueda%') AND taxonomia = 'categoria' ORDER BY id ASC LIMIT $inicio,$registros";
				$paginaurl="buscar-categorias";
			}else{
				$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM taxonomias WHERE taxonomia = 'categoria' ORDER BY id DESC LIMIT $inicio,$registros";
				$paginaurl="categorias";
			}

			$conexion = mainModel::conectar();

			$datos = $conexion->query($consulta);
			$datos= $datos->fetchAll();

			$total= $conexion->query("SELECT FOUND_ROWS()");
			$total= (int) $total->fetchColumn();

			$Npaginas= ceil($total/$registros);

			$tabla.='
					<table class="table">
						<thead>
							<tr>
								<th>ID</th>
								<th>Nombre</th>
								<th>Slug</th>
								<th>Editar</th>
								<th>Eliminar</th>
							</tr>
						</thead>
						<tbody>
				';

			if($total>=1 && $pagina<=$Npaginas){
				$contador=$inicio+1;
				foreach($datos as $rows){
					$tabla.='
						<tr>
							<td>'.$rows['id'].'</td>
							<td>'.$rows['nombre'].'</td>
							<td>'.$rows['slug'].'</td>
							<td>
								<form action="'.SERVERURL.'editar-categoria/" method="POST"  entype="multipart/form-data" autocomplete="off" style="display: inherit;">
									<input type="hidden" name="categoria-id-editar" value="'.$rows['id'].'">
									<button type="submit" class="btn btn-info">
										<i class="fas fa-pencil-alt"></i>
									</button>
								</form>
							</td>
							<td>
								<form action="'.SERVERURL.'ajax/administradorAjax.php" method="POST" class="FormularioAjax" data-form="delete" entype="multipart/form-data" autocomplete="off" style="float: right;">
									<input type="hidden" name="categoria-id-eliminar" value="'.$rows['id'].'">
									<button type="submit" class="btn btn-danger">
										<i class="fas fa-times"></i>
									</button>
									<div class="RespuestaAjax"></div>
								</form>
							</td>';
							$tabla.='</tr>';
							$contador++;
						}
			}else{
				if($total>=1){
					$tabla.='<script> window.location="'.SERVERURL.$paginaurl.'/" </script>;';
				}else{
					$tabla.='
						<tr>
							<td></td>
							<td>No hay registros en el sistema</td>
							<td></td>
							<td></td>
						</tr>
					';	
				}
			}

			$tabla.='</tbody></table>';

			if($total>=1 && $pagina<=$Npaginas){
				$tabla.='<nav aria-label="Page navigation example"><ul class="pagination justify-content-center">';

				if($pagina==1){
					$tabla.='<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">Anterior</a></li>';
				}else{
					$tabla.='<li class="page-item"><a class="page-link" href="'.SERVERURL.$paginaurl.'/'.($pagina-1).'/">Anterior</a></li>';
				}

				for($i=1; $i<=$Npaginas; $i++){
					if($pagina==$i){
						$tabla.='<li class="page-item active"><a class="page-link" href="'.SERVERURL.$paginaurl.'/'.$i.'/">'.$i.'</a></li>';
					}else{
						$tabla.='<li class="page-item"><a class="page-link" href="'.SERVERURL.$paginaurl.'/'.$i.'/">'.$i.'</a></li>';
					}
				}

				if($pagina==$Npaginas){
					$tabla.='<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">Siguiente</a></li>';
				}else{
					$tabla.='<li class="page-item"><a class="page-link" href="'.SERVERURL.$paginaurl.'/'.($pagina+1).'/">Siguiente</a></li>';
				}
				$tabla.='</ul></nav>';
			}

			return $tabla;
		}

		public function eliminar_categoria_controlador(){
			$codigo=mainModel::limpiar_cadena($_POST['categoria-id-eliminar']);
			$DelCat=administradorModelo::eliminar_taxonomia_modelo($codigo);
			if($DelCat->rowCount()>=1)
			{
				$alerta=[
					"Alerta"=>"recargar",
					"Titulo"=>"Categoría eliminada",
					"Texto"=>"La categoría fue eliminada del sistema con éxito",
					"Tipo"=>"success"
				];
			}
			else
			{
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"No se ha podido eliminar esta categoría en este momento",
					"Tipo"=>"error"
				];
			}
			return mainModel::sweet_alert($alerta);
		}

		public function editar_categoria_controlador()
		{
			$codigo=mainModel::limpiar_cadena($_POST['categoria-id-editar']);
			$nombre=mainModel::limpiar_cadena($_POST['categoria-nombre-editar']);
			$slug=mainModel::limpiar_cadena($_POST['categoria-slug-editar']);
			$descripcion=mainModel::limpiar_cadena($_POST['categoria-descripcion-editar']);
			$padre=mainModel::limpiar_cadena($_POST['categoria-padre-editar']);
			$icono=mainModel::limpiar_cadena($_POST['categoria-icono-editar']);
			$verificar=administradorModelo::verificar_categoria_editar_slug_disponible($codigo, $slug);
			if ($verificar->rowCount() > 0)
			{
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error",
					"Texto"=>"El slug que ingresaste no esta disponible, escoge otra por favor.",
					"Tipo"=>"error"
				];
			}
			else
			{
				$datosEditar =
				[
					"Codigo"=>$codigo,
					"Nombre"=>$nombre,
					"Slug"=>$slug,
					"Descripcion"=>$descripcion,
					"Padre"=>$padre,
					"Icono"=>$icono
				];
				$ActAdmin=administradorModelo::editar_taxonomia_modelo($datosEditar);
				if($ActAdmin->rowCount()>=1)
				{
					$alerta=[
						"Alerta"=>"recargar",
						"Titulo"=>"Datos Actualizados",
						"Texto"=>"Los datos fueron editados con éxito",
						"Tipo"=>"success"
					];
				}
				else
				{
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrió un error inesperado",
						"Texto"=>"No se puede editar en este momento, esto puede ser un error del sistema pero te recomendamos revisar la información que proporcionaste.",
						"Tipo"=>"error"
					];
				}
			}
			return mainModel::sweet_alert($alerta);
		}

		// CONTROLADORES PARA ETIQUETAS
		public function agregar_etiqueta_controlador()
		{
			$nombre=mainModel::limpiar_cadena($_POST['etiqueta-nombre-nueva']);
			$slug=mainModel::limpiar_cadena($_POST['etiqueta-slug-nueva']);
			$descripcion=mainModel::limpiar_cadena($_POST['etiqueta-descripcion-nueva']);

			$verificar=administradorModelo::verificar_etiqueta_slug_disponible($slug);
			if ($verificar->rowCount() > 0)
			{
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error",
					"Texto"=>"El slug que ingresaste no esta disponible",
					"Tipo"=>"error"
				];
			}
			else
			{
				$dataAC=[
					"Nombre"=>$nombre,
					"Slug"=>$slug,
					"Descripcion"=>$descripcion
				];
				$guardarEtiqueta=administradorModelo::agregar_etiqueta_modelo($dataAC);
				if($guardarEtiqueta->rowCount()>=1)
				{
					$alerta=[
						"Alerta"=>"limpiar",
						"Titulo"=>"Etiqueta añadida",
						"Texto"=>"Se ha guardado correctamente la etiqueta en la tienda",
						"Tipo"=>"success"
					];
				}
				else
				{
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrió un error inesperado",
						"Texto"=>"No se ha podido guardar la etiqueta",
						"Tipo"=>"error"
					];
				}
			}

			return mainModel::sweet_alert($alerta);
		}

		public function paginador_etiquetas_controlador($pagina,$registros,$busqueda){

			$pagina=mainModel::limpiar_cadena($pagina);
			$registros=mainModel::limpiar_cadena($registros);
			$busqueda=mainModel::limpiar_cadena($busqueda);
			$tabla="";

			$pagina= (isset($pagina) && $pagina>0) ? (int) $pagina : 1;
			$inicio= ($pagina>0) ? (($pagina*$registros)-$registros) : 0;

			if(isset($busqueda) && $busqueda!=""){
				$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM taxonomias WHERE (nombre LIKE '%$busqueda%' OR slug LIKE '%$busqueda%' OR descripcion LIKE '%$busqueda%') AND taxonomia = 'etiqueta' ORDER BY id ASC LIMIT $inicio,$registros";
				$paginaurl="buscar-etiquetas";
			}else{
				$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM taxonomias WHERE taxonomia = 'etiqueta' ORDER BY id DESC LIMIT $inicio,$registros";
				$paginaurl="etiquetas";
			}

			$conexion = mainModel::conectar();

			$datos = $conexion->query($consulta);
			$datos= $datos->fetchAll();

			$total= $conexion->query("SELECT FOUND_ROWS()");
			$total= (int) $total->fetchColumn();

			$Npaginas= ceil($total/$registros);

			$tabla.='
					<table class="table">
						<thead>
							<tr>
								<th>ID</th>
								<th>Nombre</th>
								<th>Slug</th>
								<th>Editar</th>
								<th>Eliminar</th>
							</tr>
						</thead>
						<tbody>
				';

			if($total>=1 && $pagina<=$Npaginas){
				$contador=$inicio+1;
				foreach($datos as $rows){
					$tabla.='
						<tr>
							<td>'.$rows['id'].'</td>
							<td>'.$rows['nombre'].'</td>
							<td>'.$rows['slug'].'</td>
							<td>
								<form action="'.SERVERURL.'editar-etiqueta/" method="POST"  entype="multipart/form-data" autocomplete="off" style="display: inherit;">
									<input type="hidden" name="etiqueta-id-editar" value="'.$rows['id'].'">
									<button type="submit" class="btn btn-info">
										<i class="fas fa-pencil-alt"></i>
									</button>
								</form>
							</td>
							<td>
								<form action="'.SERVERURL.'ajax/administradorAjax.php" method="POST" class="FormularioAjax" data-form="delete" entype="multipart/form-data" autocomplete="off" style="float: right;">
									<input type="hidden" name="etiqueta-id-eliminar" value="'.$rows['id'].'">
									<button type="submit" class="btn btn-danger">
										<i class="fas fa-times"></i>
									</button>
									<div class="RespuestaAjax"></div>
								</form>
							</td>';
							$tabla.='</tr>';
							$contador++;
						}
			}else{
				if($total>=1){
					$tabla.='<script> window.location="'.SERVERURL.$paginaurl.'/" </script>;';
				}else{
					$tabla.='
						<tr>
							<td></td>
							<td>No hay registros en el sistema</td>
							<td></td>
							<td></td>
						</tr>
					';	
				}
			}

			$tabla.='</tbody></table>';

			if($total>=1 && $pagina<=$Npaginas){
				$tabla.='<nav aria-label="Page navigation example"><ul class="pagination justify-content-center">';

				if($pagina==1){
					$tabla.='<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">Anterior</a></li>';
				}else{
					$tabla.='<li class="page-item"><a class="page-link" href="'.SERVERURL.$paginaurl.'/'.($pagina-1).'/">Anterior</a></li>';
				}

				for($i=1; $i<=$Npaginas; $i++){
					if($pagina==$i){
						$tabla.='<li class="page-item active"><a class="page-link" href="'.SERVERURL.$paginaurl.'/'.$i.'/">'.$i.'</a></li>';
					}else{
						$tabla.='<li class="page-item"><a class="page-link" href="'.SERVERURL.$paginaurl.'/'.$i.'/">'.$i.'</a></li>';
					}
				}

				if($pagina==$Npaginas){
					$tabla.='<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">Siguiente</a></li>';
				}else{
					$tabla.='<li class="page-item"><a class="page-link" href="'.SERVERURL.$paginaurl.'/'.($pagina+1).'/">Siguiente</a></li>';
				}
				$tabla.='</ul></nav>';
			}

			return $tabla;
		}

		public function eliminar_etiqueta_controlador(){
			$codigo=mainModel::limpiar_cadena($_POST['etiqueta-id-eliminar']);
			$DelCat=administradorModelo::eliminar_taxonomia_modelo($codigo);
			if($DelCat->rowCount()>=1)
			{
				$alerta=[
					"Alerta"=>"recargar",
					"Titulo"=>"Etiqueta eliminada",
					"Texto"=>"La etiqueta fue eliminada del sistema con éxito",
					"Tipo"=>"success"
				];
			}
			else
			{
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"No se ha podido eliminar esta etiqueta en este momento",
					"Tipo"=>"error"
				];
			}
			return mainModel::sweet_alert($alerta);
		}

		public function editar_etiqueta_controlador()
		{
			$codigo=mainModel::limpiar_cadena($_POST['etiqueta-id-editar']);
			$nombre=mainModel::limpiar_cadena($_POST['etiqueta-nombre-editar']);
			$slug=mainModel::limpiar_cadena($_POST['etiqueta-slug-editar']);
			$descripcion=mainModel::limpiar_cadena($_POST['etiqueta-descripcion-editar']);
			$verificar=administradorModelo::verificar_etiqueta_editar_slug_disponible($codigo, $slug);
			if ($verificar->rowCount() > 0)
			{
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error",
					"Texto"=>"El slug que ingresaste no esta disponible, escoge otra por favor.",
					"Tipo"=>"error"
				];
			}
			else
			{
				$datosEditar =
				[
					"Codigo"=>$codigo,
					"Nombre"=>$nombre,
					"Slug"=>$slug,
					"Descripcion"=>$descripcion
				];
				$ActAdmin=administradorModelo::editar_taxonomia_modelo($datosEditar);
				if($ActAdmin->rowCount()>=1)
				{
					$alerta=[
						"Alerta"=>"recargar",
						"Titulo"=>"Datos Actualizados",
						"Texto"=>"Los datos fueron editados con éxito",
						"Tipo"=>"success"
					];
				}
				else
				{
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrió un error inesperado",
						"Texto"=>"No se puede editar en este momento, esto puede ser un error del sistema pero te recomendamos revisar la información que proporcionaste.",
						"Tipo"=>"error"
					];
				}
			}
			return mainModel::sweet_alert($alerta);
		}


		
		// CONTROLADORES PARA TAXONOMIAS
		public function obtener_info_taxonomia_controlador($codigo)
		{
			$sql=mainModel::conectar()->prepare("SELECT * FROM taxonomias WHERE id=:Codigo");
			$sql->bindParam(":Codigo",$codigo);
			$sql->execute();
			return $sql;
		}
	}