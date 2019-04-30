<?php
	if($peticionAjax){
		require_once "../modelos/administradorModelo.php";
	}else{
		require_once "./modelos/administradorModelo.php";
	}

	class administradorControlador extends administradorModelo
	{

		//CONTROLADORES USUARIOS

		public function obtener_info_usuarios_controlador($codigo)
		{
			$sql=mainModel::conectar()->prepare("SELECT * FROM usuarios WHERE id=:Codigo");
			$clave=mainModel::decryption($codigo);
			$sql->bindParam(":Codigo",$clave);
			$sql->execute();
			return $sql;
		}


		public function obtener_info_perfil_controlador($codigo)
		{
			$sql=mainModel::conectar()->prepare("SELECT * FROM usuarios WHERE id=:Codigo");
			$sql->bindParam(":Codigo",$codigo);
			$sql->execute();
			return $sql;
		}

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

		public function paginador_administrador_controlador($pagina,$registros,$busqueda){

			$pagina=mainModel::limpiar_cadena($pagina);
			$registros=mainModel::limpiar_cadena($registros);
			$busqueda=mainModel::limpiar_cadena($busqueda);
			$tabla="";

			$pagina= (isset($pagina) && $pagina>0) ? (int) $pagina : 1;
			$inicio= ($pagina>0) ? (($pagina*$registros)-$registros) : 0;

			if(isset($busqueda) && $busqueda!=""){
				$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM usuarios WHERE nombre LIKE '%$busqueda%' OR apellido LIKE '%$busqueda%' OR usuario LIKE '%$busqueda%' OR correo LIKE '%$busqueda%' ORDER BY id ASC LIMIT $inicio,$registros";
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

		// CONTROLADORES PARA CATEGORIAS
		public function agregar_categoria_controlador()
		{
			$nombre=mainModel::limpiar_cadena($_POST['categoria-nombre-nueva']);
			$slug=mainModel::limpiar_cadena($_POST['categoria-slug-nueva']);
			$descripcion=mainModel::limpiar_cadena($_POST['categoria-descripcion-nueva']);
			$padre=mainModel::limpiar_cadena($_POST['categoria-padre-nueva']);
			$visitantes=mainModel::limpiar_cadena($_POST['categoria-visitantes-nueva']);
			$usuarios=mainModel::limpiar_cadena($_POST['categoria-usuarios-nueva']);
			$empresas=mainModel::limpiar_cadena($_POST['categoria-empresas-nueva']);
			$icono=mainModel::limpiar_cadena($_POST['categoria-icono-nueva']);
			$icono2=mainModel::limpiar_cadena($_POST['categoria-icono2-nueva']);
			if($padre>0)
			{
				$verificarPadre = administradorModelo::verificar_categoria_nuevo_padre_modelo($padre);
				if ($verificarPadre->rowCount() > 0){
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
							"Icono"=>$icono,
							"Icono2"=>$icono2
						];
						$guardarCategoria=administradorModelo::agregar_categoria_modelo($dataAC);
						if($guardarCategoria->rowCount()>=1)
						{
							$id_reglas = administradorModelo::obtener_categoria_id_slug_modelo($slug);
							if($id_reglas->rowCount()>=1)
							{
								$datos_categoria=$id_reglas->fetch();
								$dataReglas = [
									"Id"=>$datos_categoria['id'],
									"Visitantes"=>$visitantes,
									"Usuarios"=>$usuarios,
									"Empresas"=>$empresas
								];
								$guardarReglas = administradorModelo::agregar_regla_modelo($dataReglas);
								if($guardarReglas->rowCount()>=1)
								{
									if(isset($_POST['categoria-vista-nueva']))
									{							
										$agregarVistaCabecera = false;
										$vistaCabecera = array();
										if(isset($_POST['categoria-cabecera-nueva']) && $_POST['categoria-cabecera-nueva']>0)
										{
											array_push($vistaCabecera, array("cabecera"=>"cabecera","img"=>$_POST['categoria-cabecera-nueva']));
											$agregarVistaCabecera = true;
										}
										$agregarVistaSlide = false;
										$vistaSlide = array();
										if(isset($_POST['categoria-slide-url-1-nueva']) && isset($_POST['categoria-slide-img-1-nueva']) && $_POST['categoria-slide-img-1-nueva']>0)
										{
											array_push($vistaSlide, array("url"=>$_POST['categoria-slide-url-1-nueva'],"img"=>$_POST['categoria-slide-img-1-nueva']));
											$agregarVistaSlide = true;
										}
										if(isset($_POST['categoria-slide-url-2-nueva']) && isset($_POST['categoria-slide-img-2-nueva']) && $_POST['categoria-slide-img-2-nueva']>0)
										{
											array_push($vistaSlide, array("url"=>$_POST['categoria-slide-url-2-nueva'],"img"=>$_POST['categoria-slide-img-2-nueva']));
											$agregarVistaSlide = true;
										}
										if(isset($_POST['categoria-slide-url-3-nueva']) && isset($_POST['categoria-slide-img-3-nueva']) && $_POST['categoria-slide-img-3-nueva']>0)
										{
											array_push($vistaSlide, array("url"=>$_POST['categoria-slide-url-3-nueva'],"img"=>$_POST['categoria-slide-img-3-nueva']));
											$agregarVistaSlide = true;
										}
										if(isset($_POST['categoria-slide-url-4-nueva']) && isset($_POST['categoria-slide-img-4-nueva']) && $_POST['categoria-slide-img-4-nueva']>0)
										{
											array_push($vistaSlide, array("url"=>$_POST['categoria-slide-url-4-nueva'],"img"=>$_POST['categoria-slide-img-4-nueva']));
											$agregarVistaSlide = true;
										}
										if(isset($_POST['categoria-slide-url-5-nueva']) && isset($_POST['categoria-slide-img-5-nueva']) && $_POST['categoria-slide-img-5-nueva']>0)
										{
											array_push($vistaSlide, array("url"=>$_POST['categoria-slide-url-5-nueva'],"img"=>$_POST['categoria-slide-img-5-nueva']));
											$agregarVistaSlide = true;
										}
										$agregarVistaModulos = false;
										$vistaModulos = array();
										if(isset($_POST['categoria-modulos-url-1-nueva']) && isset($_POST['categoria-modulos-img-1-nueva']) && $_POST['categoria-modulos-img-1-nueva']>0)
										{
											array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-1-nueva'],"img"=>$_POST['categoria-modulos-img-1-nueva']));
											$agregarVistaModulos = true;
										}
										if(isset($_POST['categoria-modulos-url-2-nueva']) && isset($_POST['categoria-modulos-img-2-nueva']) && $_POST['categoria-modulos-img-2-nueva']>0)
										{
											array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-2-nueva'],"img"=>$_POST['categoria-modulos-img-2-nueva']));
											$agregarVistaModulos = true;
										}
										if(isset($_POST['categoria-modulos-url-3-nueva']) && isset($_POST['categoria-modulos-img-3-nueva']) && $_POST['categoria-modulos-img-3-nueva']>0)
										{
											array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-3-nueva'],"img"=>$_POST['categoria-modulos-img-3-nueva']));
											$agregarVistaModulos = true;
										}
										if(isset($_POST['categoria-modulos-url-4-nueva']) && isset($_POST['categoria-modulos-img-4-nueva']) && $_POST['categoria-modulos-img-4-nueva']>0)
										{
											array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-4-nueva'],"img"=>$_POST['categoria-modulos-img-4-nueva']));
											$agregarVistaModulos = true;
										}
										if(isset($_POST['categoria-modulos-url-5-nueva']) && isset($_POST['categoria-modulos-img-5-nueva']) && $_POST['categoria-modulos-img-5-nueva']>0)
										{
											array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-5-nueva'],"img"=>$_POST['categoria-modulos-img-5-nueva']));
											$agregarVistaModulos = true;
										}
										if(isset($_POST['categoria-modulos-url-6-nueva']) && isset($_POST['categoria-modulos-img-6-nueva']) && $_POST['categoria-modulos-img-6-nueva']>0)
										{
											array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-6-nueva'],"img"=>$_POST['categoria-modulos-img-6-nueva']));
											$agregarVistaModulos = true;
										}
										if(isset($_POST['categoria-modulos-url-7-nueva']) && isset($_POST['categoria-modulos-img-7-nueva']) && $_POST['categoria-modulos-img-7-nueva']>0)
										{
											array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-7-nueva'],"img"=>$_POST['categoria-modulos-img-7-nueva']));
											$agregarVistaModulos = true;
										}
										if(isset($_POST['categoria-modulos-url-8-nueva']) && isset($_POST['categoria-modulos-img-8-nueva']) && $_POST['categoria-modulos-img-8-nueva']>0)
										{
											array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-8-nueva'],"img"=>$_POST['categoria-modulos-img-8-nueva']));
											$agregarVistaModulos = true;
										}
										if(isset($_POST['categoria-modulos-url-9-nueva']) && isset($_POST['categoria-modulos-img-9-nueva']) && $_POST['categoria-modulos-img-9-nueva']>0)
										{
											array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-9-nueva'],"img"=>$_POST['categoria-modulos-img-9-nueva']));
											$agregarVistaModulos = true;
										}
										if(isset($_POST['categoria-modulos-url-10-nueva']) && isset($_POST['categoria-modulos-img-10-nueva']) && $_POST['categoria-modulos-img-10-nueva']>0)
										{
											array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-10-nueva'],"img"=>$_POST['categoria-modulos-img-10-nueva']));
											$agregarVistaModulos = true;
										}
										if(isset($_POST['categoria-modulos-url-11-nueva']) && isset($_POST['categoria-modulos-img-11-nueva']) && $_POST['categoria-modulos-img-11-nueva']>0)
										{
											array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-11-nueva'],"img"=>$_POST['categoria-modulos-img-11-nueva']));
											$agregarVistaModulos = true;
										}
										if(isset($_POST['categoria-modulos-url-12-nueva']) && isset($_POST['categoria-modulos-img-12-nueva']) && $_POST['categoria-modulos-img-12-nueva']>0)
										{
											array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-12-nueva'],"img"=>$_POST['categoria-modulos-img-12-nueva']));
											$agregarVistaModulos = true;
										}
										if(isset($_POST['categoria-modulos-url-13-nueva']) && isset($_POST['categoria-modulos-img-13-nueva']) && $_POST['categoria-modulos-img-13-nueva']>0)
										{
											array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-13-nueva'],"img"=>$_POST['categoria-modulos-img-13-nueva']));
											$agregarVistaModulos = true;
										}
										if(isset($_POST['categoria-modulos-url-14-nueva']) && isset($_POST['categoria-modulos-img-14-nueva']) && $_POST['categoria-modulos-img-14-nueva']>0)
										{
											array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-14-nueva'],"img"=>$_POST['categoria-modulos-img-14-nueva']));
											$agregarVistaModulos = true;
										}
										if(isset($_POST['categoria-modulos-url-15-nueva']) && isset($_POST['categoria-modulos-img-15-nueva']) && $_POST['categoria-modulos-img-15-nueva']>0)
										{
											array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-15-nueva'],"img"=>$_POST['categoria-modulos-img-15-nueva']));
											$agregarVistaModulos = true;
										}
										$agregarVistaMarcas = false;
										$vistaMarcas = array();
										if(isset($_POST['categoria-marca-1-nueva']) && $_POST['categoria-marca-1-nueva']>0)
										{
											array_push($vistaMarcas, $_POST['categoria-marca-1-nueva']);
											$agregarVistaMarcas = true;
										}
										if(isset($_POST['categoria-marca-2-nueva']) && $_POST['categoria-marca-2-nueva']>0)
										{
											array_push($vistaMarcas, $_POST['categoria-marca-2-nueva']);
											$agregarVistaMarcas = true;
										}
										if(isset($_POST['categoria-marca-3-nueva']) && $_POST['categoria-marca-3-nueva']>0)
										{
											array_push($vistaMarcas, $_POST['categoria-marca-3-nueva']);
											$agregarVistaMarcas = true;
										}
										if(isset($_POST['categoria-marca-4-nueva']) && $_POST['categoria-marca-4-nueva']>0)
										{
											array_push($vistaMarcas, $_POST['categoria-marca-4-nueva']);
											$agregarVistaMarcas = true;
										}
										if(isset($_POST['categoria-marca-5-nueva']) && $_POST['categoria-marca-5-nueva']>0)
										{
											array_push($vistaMarcas, $_POST['categoria-marca-5-nueva']);
											$agregarVistaMarcas = true;
										}
										if(isset($_POST['categoria-marca-6-nueva']) && $_POST['categoria-marca-6-nueva']>0)
										{
											array_push($vistaMarcas, $_POST['categoria-marca-6-nueva']);
											$agregarVistaMarcas = true;
										}
										if(isset($_POST['categoria-marca-7-nueva']) && $_POST['categoria-marca-7-nueva']>0)
										{
											array_push($vistaMarcas, $_POST['categoria-marca-7-nueva']);
											$agregarVistaMarcas = true;
										}
										if(isset($_POST['categoria-marca-8-nueva']) && $_POST['categoria-marca-8-nueva']>0)
										{
											array_push($vistaMarcas, $_POST['categoria-marca-8-nueva']);
											$agregarVistaMarcas = true;
										}
										if(isset($_POST['categoria-marca-9-nueva']) && $_POST['categoria-marca-9-nueva']>0)
										{
											array_push($vistaMarcas, $_POST['categoria-marca-9-nueva']);
											$agregarVistaMarcas = true;
										}
										if(isset($_POST['categoria-marca-10-nueva']) && $_POST['categoria-marca-10-nueva']>0)
										{
											array_push($vistaMarcas, $_POST['categoria-marca-10-nueva']);
											$agregarVistaMarcas = true;
										}
										if(isset($_POST['categoria-marca-11-nueva']) && $_POST['categoria-marca-11-nueva']>0)
										{
											array_push($vistaMarcas, $_POST['categoria-marca-11-nueva']);
											$agregarVistaMarcas = true;
										}
										if(isset($_POST['categoria-marca-12-nueva']) && $_POST['categoria-marca-12-nueva']>0)
										{
											array_push($vistaMarcas, $_POST['categoria-marca-12-nueva']);
											$agregarVistaMarcas = true;
										}
										if(isset($_POST['categoria-marca-13-nueva']) && $_POST['categoria-marca-13-nueva']>0)
										{
											array_push($vistaMarcas, $_POST['categoria-marca-13-nueva']);
											$agregarVistaMarcas = true;
										}
										if(isset($_POST['categoria-marca-14-nueva']) && $_POST['categoria-marca-14-nueva']>0)
										{
											array_push($vistaMarcas, $_POST['categoria-marca-14-nueva']);
											$agregarVistaMarcas = true;
										}
										if(isset($_POST['categoria-marca-15-nueva']) && $_POST['categoria-marca-15-nueva']>0)
										{
											array_push($vistaMarcas, $_POST['categoria-marca-15-nueva']);
											$agregarVistaMarcas = true;
										}
										if(isset($_POST['categoria-marca-16-nueva']) && $_POST['categoria-marca-16-nueva']>0)
										{
											array_push($vistaMarcas, $_POST['categoria-marca-16-nueva']);
											$agregarVistaMarcas = true;
										}
										if(isset($_POST['categoria-marca-17-nueva']) && $_POST['categoria-marca-17-nueva']>0)
										{
											array_push($vistaMarcas, $_POST['categoria-marca-17-nueva']);
											$agregarVistaMarcas = true;
										}
										if(isset($_POST['categoria-marca-18-nueva']) && $_POST['categoria-marca-18-nueva']>0)
										{
											array_push($vistaMarcas, $_POST['categoria-marca-18-nueva']);
											$agregarVistaMarcas = true;
										}
										if(isset($_POST['categoria-marca-19-nueva']) && $_POST['categoria-marca-19-nueva']>0)
										{
											array_push($vistaMarcas, $_POST['categoria-marca-19-nueva']);
											$agregarVistaMarcas = true;
										}
										if(isset($_POST['categoria-marca-20-nueva']) && $_POST['categoria-marca-20-nueva']>0)
										{
											array_push($vistaMarcas, $_POST['categoria-marca-20-nueva']);
											$agregarVistaMarcas = true;
										}
										$agregarVistaBanner = false;
										$vistaBanner = array();
										if(isset($_POST['categoria-banner-publicitario-url-nueva']) && isset($_POST['categoria-banner-publicitario-img-nueva']) && $_POST['categoria-banner-publicitario-img-nueva']>0)
										{
											array_push($vistaBanner, array("url"=>$_POST['categoria-banner-publicitario-url-nueva'],"img"=>$_POST['categoria-banner-publicitario-img-nueva']));
											$agregarVistaBanner = true;
										}
										if($agregarVistaSlide == true || $agregarVistaModulos == true || $agregarVistaMarcas == true || $agregarVistaBanner == true || $agregarVistaCabecera == true)
										{
											$dataVistas = [
												"Id"=>$datos_categoria['id'],
												"Slides"=>$vistaSlide,
												"Modulos"=>$vistaModulos,
												"Marcas"=>$vistaMarcas,
												"Banner"=>$vistaBanner,
												"Cabecera"=>$vistaCabecera
											];
											$guardarReglas = administradorModelo::agregar_vista_modelo($dataVistas);
										}
									}
									$alerta=[
										"Alerta"=>"recargar",
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
				}
				else{
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrió un error",
						"Texto"=>"No se ha podido obtener la información de la categoría padre seleccionado",
						"Tipo"=>"error"
					];
				}
			}
			else
			{
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
						"Icono"=>$icono,
						"Icono2"=>$icono2
					];
					$guardarCategoria=administradorModelo::agregar_categoria_modelo($dataAC);
					if($guardarCategoria->rowCount()>=1)
					{
						$id_reglas = administradorModelo::obtener_categoria_id_slug_modelo($slug);
						if($id_reglas->rowCount()>=1)
						{
							$datos_categoria=$id_reglas->fetch();
							$dataReglas = [
								"Id"=>$datos_categoria['id'],
								"Visitantes"=>$visitantes,
								"Usuarios"=>$usuarios,
								"Empresas"=>$empresas
							];
							$guardarReglas = administradorModelo::agregar_regla_modelo($dataReglas);
							if($guardarReglas->rowCount()>=1)
							{
								if(isset($_POST['categoria-vista-nueva']))
								{				
									$agregarVistaCabecera = false;
									$vistaCabecera = array();
									if(isset($_POST['categoria-cabecera-nueva']) && $_POST['categoria-cabecera-nueva']>0)
									{
										array_push($vistaCabecera, array("cabecera"=>"cabecera","img"=>$_POST['categoria-cabecera-nueva']));
										$agregarVistaCabecera = true;
									}
									$agregarVistaSlide = false;
									$vistaSlide = array();
									if(isset($_POST['categoria-slide-url-1-nueva']) && isset($_POST['categoria-slide-img-1-nueva']) && $_POST['categoria-slide-img-1-nueva']>0)
									{
										array_push($vistaSlide, array("url"=>$_POST['categoria-slide-url-1-nueva'],"img"=>$_POST['categoria-slide-img-1-nueva']));
										$agregarVistaSlide = true;
									}
									if(isset($_POST['categoria-slide-url-2-nueva']) && isset($_POST['categoria-slide-img-2-nueva']) && $_POST['categoria-slide-img-2-nueva']>0)
									{
										array_push($vistaSlide, array("url"=>$_POST['categoria-slide-url-2-nueva'],"img"=>$_POST['categoria-slide-img-2-nueva']));
										$agregarVistaSlide = true;
									}
									if(isset($_POST['categoria-slide-url-3-nueva']) && isset($_POST['categoria-slide-img-3-nueva']) && $_POST['categoria-slide-img-3-nueva']>0)
									{
										array_push($vistaSlide, array("url"=>$_POST['categoria-slide-url-3-nueva'],"img"=>$_POST['categoria-slide-img-3-nueva']));
										$agregarVistaSlide = true;
									}
									if(isset($_POST['categoria-slide-url-4-nueva']) && isset($_POST['categoria-slide-img-4-nueva']) && $_POST['categoria-slide-img-4-nueva']>0)
									{
										array_push($vistaSlide, array("url"=>$_POST['categoria-slide-url-4-nueva'],"img"=>$_POST['categoria-slide-img-4-nueva']));
										$agregarVistaSlide = true;
									}
									if(isset($_POST['categoria-slide-url-5-nueva']) && isset($_POST['categoria-slide-img-5-nueva']) && $_POST['categoria-slide-img-5-nueva']>0)
									{
										array_push($vistaSlide, array("url"=>$_POST['categoria-slide-url-5-nueva'],"img"=>$_POST['categoria-slide-img-5-nueva']));
										$agregarVistaSlide = true;
									}
									$agregarVistaModulos = false;
									$vistaModulos = array();
									if(isset($_POST['categoria-modulos-url-1-nueva']) && isset($_POST['categoria-modulos-img-1-nueva']) && $_POST['categoria-modulos-img-1-nueva']>0)
									{
										array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-1-nueva'],"img"=>$_POST['categoria-modulos-img-1-nueva']));
										$agregarVistaModulos = true;
									}
									if(isset($_POST['categoria-modulos-url-2-nueva']) && isset($_POST['categoria-modulos-img-2-nueva']) && $_POST['categoria-modulos-img-2-nueva']>0)
									{
										array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-2-nueva'],"img"=>$_POST['categoria-modulos-img-2-nueva']));
										$agregarVistaModulos = true;
									}
									if(isset($_POST['categoria-modulos-url-3-nueva']) && isset($_POST['categoria-modulos-img-3-nueva']) && $_POST['categoria-modulos-img-3-nueva']>0)
									{
										array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-3-nueva'],"img"=>$_POST['categoria-modulos-img-3-nueva']));
										$agregarVistaModulos = true;
									}
									if(isset($_POST['categoria-modulos-url-4-nueva']) && isset($_POST['categoria-modulos-img-4-nueva']) && $_POST['categoria-modulos-img-4-nueva']>0)
									{
										array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-4-nueva'],"img"=>$_POST['categoria-modulos-img-4-nueva']));
										$agregarVistaModulos = true;
									}
									if(isset($_POST['categoria-modulos-url-5-nueva']) && isset($_POST['categoria-modulos-img-5-nueva']) && $_POST['categoria-modulos-img-5-nueva']>0)
									{
										array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-5-nueva'],"img"=>$_POST['categoria-modulos-img-5-nueva']));
										$agregarVistaModulos = true;
									}
									if(isset($_POST['categoria-modulos-url-6-nueva']) && isset($_POST['categoria-modulos-img-6-nueva']) && $_POST['categoria-modulos-img-6-nueva']>0)
									{
										array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-6-nueva'],"img"=>$_POST['categoria-modulos-img-6-nueva']));
										$agregarVistaModulos = true;
									}
									if(isset($_POST['categoria-modulos-url-7-nueva']) && isset($_POST['categoria-modulos-img-7-nueva']) && $_POST['categoria-modulos-img-7-nueva']>0)
									{
										array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-7-nueva'],"img"=>$_POST['categoria-modulos-img-7-nueva']));
										$agregarVistaModulos = true;
									}
									if(isset($_POST['categoria-modulos-url-8-nueva']) && isset($_POST['categoria-modulos-img-8-nueva']) && $_POST['categoria-modulos-img-8-nueva']>0)
									{
										array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-8-nueva'],"img"=>$_POST['categoria-modulos-img-8-nueva']));
										$agregarVistaModulos = true;
									}
									if(isset($_POST['categoria-modulos-url-9-nueva']) && isset($_POST['categoria-modulos-img-9-nueva']) && $_POST['categoria-modulos-img-9-nueva']>0)
									{
										array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-9-nueva'],"img"=>$_POST['categoria-modulos-img-9-nueva']));
										$agregarVistaModulos = true;
									}
									if(isset($_POST['categoria-modulos-url-10-nueva']) && isset($_POST['categoria-modulos-img-10-nueva']) && $_POST['categoria-modulos-img-10-nueva']>0)
									{
										array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-10-nueva'],"img"=>$_POST['categoria-modulos-img-10-nueva']));
										$agregarVistaModulos = true;
									}
									if(isset($_POST['categoria-modulos-url-11-nueva']) && isset($_POST['categoria-modulos-img-11-nueva']) && $_POST['categoria-modulos-img-11-nueva']>0)
									{
										array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-11-nueva'],"img"=>$_POST['categoria-modulos-img-11-nueva']));
										$agregarVistaModulos = true;
									}
									if(isset($_POST['categoria-modulos-url-12-nueva']) && isset($_POST['categoria-modulos-img-12-nueva']) && $_POST['categoria-modulos-img-12-nueva']>0)
									{
										array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-12-nueva'],"img"=>$_POST['categoria-modulos-img-12-nueva']));
										$agregarVistaModulos = true;
									}
									if(isset($_POST['categoria-modulos-url-13-nueva']) && isset($_POST['categoria-modulos-img-13-nueva']) && $_POST['categoria-modulos-img-13-nueva']>0)
									{
										array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-13-nueva'],"img"=>$_POST['categoria-modulos-img-13-nueva']));
										$agregarVistaModulos = true;
									}
									if(isset($_POST['categoria-modulos-url-14-nueva']) && isset($_POST['categoria-modulos-img-14-nueva']) && $_POST['categoria-modulos-img-14-nueva']>0)
									{
										array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-14-nueva'],"img"=>$_POST['categoria-modulos-img-14-nueva']));
										$agregarVistaModulos = true;
									}
									if(isset($_POST['categoria-modulos-url-15-nueva']) && isset($_POST['categoria-modulos-img-15-nueva']) && $_POST['categoria-modulos-img-15-nueva']>0)
									{
										array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-15-nueva'],"img"=>$_POST['categoria-modulos-img-15-nueva']));
										$agregarVistaModulos = true;
									}
									$agregarVistaMarcas = false;
									$vistaMarcas = array();
									if(isset($_POST['categoria-marca-1-nueva']) && $_POST['categoria-marca-1-nueva']>0)
									{
										array_push($vistaMarcas, $_POST['categoria-marca-1-nueva']);
										$agregarVistaMarcas = true;
                                    }
                                    if(isset($_POST['categoria-marca-2-nueva']) && $_POST['categoria-marca-2-nueva']>0)
									{
										array_push($vistaMarcas, $_POST['categoria-marca-2-nueva']);
										$agregarVistaMarcas = true;
									}
                                    if(isset($_POST['categoria-marca-3-nueva']) && $_POST['categoria-marca-3-nueva']>0)
									{
										array_push($vistaMarcas, $_POST['categoria-marca-3-nueva']);
										$agregarVistaMarcas = true;
                                    }
                                    if(isset($_POST['categoria-marca-4-nueva']) && $_POST['categoria-marca-4-nueva']>0)
									{
										array_push($vistaMarcas, $_POST['categoria-marca-4-nueva']);
										$agregarVistaMarcas = true;
									}
                                    if(isset($_POST['categoria-marca-5-nueva']) && $_POST['categoria-marca-5-nueva']>0)
									{
										array_push($vistaMarcas, $_POST['categoria-marca-5-nueva']);
										$agregarVistaMarcas = true;
									}
                                    if(isset($_POST['categoria-marca-6-nueva']) && $_POST['categoria-marca-6-nueva']>0)
									{
										array_push($vistaMarcas, $_POST['categoria-marca-6-nueva']);
										$agregarVistaMarcas = true;
                                    }
                                    if(isset($_POST['categoria-marca-7-nueva']) && $_POST['categoria-marca-7-nueva']>0)
									{
										array_push($vistaMarcas, $_POST['categoria-marca-7-nueva']);
										$agregarVistaMarcas = true;
									}
                                    if(isset($_POST['categoria-marca-8-nueva']) && $_POST['categoria-marca-8-nueva']>0)
									{
										array_push($vistaMarcas, $_POST['categoria-marca-8-nueva']);
										$agregarVistaMarcas = true;
									}
                                    if(isset($_POST['categoria-marca-9-nueva']) && $_POST['categoria-marca-9-nueva']>0)
									{
										array_push($vistaMarcas, $_POST['categoria-marca-9-nueva']);
										$agregarVistaMarcas = true;
                                    }
                                    if(isset($_POST['categoria-marca-10-nueva']) && $_POST['categoria-marca-10-nueva']>0)
									{
										array_push($vistaMarcas, $_POST['categoria-marca-10-nueva']);
										$agregarVistaMarcas = true;
									}
                                    if(isset($_POST['categoria-marca-11-nueva']) && $_POST['categoria-marca-11-nueva']>0)
									{
										array_push($vistaMarcas, $_POST['categoria-marca-11-nueva']);
										$agregarVistaMarcas = true;
									}
                                    if(isset($_POST['categoria-marca-12-nueva']) && $_POST['categoria-marca-12-nueva']>0)
									{
										array_push($vistaMarcas, $_POST['categoria-marca-12-nueva']);
										$agregarVistaMarcas = true;
                                    }
                                    if(isset($_POST['categoria-marca-13-nueva']) && $_POST['categoria-marca-13-nueva']>0)
									{
										array_push($vistaMarcas, $_POST['categoria-marca-13-nueva']);
										$agregarVistaMarcas = true;
									}
                                    if(isset($_POST['categoria-marca-14-nueva']) && $_POST['categoria-marca-14-nueva']>0)
									{
										array_push($vistaMarcas, $_POST['categoria-marca-14-nueva']);
										$agregarVistaMarcas = true;
									}
                                    if(isset($_POST['categoria-marca-15-nueva']) && $_POST['categoria-marca-15-nueva']>0)
									{
										array_push($vistaMarcas, $_POST['categoria-marca-15-nueva']);
										$agregarVistaMarcas = true;
                                    }
                                    if(isset($_POST['categoria-marca-16-nueva']) && $_POST['categoria-marca-16-nueva']>0)
									{
										array_push($vistaMarcas, $_POST['categoria-marca-16-nueva']);
										$agregarVistaMarcas = true;
									}
                                    if(isset($_POST['categoria-marca-17-nueva']) && $_POST['categoria-marca-17-nueva']>0)
									{
										array_push($vistaMarcas, $_POST['categoria-marca-17-nueva']);
										$agregarVistaMarcas = true;
									}
                                    if(isset($_POST['categoria-marca-18-nueva']) && $_POST['categoria-marca-18-nueva']>0)
									{
										array_push($vistaMarcas, $_POST['categoria-marca-18-nueva']);
										$agregarVistaMarcas = true;
                                    }
                                    if(isset($_POST['categoria-marca-19-nueva']) && $_POST['categoria-marca-19-nueva']>0)
									{
										array_push($vistaMarcas, $_POST['categoria-marca-19-nueva']);
										$agregarVistaMarcas = true;
									}
                                    if(isset($_POST['categoria-marca-20-nueva']) && $_POST['categoria-marca-20-nueva']>0)
									{
										array_push($vistaMarcas, $_POST['categoria-marca-20-nueva']);
										$agregarVistaMarcas = true;
									}
									$agregarVistaBanner = false;
									$vistaBanner = array();
									if(isset($_POST['categoria-banner-publicitario-url-nueva']) && isset($_POST['categoria-banner-publicitario-img-nueva']) && $_POST['categoria-banner-publicitario-img-nueva']>0)
									{
										array_push($vistaBanner, array("url"=>$_POST['categoria-banner-publicitario-url-nueva'],"img"=>$_POST['categoria-banner-publicitario-img-nueva']));
										$agregarVistaBanner = true;
									}
									if($agregarVistaSlide == true || $agregarVistaModulos == true || $agregarVistaMarcas == true ||$agregarVistaBanner == true || $agregarVistaCabecera == true)
									{
										$dataVistas = [
											"Id"=>$datos_categoria['id'],
											"Slides"=>$vistaSlide,
											"Modulos"=>$vistaModulos,
											"Marcas"=>$vistaMarcas,
											"Banner"=>$vistaBanner,
											"Cabecera"=>$vistaCabecera
										];
										$guardarReglas = administradorModelo::agregar_vista_modelo($dataVistas);
									}
								}
								$alerta=[
									"Alerta"=>"recargar",
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
									"Texto"=>"No se han podido guardar las reglas pero la categría esta agregada en el sistema.",
									"Tipo"=>"error"
								];
							}
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
			}


			return mainModel::sweet_alert($alerta);
		}

		public function obtener_reglas_controlador($id)
		{
			$sql=mainModel::conectar()->prepare("SELECT * FROM reglas WHERE id_categoria=:Id");
			$sql->bindParam(":Id",$id);
			$sql->execute();
			return $sql;
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
				$limpiar=administradorModelo::limpiar_categorias_modelo($codigo);
				$limpiarRelaciones=administradorModelo::limpiar_relaciones_taxonomias_modelo($codigo);
				$limpiarReglas=administradorModelo::limpiar_reglas_modelo($codigo);
				$limpiar_descuentos=administradorModelo::limpiar_descuentos_relaciones_modelo($codigo, "categoria");
				$limpiarVistas=administradorModelo::eliminar_vista_modelo($codigo);
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
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error",
				"Texto"=>"Ha ocurrido un error inesperado, revisa la información que haz proporcionado por favor.",
				"Tipo"=>"error"
			];
			$codigo=mainModel::limpiar_cadena($_POST['categoria-id-editar']);
			$nombre=mainModel::limpiar_cadena($_POST['categoria-nombre-editar']);
			$slug=mainModel::limpiar_cadena($_POST['categoria-slug-editar']);
			$descripcion=mainModel::limpiar_cadena($_POST['categoria-descripcion-editar']);
			$padre=mainModel::limpiar_cadena($_POST['categoria-padre-editar']);
			$visitantes=mainModel::limpiar_cadena($_POST['categoria-visitantes-editar']);
			$usuarios=mainModel::limpiar_cadena($_POST['categoria-usuarios-editar']);
			$empresas=mainModel::limpiar_cadena($_POST['categoria-empresas-editar']);
			$icono=mainModel::limpiar_cadena($_POST['categoria-icono-editar']);
			$icono2=mainModel::limpiar_cadena($_POST['categoria-icono2-editar']);
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
					"Icono"=>$icono,
					"Icono2"=>$icono2
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
				$dataReglaEditar=[
					"Id"=>$codigo,
					"Visitantes"=>$visitantes,
					"Usuarios"=>$usuarios,
					"Empresas"=>$empresas
				];
				$ActRegla=administradorModelo::editar_regla_modelo($dataReglaEditar);
				if($ActRegla->rowCount()>0)
				{
					$alerta=[
						"Alerta"=>"recargar",
						"Titulo"=>"Datos Actualizados",
						"Texto"=>"Los datos fueron editados con éxito",
						"Tipo"=>"success"
					];
				}
				
				$vistaPersonalizada = administradorControlador::obtener_vista_controlador($codigo);
				if($vistaPersonalizada->rowCount()>=1)
				{
					if(isset($_POST['categoria-vista-editar'])) {
						$editarVistaCabecera = false;
						$vistaCabecera = array();
						if(isset($_POST['categoria-cabecera-editar']) && $_POST['categoria-cabecera-editar']>0)
						{
							array_push($vistaCabecera, array("cabecera"=>"cabecera","img"=>$_POST['categoria-cabecera-editar']));
							$editarVistaCabecera = true;
						}
						$editarVistaSlide = false;
						$vistaSlide = array();
						if(isset($_POST['categoria-slide-url-1-editar']) && isset($_POST['categoria-slide-img-1-editar']) && $_POST['categoria-slide-img-1-editar']>0)
						{
							array_push($vistaSlide, array("url"=>$_POST['categoria-slide-url-1-editar'],"img"=>$_POST['categoria-slide-img-1-editar']));
							$editarVistaSlide = true;
						}
						if(isset($_POST['categoria-slide-url-2-editar']) && isset($_POST['categoria-slide-img-2-editar']) && $_POST['categoria-slide-img-2-editar']>0)
						{
							array_push($vistaSlide, array("url"=>$_POST['categoria-slide-url-2-editar'],"img"=>$_POST['categoria-slide-img-2-editar']));
							$editarVistaSlide = true;
						}
						if(isset($_POST['categoria-slide-url-3-editar']) && isset($_POST['categoria-slide-img-3-editar']) && $_POST['categoria-slide-img-3-editar']>0)
						{
							array_push($vistaSlide, array("url"=>$_POST['categoria-slide-url-3-editar'],"img"=>$_POST['categoria-slide-img-3-editar']));
							$editarVistaSlide = true;
						}
						if(isset($_POST['categoria-slide-url-4-editar']) && isset($_POST['categoria-slide-img-4-editar']) && $_POST['categoria-slide-img-4-editar']>0)
						{
							array_push($vistaSlide, array("url"=>$_POST['categoria-slide-url-4-editar'],"img"=>$_POST['categoria-slide-img-4-editar']));
							$editarVistaSlide = true;
						}
						if(isset($_POST['categoria-slide-url-5-editar']) && isset($_POST['categoria-slide-img-5-editar']) && $_POST['categoria-slide-img-5-editar']>0)
						{
							array_push($vistaSlide, array("url"=>$_POST['categoria-slide-url-5-editar'],"img"=>$_POST['categoria-slide-img-5-editar']));
							$editarVistaSlide = true;
						}
						$editarVistaModulos = false;
						$vistaModulos = array();
						if(isset($_POST['categoria-modulos-url-1-editar']) && isset($_POST['categoria-modulos-img-1-editar']) && $_POST['categoria-modulos-img-1-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-1-editar'],"img"=>$_POST['categoria-modulos-img-1-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['categoria-modulos-url-2-editar']) && isset($_POST['categoria-modulos-img-2-editar']) && $_POST['categoria-modulos-img-2-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-2-editar'],"img"=>$_POST['categoria-modulos-img-2-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['categoria-modulos-url-3-editar']) && isset($_POST['categoria-modulos-img-3-editar']) && $_POST['categoria-modulos-img-3-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-3-editar'],"img"=>$_POST['categoria-modulos-img-3-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['categoria-modulos-url-4-editar']) && isset($_POST['categoria-modulos-img-4-editar']) && $_POST['categoria-modulos-img-4-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-4-editar'],"img"=>$_POST['categoria-modulos-img-4-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['categoria-modulos-url-5-editar']) && isset($_POST['categoria-modulos-img-5-editar']) && $_POST['categoria-modulos-img-5-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-5-editar'],"img"=>$_POST['categoria-modulos-img-5-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['categoria-modulos-url-6-editar']) && isset($_POST['categoria-modulos-img-6-editar']) && $_POST['categoria-modulos-img-6-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-6-editar'],"img"=>$_POST['categoria-modulos-img-6-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['categoria-modulos-url-7-editar']) && isset($_POST['categoria-modulos-img-7-editar']) && $_POST['categoria-modulos-img-7-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-7-editar'],"img"=>$_POST['categoria-modulos-img-7-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['categoria-modulos-url-8-editar']) && isset($_POST['categoria-modulos-img-8-editar']) && $_POST['categoria-modulos-img-8-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-8-editar'],"img"=>$_POST['categoria-modulos-img-8-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['categoria-modulos-url-9-editar']) && isset($_POST['categoria-modulos-img-9-editar']) && $_POST['categoria-modulos-img-9-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-9-editar'],"img"=>$_POST['categoria-modulos-img-9-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['categoria-modulos-url-10-editar']) && isset($_POST['categoria-modulos-img-10-editar']) && $_POST['categoria-modulos-img-10-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-10-editar'],"img"=>$_POST['categoria-modulos-img-10-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['categoria-modulos-url-11-editar']) && isset($_POST['categoria-modulos-img-11-editar']) && $_POST['categoria-modulos-img-11-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-11-editar'],"img"=>$_POST['categoria-modulos-img-11-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['categoria-modulos-url-12-editar']) && isset($_POST['categoria-modulos-img-12-editar']) && $_POST['categoria-modulos-img-12-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-12-editar'],"img"=>$_POST['categoria-modulos-img-12-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['categoria-modulos-url-13-editar']) && isset($_POST['categoria-modulos-img-13-editar']) && $_POST['categoria-modulos-img-13-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-13-editar'],"img"=>$_POST['categoria-modulos-img-13-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['categoria-modulos-url-14-editar']) && isset($_POST['categoria-modulos-img-14-editar']) && $_POST['categoria-modulos-img-14-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-14-editar'],"img"=>$_POST['categoria-modulos-img-14-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['categoria-modulos-url-15-editar']) && isset($_POST['categoria-modulos-img-15-editar']) && $_POST['categoria-modulos-img-15-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-15-editar'],"img"=>$_POST['categoria-modulos-img-15-editar']));
							$editarVistaModulos = true;
						}
						$editarVistaMarcas = false;
						$vistaMarcas = array();
						if(isset($_POST['categoria-marca-1-editar']) && $_POST['categoria-marca-1-editar']>0)
						{
							array_push($vistaMarcas, $_POST['categoria-marca-1-editar']);
							$editarVistaMarcas = true;
						}
						if(isset($_POST['categoria-marca-2-editar']) && $_POST['categoria-marca-2-editar']>0)
						{
							array_push($vistaMarcas, $_POST['categoria-marca-2-editar']);
							$editarVistaMarcas = true;
						}
						if(isset($_POST['categoria-marca-3-editar']) && $_POST['categoria-marca-3-editar']>0)
						{
							array_push($vistaMarcas, $_POST['categoria-marca-3-editar']);
							$editarVistaMarcas = true;
						}
						if(isset($_POST['categoria-marca-4-editar']) && $_POST['categoria-marca-4-editar']>0)
						{
							array_push($vistaMarcas, $_POST['categoria-marca-4-editar']);
							$editarVistaMarcas = true;
						}
						if(isset($_POST['categoria-marca-5-editar']) && $_POST['categoria-marca-5-editar']>0)
						{
							array_push($vistaMarcas, $_POST['categoria-marca-5-editar']);
							$editarVistaMarcas = true;
						}
						if(isset($_POST['categoria-marca-6-editar']) && $_POST['categoria-marca-6-editar']>0)
						{
							array_push($vistaMarcas, $_POST['categoria-marca-6-editar']);
							$editarVistaMarcas = true;
						}
						if(isset($_POST['categoria-marca-7-editar']) && $_POST['categoria-marca-7-editar']>0)
						{
							array_push($vistaMarcas, $_POST['categoria-marca-7-editar']);
							$editarVistaMarcas = true;
						}
						if(isset($_POST['categoria-marca-8-editar']) && $_POST['categoria-marca-8-editar']>0)
						{
							array_push($vistaMarcas, $_POST['categoria-marca-8-editar']);
							$editarVistaMarcas = true;
						}
						if(isset($_POST['categoria-marca-9-editar']) && $_POST['categoria-marca-9-editar']>0)
						{
							array_push($vistaMarcas, $_POST['categoria-marca-9-editar']);
							$editarVistaMarcas = true;
						}
						if(isset($_POST['categoria-marca-10-editar']) && $_POST['categoria-marca-10-editar']>0)
						{
							array_push($vistaMarcas, $_POST['categoria-marca-10-editar']);
							$editarVistaMarcas = true;
						}
						if(isset($_POST['categoria-marca-11-editar']) && $_POST['categoria-marca-11-editar']>0)
						{
							array_push($vistaMarcas, $_POST['categoria-marca-11-editar']);
							$editarVistaMarcas = true;
						}
						if(isset($_POST['categoria-marca-12-editar']) && $_POST['categoria-marca-12-editar']>0)
						{
							array_push($vistaMarcas, $_POST['categoria-marca-12-editar']);
							$editarVistaMarcas = true;
						}
						if(isset($_POST['categoria-marca-13-editar']) && $_POST['categoria-marca-13-editar']>0)
						{
							array_push($vistaMarcas, $_POST['categoria-marca-13-editar']);
							$editarVistaMarcas = true;
						}
						if(isset($_POST['categoria-marca-14-editar']) && $_POST['categoria-marca-14-editar']>0)
						{
							array_push($vistaMarcas, $_POST['categoria-marca-14-editar']);
							$editarVistaMarcas = true;
						}
						if(isset($_POST['categoria-marca-15-editar']) && $_POST['categoria-marca-15-editar']>0)
						{
							array_push($vistaMarcas, $_POST['categoria-marca-15-editar']);
							$editarVistaMarcas = true;
						}
						if(isset($_POST['categoria-marca-16-editar']) && $_POST['categoria-marca-16-editar']>0)
						{
							array_push($vistaMarcas, $_POST['categoria-marca-16-editar']);
							$editarVistaMarcas = true;
						}
						if(isset($_POST['categoria-marca-17-editar']) && $_POST['categoria-marca-17-editar']>0)
						{
							array_push($vistaMarcas, $_POST['categoria-marca-17-editar']);
							$editarVistaMarcas = true;
						}
						if(isset($_POST['categoria-marca-18-editar']) && $_POST['categoria-marca-18-editar']>0)
						{
							array_push($vistaMarcas, $_POST['categoria-marca-18-editar']);
							$editarVistaMarcas = true;
						}
						if(isset($_POST['categoria-marca-19-editar']) && $_POST['categoria-marca-19-editar']>0)
						{
							array_push($vistaMarcas, $_POST['categoria-marca-19-editar']);
							$editarVistaMarcas = true;
						}
						if(isset($_POST['categoria-marca-20-editar']) && $_POST['categoria-marca-20-editar']>0)
						{
							array_push($vistaMarcas, $_POST['categoria-marca-20-editar']);
							$editarVistaMarcas = true;
						}
						$editarVistaBanner = false;
						$vistaBanner = array();
						if(isset($_POST['categoria-banner-publicitario-url-editar']) && isset($_POST['categoria-banner-publicitario-img-editar']) && $_POST['categoria-banner-publicitario-img-editar']>0)
						{
							array_push($vistaBanner, array("url"=>$_POST['categoria-banner-publicitario-url-editar'],"img"=>$_POST['categoria-banner-publicitario-img-editar']));
							$editarVistaBanner = true;
						}
						if($editarVistaSlide == true || $editarVistaModulos == true || $editarVistaMarcas == true || $editarVistaBanner == true || $editarVistaCabecera == true)
						{
							$dataVistas = [
								"Id"=>$codigo,
								"Slides"=>$vistaSlide,
								"Modulos"=>$vistaModulos,
								"Marcas"=>$vistaMarcas,
								"Banner"=>$vistaBanner,
								"Cabecera"=>$vistaCabecera
							];
							$guardarReglas = administradorModelo::editar_vista_modelo($dataVistas);
							if ($guardarReglas->rowCount()>0){					
								$alerta=[
									"Alerta"=>"recargar",
									"Titulo"=>"Datos Actualizados",
									"Texto"=>"Los datos fueron editados con éxito",
									"Tipo"=>"success"
								];
							}
						}
					}
					else {
						$borrarVista = administradorModelo::eliminar_vista_modelo($codigo);
						if ($borrarVista->rowCount()>0) {
							$alerta=[
								"Alerta"=>"recargar",
								"Titulo"=>"Datos Actualizados",
								"Texto"=>"Los datos fueron editados con éxito",
								"Tipo"=>"success"
							];
						}
					}
				}
				else {
					if(isset($_POST['categoria-vista-editar'])) {
						$editarVistaCabecera = false;
						$vistaCabecera = array();
						if(isset($_POST['categoria-cabecera-editar']) && $_POST['categoria-cabecera-editar']>0)
						{
							array_push($vistaCabecera, array("cabecera"=>"cabecera","img"=>$_POST['categoria-cabecera-editar']));
							$editarVistaCabecera = true;
						}
						$editarVistaSlide = false;
						$vistaSlide = array();
						if(isset($_POST['categoria-slide-url-1-editar']) && isset($_POST['categoria-slide-img-1-editar']) && $_POST['categoria-slide-img-1-editar']>0)
						{
							array_push($vistaSlide, array("url"=>$_POST['categoria-slide-url-1-editar'],"img"=>$_POST['categoria-slide-img-1-editar']));
							$editarVistaSlide = true;
						}
						if(isset($_POST['categoria-slide-url-2-editar']) && isset($_POST['categoria-slide-img-2-editar']) && $_POST['categoria-slide-img-2-editar']>0)
						{
							array_push($vistaSlide, array("url"=>$_POST['categoria-slide-url-2-editar'],"img"=>$_POST['categoria-slide-img-2-editar']));
							$editarVistaSlide = true;
						}
						if(isset($_POST['categoria-slide-url-3-editar']) && isset($_POST['categoria-slide-img-3-editar']) && $_POST['categoria-slide-img-3-editar']>0)
						{
							array_push($vistaSlide, array("url"=>$_POST['categoria-slide-url-3-editar'],"img"=>$_POST['categoria-slide-img-3-editar']));
							$editarVistaSlide = true;
						}
						if(isset($_POST['categoria-slide-url-4-editar']) && isset($_POST['categoria-slide-img-4-editar']) && $_POST['categoria-slide-img-4-editar']>0)
						{
							array_push($vistaSlide, array("url"=>$_POST['categoria-slide-url-4-editar'],"img"=>$_POST['categoria-slide-img-4-editar']));
							$editarVistaSlide = true;
						}
						if(isset($_POST['categoria-slide-url-5-editar']) && isset($_POST['categoria-slide-img-5-editar']) && $_POST['categoria-slide-img-5-editar']>0)
						{
							array_push($vistaSlide, array("url"=>$_POST['categoria-slide-url-5-editar'],"img"=>$_POST['categoria-slide-img-5-editar']));
							$editarVistaSlide = true;
						}
						$editarVistaModulos = false;
						$vistaModulos = array();
						if(isset($_POST['categoria-modulos-url-1-editar']) && isset($_POST['categoria-modulos-img-1-editar']) && $_POST['categoria-modulos-img-1-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-1-editar'],"img"=>$_POST['categoria-modulos-img-1-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['categoria-modulos-url-2-editar']) && isset($_POST['categoria-modulos-img-2-editar']) && $_POST['categoria-modulos-img-2-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-2-editar'],"img"=>$_POST['categoria-modulos-img-2-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['categoria-modulos-url-3-editar']) && isset($_POST['categoria-modulos-img-3-editar']) && $_POST['categoria-modulos-img-3-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-3-editar'],"img"=>$_POST['categoria-modulos-img-3-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['categoria-modulos-url-4-editar']) && isset($_POST['categoria-modulos-img-4-editar']) && $_POST['categoria-modulos-img-4-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-4-editar'],"img"=>$_POST['categoria-modulos-img-4-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['categoria-modulos-url-5-editar']) && isset($_POST['categoria-modulos-img-5-editar']) && $_POST['categoria-modulos-img-5-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-5-editar'],"img"=>$_POST['categoria-modulos-img-5-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['categoria-modulos-url-6-editar']) && isset($_POST['categoria-modulos-img-6-editar']) && $_POST['categoria-modulos-img-6-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-6-editar'],"img"=>$_POST['categoria-modulos-img-6-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['categoria-modulos-url-7-editar']) && isset($_POST['categoria-modulos-img-7-editar']) && $_POST['categoria-modulos-img-7-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-7-editar'],"img"=>$_POST['categoria-modulos-img-7-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['categoria-modulos-url-8-editar']) && isset($_POST['categoria-modulos-img-8-editar']) && $_POST['categoria-modulos-img-8-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-8-editar'],"img"=>$_POST['categoria-modulos-img-8-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['categoria-modulos-url-9-editar']) && isset($_POST['categoria-modulos-img-9-editar']) && $_POST['categoria-modulos-img-9-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-9-editar'],"img"=>$_POST['categoria-modulos-img-9-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['categoria-modulos-url-10-editar']) && isset($_POST['categoria-modulos-img-10-editar']) && $_POST['categoria-modulos-img-10-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-10-editar'],"img"=>$_POST['categoria-modulos-img-10-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['categoria-modulos-url-11-editar']) && isset($_POST['categoria-modulos-img-11-editar']) && $_POST['categoria-modulos-img-11-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-11-editar'],"img"=>$_POST['categoria-modulos-img-11-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['categoria-modulos-url-12-editar']) && isset($_POST['categoria-modulos-img-12-editar']) && $_POST['categoria-modulos-img-12-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-12-editar'],"img"=>$_POST['categoria-modulos-img-12-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['categoria-modulos-url-13-editar']) && isset($_POST['categoria-modulos-img-13-editar']) && $_POST['categoria-modulos-img-13-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-13-editar'],"img"=>$_POST['categoria-modulos-img-13-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['categoria-modulos-url-14-editar']) && isset($_POST['categoria-modulos-img-14-editar']) && $_POST['categoria-modulos-img-14-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-14-editar'],"img"=>$_POST['categoria-modulos-img-14-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['categoria-modulos-url-15-editar']) && isset($_POST['categoria-modulos-img-15-editar']) && $_POST['categoria-modulos-img-15-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['categoria-modulos-url-15-editar'],"img"=>$_POST['categoria-modulos-img-15-editar']));
							$editarVistaModulos = true;
						}
						$editarVistaMarcas = false;
						$vistaMarcas = array();
						if(isset($_POST['categoria-marca-1-editar']) && $_POST['categoria-marca-1-editar']>0)
						{
							array_push($vistaMarcas, $_POST['categoria-marca-1-editar']);
							$editarVistaMarcas = true;
						}
						if(isset($_POST['categoria-marca-2-editar']) && $_POST['categoria-marca-2-editar']>0)
						{
							array_push($vistaMarcas, $_POST['categoria-marca-2-editar']);
							$editarVistaMarcas = true;
						}
						if(isset($_POST['categoria-marca-3-editar']) && $_POST['categoria-marca-3-editar']>0)
						{
							array_push($vistaMarcas, $_POST['categoria-marca-3-editar']);
							$editarVistaMarcas = true;
						}
						if(isset($_POST['categoria-marca-4-editar']) && $_POST['categoria-marca-4-editar']>0)
						{
							array_push($vistaMarcas, $_POST['categoria-marca-4-editar']);
							$editarVistaMarcas = true;
						}
						if(isset($_POST['categoria-marca-5-editar']) && $_POST['categoria-marca-5-editar']>0)
						{
							array_push($vistaMarcas, $_POST['categoria-marca-5-editar']);
							$editarVistaMarcas = true;
						}
						if(isset($_POST['categoria-marca-6-editar']) && $_POST['categoria-marca-6-editar']>0)
						{
							array_push($vistaMarcas, $_POST['categoria-marca-6-editar']);
							$editarVistaMarcas = true;
						}
						if(isset($_POST['categoria-marca-7-editar']) && $_POST['categoria-marca-7-editar']>0)
						{
							array_push($vistaMarcas, $_POST['categoria-marca-7-editar']);
							$editarVistaMarcas = true;
						}
						if(isset($_POST['categoria-marca-8-editar']) && $_POST['categoria-marca-8-editar']>0)
						{
							array_push($vistaMarcas, $_POST['categoria-marca-8-editar']);
							$editarVistaMarcas = true;
						}
						if(isset($_POST['categoria-marca-9-editar']) && $_POST['categoria-marca-9-editar']>0)
						{
							array_push($vistaMarcas, $_POST['categoria-marca-9-editar']);
							$editarVistaMarcas = true;
						}
						if(isset($_POST['categoria-marca-10-editar']) && $_POST['categoria-marca-10-editar']>0)
						{
							array_push($vistaMarcas, $_POST['categoria-marca-10-editar']);
							$editarVistaMarcas = true;
						}
						if(isset($_POST['categoria-marca-11-editar']) && $_POST['categoria-marca-11-editar']>0)
						{
							array_push($vistaMarcas, $_POST['categoria-marca-11-editar']);
							$editarVistaMarcas = true;
						}
						if(isset($_POST['categoria-marca-12-editar']) && $_POST['categoria-marca-12-editar']>0)
						{
							array_push($vistaMarcas, $_POST['categoria-marca-12-editar']);
							$editarVistaMarcas = true;
						}
						if(isset($_POST['categoria-marca-13-editar']) && $_POST['categoria-marca-13-editar']>0)
						{
							array_push($vistaMarcas, $_POST['categoria-marca-13-editar']);
							$editarVistaMarcas = true;
						}
						if(isset($_POST['categoria-marca-14-editar']) && $_POST['categoria-marca-14-editar']>0)
						{
							array_push($vistaMarcas, $_POST['categoria-marca-14-editar']);
							$editarVistaMarcas = true;
						}
						if(isset($_POST['categoria-marca-15-editar']) && $_POST['categoria-marca-15-editar']>0)
						{
							array_push($vistaMarcas, $_POST['categoria-marca-15-editar']);
							$editarVistaMarcas = true;
						}
						if(isset($_POST['categoria-marca-16-editar']) && $_POST['categoria-marca-16-editar']>0)
						{
							array_push($vistaMarcas, $_POST['categoria-marca-16-editar']);
							$editarVistaMarcas = true;
						}
						if(isset($_POST['categoria-marca-17-editar']) && $_POST['categoria-marca-17-editar']>0)
						{
							array_push($vistaMarcas, $_POST['categoria-marca-17-editar']);
							$editarVistaMarcas = true;
						}
						if(isset($_POST['categoria-marca-18-editar']) && $_POST['categoria-marca-18-editar']>0)
						{
							array_push($vistaMarcas, $_POST['categoria-marca-18-editar']);
							$editarVistaMarcas = true;
						}
						if(isset($_POST['categoria-marca-19-editar']) && $_POST['categoria-marca-19-editar']>0)
						{
							array_push($vistaMarcas, $_POST['categoria-marca-19-editar']);
							$editarVistaMarcas = true;
						}
						if(isset($_POST['categoria-marca-20-editar']) && $_POST['categoria-marca-20-editar']>0)
						{
							array_push($vistaMarcas, $_POST['categoria-marca-20-editar']);
							$editarVistaMarcas = true;
						}
						$editarVistaBanner = false;
						$vistaBanner = array();
						if(isset($_POST['categoria-banner-publicitario-url-editar']) && isset($_POST['categoria-banner-publicitario-img-editar']) && $_POST['categoria-banner-publicitario-img-editar']>0)
						{
							array_push($vistaBanner, array("url"=>$_POST['categoria-banner-publicitario-url-editar'],"img"=>$_POST['categoria-banner-publicitario-img-editar']));
							$editarVistaBanner = true;
						}
						if($editarVistaSlide == true || $editarVistaModulos == true || $editarVistaMarcas == true || $editarVistaBanner == true || $editarVistaCabecera == true)
						{
							$dataVistas = [
								"Id"=>$codigo,
								"Slides"=>$vistaSlide,
								"Modulos"=>$vistaModulos,
								"Marcas"=>$vistaMarcas,
								"Banner"=>$vistaBanner,
								"Cabecera"=>$vistaCabecera
							];
							$guardarReglas = administradorModelo::agregar_vista_modelo($dataVistas);
							if ($guardarReglas->rowCount()>0){					
								$alerta=[
									"Alerta"=>"recargar",
									"Titulo"=>"Datos Actualizados",
									"Texto"=>"Los datos fueron editados con éxito",
									"Tipo"=>"success"
								];
							}
						}
					}
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
				$limpiar=administradorModelo::limpiar_relaciones_taxonomias_modelo($codigo);
				$limpiar_descuentos=administradorModelo::limpiar_descuentos_relaciones_modelo($codigo, "etiqueta");
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
				$ActAdmin=administradorModelo::editar_etiqueta_modelo($datosEditar);
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

		// CONTROLADORES PARA ATRIBUTOS
		public function agregar_atributo_controlador()
		{
			$nombre=mainModel::limpiar_cadena($_POST['atributo-nombre-nueva']);
			$slug=mainModel::limpiar_cadena($_POST['atributo-slug-nueva']);
			$descripcion=mainModel::limpiar_cadena($_POST['atributo-descripcion-nueva']);

			$verificar=administradorModelo::verificar_atributo_slug_disponible($slug);
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
				$guardarAtributo=administradorModelo::agregar_atributo_modelo($dataAC);
				if($guardarAtributo->rowCount()>=1)
				{
					$alerta=[
						"Alerta"=>"limpiar",
						"Titulo"=>"Atributo añadido",
						"Texto"=>"Se ha guardado correctamente el atributo en la tienda",
						"Tipo"=>"success"
					];
				}
				else
				{
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrió un error inesperado",
						"Texto"=>"No se ha podido guardar el atributo",
						"Tipo"=>"error"
					];
				}
			}

			return mainModel::sweet_alert($alerta);
		}

		public function paginador_atributo_controlador($pagina,$registros,$busqueda){

			$pagina=mainModel::limpiar_cadena($pagina);
			$registros=mainModel::limpiar_cadena($registros);
			$busqueda=mainModel::limpiar_cadena($busqueda);
			$tabla="";

			$pagina= (isset($pagina) && $pagina>0) ? (int) $pagina : 1;
			$inicio= ($pagina>0) ? (($pagina*$registros)-$registros) : 0;

			if(isset($busqueda) && $busqueda!=""){
				$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM taxonomias WHERE (nombre LIKE '%$busqueda%' OR slug LIKE '%$busqueda%' OR descripcion LIKE '%$busqueda%') AND taxonomia = 'atributo' ORDER BY id ASC LIMIT $inicio,$registros";
				$paginaurl="buscar-atributos";
			}else{
				$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM taxonomias WHERE taxonomia = 'atributo' ORDER BY id DESC LIMIT $inicio,$registros";
				$paginaurl="atributos";
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
								<th>Ver términos</th>
								<th>Agregar términos</th>
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
							<td><a href="'.SERVERURL.'terminos/'.$rows['id'].'/" class="btn btn-warning"><i class="far fa-eye"></i></a></td>
							<td><a href="'.SERVERURL.'nuevo-termino/'.$rows['id'].'/" class="btn btn-success"><i class="fas fa-plus"></i></a></td>
							<td>
								<form action="'.SERVERURL.'editar-atributo/" method="POST"  entype="multipart/form-data" autocomplete="off" style="display: inherit;">
									<input type="hidden" name="atributo-id-editar" value="'.$rows['id'].'">
									<button type="submit" class="btn btn-info">
										<i class="fas fa-pencil-alt"></i>
									</button>
								</form>
							</td>
							<td>
								<form action="'.SERVERURL.'ajax/administradorAjax.php" method="POST" class="FormularioAjax" data-form="delete" entype="multipart/form-data" autocomplete="off" style="float: right;">
									<input type="hidden" name="atributo-id-eliminar" value="'.$rows['id'].'">
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

		public function eliminar_atributo_controlador(){
			$codigo=mainModel::limpiar_cadena($_POST['atributo-id-eliminar']);
			$DelCat=administradorModelo::eliminar_taxonomia_modelo($codigo);
			if($DelCat->rowCount()>=1)
			{
				$consulta="SELECT * FROM taxonomias WHERE padre = $codigo;";
				$conexion = mainModel::conectar();
				$datos = $conexion->query($consulta);
				$datos = $datos->fetchAll();
				foreach($datos as $rows)
				{
					$identificador = $rows['id'];
					$limpiar=administradorModelo::limpiar_relaciones_taxonomias_modelo($identificador);
					$limpiar_descuentos=administradorModelo::limpiar_descuentos_relaciones_modelo($identificador, "atributo");
				}
				$limpiar=administradorModelo::limpiar_atributos_modelo($codigo);
				$alerta=[
					"Alerta"=>"recargar",
					"Titulo"=>"Atributo eliminado",
					"Texto"=>"El atributo fue eliminado del sistema con éxito",
					"Tipo"=>"success"
				];
			}
			else
			{
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"No se ha podido eliminar este atributo en este momento",
					"Tipo"=>"error"
				];
			}
			return mainModel::sweet_alert($alerta);
		}

		public function editar_atributo_controlador()
		{
			$codigo=mainModel::limpiar_cadena($_POST['atributo-id-editar']);
			$nombre=mainModel::limpiar_cadena($_POST['atributo-nombre-editar']);
			$slug=mainModel::limpiar_cadena($_POST['atributo-slug-editar']);
			$descripcion=mainModel::limpiar_cadena($_POST['atributo-descripcion-editar']);
			$verificar=administradorModelo::verificar_atributo_editar_slug_disponible($codigo, $slug);
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
				$ActAdmin=administradorModelo::editar_atributo_modelo($datosEditar);
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

        // CONTROLADORES PARA TÉRMINOS
		public function agregar_termino_controlador()
		{
			$nombre=mainModel::limpiar_cadena($_POST['termino-nombre-nueva']);
			$slug=mainModel::limpiar_cadena($_POST['termino-slug-nueva']);
			$descripcion=mainModel::limpiar_cadena($_POST['termino-descripcion-nueva']);
			$padre=mainModel::limpiar_cadena($_POST['termino-padre-nueva']);

            $verificarPadre = administradorModelo::verificar_termino_padre_modelo($padre);
            if ($verificarPadre->rowCount() > 0)
			{
                $verificar=administradorModelo::verificar_termino_slug_disponible($slug);
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
                        "Padre"=>$padre
                    ];
                    $guardarTermino=administradorModelo::agregar_termino_modelo($dataAC);
                    if($guardarTermino->rowCount()>=1)
                    {
                        $alerta=[
                            "Alerta"=>"limpiar",
                            "Titulo"=>"Término añadido",
                            "Texto"=>"Se ha guardado correctamente el término en la tienda",
                            "Tipo"=>"success"
                        ];
                    }
                    else
                    {
                        $alerta=[
                            "Alerta"=>"simple",
                            "Titulo"=>"Ocurrió un error inesperado",
                            "Texto"=>"No se ha podido guardar el término",
                            "Tipo"=>"error"
                        ];
                    }
                }

			}
			else
			{
                $alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error",
					"Texto"=>"No se ha encontrado la información del atributo al que estas intentando añadir este término",
					"Tipo"=>"error"
				];
            }

			return mainModel::sweet_alert($alerta);
		}

		public function paginador_terminos_controlador($pagina,$registros,$padre){

			$pagina=mainModel::limpiar_cadena($pagina);
			$registros=mainModel::limpiar_cadena($registros);
			$padre=mainModel::limpiar_cadena($padre);
			$tabla="";

			$pagina= (isset($pagina) && $pagina>0) ? (int) $pagina : 1;
			$inicio= ($pagina>0) ? (($pagina*$registros)-$registros) : 0;

            $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM taxonomias WHERE taxonomia = 'termino' AND padre = $padre ORDER BY id DESC LIMIT $inicio,$registros";
            
            $paginaurl="terminos/".$padre."/";

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
								<form action="'.SERVERURL.'editar-termino/" method="POST"  entype="multipart/form-data" autocomplete="off" style="display: inherit;">
								<input type="hidden" name="termino-id-editar" value="'.$rows['id'].'">
								<input type="hidden" name="termino-padre-editar" value="'.$rows['padre'].'">
									<button type="submit" class="btn btn-info">
										<i class="fas fa-pencil-alt"></i>
									</button>
								</form>
							</td>
							<td>
								<form action="'.SERVERURL.'ajax/administradorAjax.php" method="POST" class="FormularioAjax" data-form="delete" entype="multipart/form-data" autocomplete="off" style="float: right;">
									<input type="hidden" name="termino-id-eliminar" value="'.$rows['id'].'">
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
						$tabla.='<li class="page-item active"><a class="page-link" href="'.SERVERURL.$paginaurl.$i.'/">'.$i.'</a></li>';
					}else{
						$tabla.='<li class="page-item"><a class="page-link" href="'.SERVERURL.$paginaurl.$i.'/">'.$i.'</a></li>';
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

		public function eliminar_termino_controlador(){
			$codigo=mainModel::limpiar_cadena($_POST['termino-id-eliminar']);
			$DelCat=administradorModelo::eliminar_taxonomia_modelo($codigo);
			if($DelCat->rowCount()>=1)
			{
				$limpiar=administradorModelo::limpiar_relaciones_taxonomias_modelo($codigo);
				$limpiar_descuentos=administradorModelo::limpiar_descuentos_relaciones_modelo($codigo, "atributo");
				$alerta=[
					"Alerta"=>"recargar",
					"Titulo"=>"Término eliminado",
					"Texto"=>"El término fue eliminado del sistema con éxito",
					"Tipo"=>"success"
				];
			}
			else
			{
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"No se ha podido eliminar este término en este momento",
					"Tipo"=>"error"
				];
			}
			return mainModel::sweet_alert($alerta);
		}

		public function editar_termino_controlador()
		{
			$codigo=mainModel::limpiar_cadena($_POST['termino-id-editar']);
			$nombre=mainModel::limpiar_cadena($_POST['termino-nombre-editar']);
			$slug=mainModel::limpiar_cadena($_POST['termino-slug-editar']);
			$descripcion=mainModel::limpiar_cadena($_POST['termino-descripcion-editar']);
			$padre=mainModel::limpiar_cadena($_POST['termino-padre-editar']);
			$verificar=administradorModelo::verificar_termino_editar_slug_disponible($codigo, $slug);
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
                $verificarPadre = administradorModelo::verificar_termino_padre_modelo($padre);
                if ($verificarPadre->rowCount() > 0)
                {
                    $datosEditar =
                    [
                        "Codigo"=>$codigo,
                        "Nombre"=>$nombre,
                        "Slug"=>$slug,
                        "Descripcion"=>$descripcion,
                        "Padre"=>$padre
                    ];
                    $ActAdmin=administradorModelo::editar_termino_modelo($datosEditar);
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
                else
                {
                    $alerta=[
                        "Alerta"=>"simple",
                        "Titulo"=>"Ocurrió un error",
                        "Texto"=>"No se ha encontrado la información del atributo al que estas intentando añadir este término",
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

		//CONTROLADORES PARA MEDIOS
		public function agregar_medio_controlador()
		{
			$titulo=mainModel::limpiar_cadena($_POST['medio-titulo-nuevo']);
			$imagen=$_FILES['medio-imagen-nuevo'];
			if ($imagen["error"] > 0)
			{
				if ($imagen["error"] == 1)
				{
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrió un error inesperado",
						"Texto"=>"El servidor ha rechazado la imagen por que excede el tamaño admitido",
						"Tipo"=>"error"
					];
				}
				elseif ($imagen["error"] == 2)
				{
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrió un error inesperado",
						"Texto"=>"La imagen se ha rechazado por que excede el tamaño admitido",
						"Tipo"=>"error"
					];
				}
				elseif ($imagen["error"] == 3)
				{
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrió un error inesperado",
						"Texto"=>"La imagen no se ha logrado subir correctamente",
						"Tipo"=>"error"
					];
				}
				elseif ($imagen["error"] == 4)
				{
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrió un error inesperado",
						"Texto"=>"La imagen no se ha logrado subir correctamente",
						"Tipo"=>"error"
					];
				}
				elseif ($imagen["error"] == 6)
				{
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrió un error inesperado",
						"Texto"=>"Error al encontrar el archivo temporal",
						"Tipo"=>"error"
					];
				}
				elseif ($imagen["error"] == 7)
				{
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrió un error inesperado",
						"Texto"=>"La imagen no se ha logrado subir correctamente",
						"Tipo"=>"error"
					];
				}
				elseif ($imagen["error"] == 8)
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
				if (in_array($imagen['type'], $permitidos))
				{
                    $ruta = "../medios/".$imagen['name'];
                    if (!file_exists($ruta))
                    {
                        $resultado = @move_uploaded_file($imagen["tmp_name"], $ruta);
                        if ($resultado)
                        {
							$ruta = SERVERURL."medios/".$imagen['name'];
                            $fecha  = date("d/m/Y");
                            $dataAC=[
                                "Titulo"=>$titulo,
                                "Url"=>$ruta,
                                "Fecha"=>$fecha
                            ];
                            $guardarMedio=administradorModelo::agregar_medio_modelo($dataAC);
                            if($guardarMedio->rowCount()>=1)
                            {
                                $alerta=[
                                    "Alerta"=>"recargar",
                                    "Titulo"=>"Medio añadido",
                                    "Texto"=>"El medio se ha añadido con éxito en el sistema",
                                    "Tipo"=>"success"
                                ];
                            }
                            else
                            {
                                $alerta=[
                                    "Alerta"=>"simple",
                                    "Titulo"=>"Ocurrió un error inesperado",
                                    "Texto"=>"No hemos podido añadir el medio",
                                    "Tipo"=>"error"
                                ];
                            }
                        }
                        else
                        {
                            $alerta=[
                                "Alerta"=>"simple",
                                "Titulo"=>"Ocurrió un error inesperado",
                                "Texto"=>"Ha ocurrido un error desconocido al subir la imagen",
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

		public function paginador_medios_controlador($pagina,$registros,$busqueda){

			$pagina=mainModel::limpiar_cadena($pagina);
			$registros=mainModel::limpiar_cadena($registros);
			$busqueda=mainModel::limpiar_cadena($busqueda);
			$tabla="";
		
			$pagina= (isset($pagina) && $pagina>0) ? (int) $pagina : 1;
			$inicio= ($pagina>0) ? (($pagina*$registros)-$registros) : 0;
		
			if(isset($busqueda) && $busqueda!=""){
				$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM medios WHERE titulo LIKE '%$busqueda%' OR url LIKE '%$busqueda%' ORDER BY id ASC LIMIT $inicio,$registros";
				$paginaurl="buscar-medios";
			}else{
				$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM medios ORDER BY id DESC LIMIT $inicio,$registros";
				$paginaurl="medios";
			}
		
			$conexion = mainModel::conectar();
		
			$datos = $conexion->query($consulta);
			$datos= $datos->fetchAll();
		
			$total= $conexion->query("SELECT FOUND_ROWS()");
			$total= (int) $total->fetchColumn();
		
			$Npaginas= ceil($total/$registros);
		
			$tabla.='<div class="row">';
		
			if($total>=1 && $pagina<=$Npaginas){
				$contador=$inicio+1;
				foreach($datos as $rows){
					$tabla.='
						<div class="col-md-4">
							<div class="card" style="width: 100%;">
								<div class="medios-img-contenedor">
									<img src="'.$rows['url'].'">
									</div>
									<div class="card-body">
										<h4 class="card-title">'.$rows['titulo'].'</h4>
										<hr>
										<p class="card-text"><b>URL:</b> '.$rows['url'].'</p>
										<p class="card-text"><b>Fecha:</b> '.$rows['fecha'].'</p>
		
										<form action="'.SERVERURL.'editar-medio/" method="POST"  entype="multipart/form-data" autocomplete="off" style="display: inline-block;">
											<input type="hidden" name="medio-id-editar" value="'.$rows['id'].'">
											<button type="submit" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></button>
											<div class="RespuestaAjax"></div>
										</form>
		
										<form action="'.SERVERURL.'ajax/administradorAjax.php" method="POST" class="FormularioAjax" data-form="delete" entype="multipart/form-data" autocomplete="off" style="display: inline-block;">
											<input type="hidden" name="medio-id-eliminar" value="'.$rows['id'].'">
											<button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button>
											<div class="RespuestaAjax"></div>
										</form>
									</div>
								</div>
							</div>';
							$contador++;
						}
			}else{
				if($total>=1){
					$tabla.='<script> window.location="'.SERVERURL.$paginaurl.'/" </script>;';
				}else{
					$tabla.='
						<div class="col-12">
							<h3 style="margin-bottom: 20px;">No se ha encontrado ningun medio</h3>
						</div>
					';	
				}
			}
		
			$tabla.='</div>';
		
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

		public function eliminar_medio_controlador(){
			$codigo=mainModel::limpiar_cadena($_POST['medio-id-eliminar']);
			$BorrarFoto=administradorModelo::eliminar_imagen_modelo($codigo);
			if ($BorrarFoto == false)
			{
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrio un error inesperado",
					"Texto"=>"La imagen no se ha podido eliminado en el sistema de archivos, para evitar archivos basura eliminela manualmente",
					"Tipo"=>"success"
				];
			}
			else{
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"si un error inesperado",
					"Texto"=>"La imagen no se ha podido eliminado en el sistema de archivos, para evitar archivos basura eliminela manualmente",
					"Tipo"=>"success"
				];
			}
			$DelCat=administradorModelo::eliminar_medio_modelo($codigo);
			if($DelCat->rowCount()>=1)
			{
				$borrarGalerias = administradorModelo::limpiar_galeria_elimnar_imagen_modelo($codigo);
				$borrarIcono = administradorModelo::limpiar_icono_categoria_modelo($codigo);
				$alerta=[
					"Alerta"=>"recargar",
					"Titulo"=>"Medio eliminado",
					"Texto"=>"El medio fue eliminado del sistema con éxito",
					"Tipo"=>"success"
				];
			}
			else
			{
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"No se ha podido eliminar este medio en este momento",
					"Tipo"=>"error"
				];
			}
			return mainModel::sweet_alert($alerta);
		}

		public function obtener_info_medios_controlador($codigo)
		{
			$sql=mainModel::conectar()->prepare("SELECT * FROM medios WHERE id=:Codigo");
			$sql->bindParam(":Codigo",$codigo);
			$sql->execute();
			return $sql;
		}

		public function editar_medio_controlador()
		{
			$codigo=mainModel::limpiar_cadena($_POST['medio-id-editar']);
			$titulo=mainModel::limpiar_cadena($_POST['medio-titulo-editar']);

			$datosEditar =
			[
				"Codigo"=>$codigo,
				"Titulo"=>$titulo
			];

			$ActAdmin=administradorModelo::editar_medio_modelo($datosEditar);
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

			return mainModel::sweet_alert($alerta);
		}

		//CONTROLADORES PARA CARGA DE LISTAS
		
		public function cargar_taxonomias_controlador($taxonomia)
		{
			$lista="";
			$consulta="SELECT * FROM taxonomias WHERE taxonomia = '$taxonomia' ORDER BY nombre;";
			$conexion = mainModel::conectar();
			$datos = $conexion->query($consulta);
			$datos = $datos->fetchAll();
			foreach($datos as $rows)
			{
				$lista.='<option value="'.$rows['id'].'">'.$rows['nombre'].'</option>';
			}
			return $lista;
		}
		
		public function cargar_productos_controlador()
		{
			$lista="";
			$consulta="SELECT * FROM productos ORDER BY nombre;";
			$conexion = mainModel::conectar();
			$datos = $conexion->query($consulta);
			$datos = $datos->fetchAll();
			foreach($datos as $rows)
			{
				$lista.='<option value="'.$rows['sku'].'">'.$rows['nombre'].'</option>';
			}
			return $lista;
		}

		public function cargar_taxonomias_categorias_controlador($taxonomia)
		{
			$lista="";
			$consulta="SELECT * FROM taxonomias WHERE taxonomia = '$taxonomia' ORDER BY nombre;";
			$conexion = mainModel::conectar();
			$datos = $conexion->query($consulta);
			$datos = $datos->fetchAll();
			foreach($datos as $rows)
			{
				$consultaRegla="SELECT * FROM reglas WHERE id_categoria = '".$rows['id']."'";
				$conexionRegla = mainModel::conectar();
				$datosRegla = $conexionRegla->query($consultaRegla);
				$datosRegla = $datosRegla->fetchAll();
				$reglaV;
				$reglaU;
				$reglaE;
				foreach($datosRegla as $rowsRegla)
				{
					$reglaV = $rowsRegla[1];
					$reglaU = $rowsRegla[2];
					$reglaE = $rowsRegla[3];
				}
				$lista.='<option value="'.$rows['id'].'" data-rv="'.$reglaV.'" data-ru="'.$reglaU.'" data-re="'.$reglaE.'">'.$rows['nombre'].'</option>';
			}
			return $lista;
		}
		
		public function cargar_medios_controlador()
		{
			$lista="";
			$consulta="SELECT id, titulo, url FROM medios;";
			$conexion = mainModel::conectar();
			$datos = $conexion->query($consulta);
			$datos = $datos->fetchAll();
			foreach($datos as $rows)
			{
				$lista.='<option value="'.$rows['id'].'" data-url-image="'.$rows['url'].'">'.$rows['titulo'].'</option>';
			}
			return $lista;
		}
		
		public function cargar_taxonomias_editar_controlador($taxonomia, $id)
		{
			$lista="";
			$consulta="SELECT * FROM taxonomias WHERE taxonomia = '$taxonomia' AND id != $id ORDER BY nombre;";
			$conexion = mainModel::conectar();
			$datos = $conexion->query($consulta);
			$datos = $datos->fetchAll();
			foreach($datos as $rows)
			{
				$lista.='<option value="'.$rows['id'].'">'.$rows['nombre'].'</option>';
			}
			return $lista;
		}

		public function cargar_taxonomias_editar2_controlador($taxonomia, $id, $padre)
		{
			$lista="";
			$consulta="SELECT * FROM taxonomias WHERE taxonomia = '$taxonomia' AND id != $id AND id != $padre ORDER BY nombre;";
			$conexion = mainModel::conectar();
			$datos = $conexion->query($consulta);
			$datos = $datos->fetchAll();
			foreach($datos as $rows)
			{
				$lista.='<option value="'.$rows['id'].'">'.$rows['nombre'].'</option>';
			}
			return $lista;
		}
		
		public function cargar_medios_editar_controlador($id)
		{
			$lista="";
			$consulta="SELECT * FROM medios WHERE id != $id;";
			$conexion = mainModel::conectar();
			$datos = $conexion->query($consulta);
			$datos = $datos->fetchAll();
			foreach($datos as $rows)
			{
				$lista.='<option value="'.$rows['id'].'" data-url-image="'.$rows['url'].'">'.$rows['titulo'].'</option>';
			}
			return $lista;
		}

		//CONTROLADORES PARA PRODUCTOS
		public function cargar_atributos_controlador()
		{
			$lista="";
			$consulta="SELECT * FROM taxonomias WHERE taxonomia = 'atributo' ORDER BY nombre;";
			$conexion = mainModel::conectar();
			$atributos = $conexion->query($consulta);
			$atributos = $atributos->fetchAll();
			$atributo = "";
			foreach($atributos as $rows)
			{
				$atributo = $rows['id'];
				$lista.='<optgroup label="'.$rows['nombre'].'">';
				$consulta_termino="SELECT * FROM taxonomias WHERE taxonomia = 'termino' AND padre = $atributo ORDER BY nombre;";
				$conexion_termino = mainModel::conectar();
				$terminos = $conexion_termino->query($consulta_termino);
				$terminos = $terminos->fetchAll();
				foreach($terminos as $term)
				{
					$lista.='<option value="'.$term['id'].'">'.$term['nombre'].'</option>';
				}
				$lista.='</optgroup>';
			}
			return $lista;
		}

		public function agregar_producto_controlador()
		{
			$sku=mainModel::limpiar_cadena($_POST['producto-sku-nuevo']);
			$nombre=mainModel::limpiar_cadena($_POST['producto-nombre-nuevo']);
			$slug=mainModel::limpiar_cadena($_POST['producto-slug-nuevo']);
			$descripcion=mainModel::limpiar_cadena($_POST['producto-descripcion-nuevo']);
			$especificaciones=mainModel::limpiar_cadena($_POST['producto-especificaciones-nuevo']);
			$precio=mainModel::limpiar_cadena($_POST['producto-precio-nuevo']);
			$mpn=mainModel::limpiar_cadena($_POST['producto-mpn-nuevo']);
			$fabricante=mainModel::limpiar_cadena($_POST['producto-fabricante-nuevo']);
			$tipo=mainModel::limpiar_cadena($_POST['producto-tipo-nuevo']);
			$stock=mainModel::limpiar_cadena($_POST['producto-stock-nuevo']);
			$nuevo = "no";
			$oferta = "no";
			$verificar=administradorModelo::verificar_producto_slug_disponible($slug);
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
				if(isset($_POST['producto-nuevo-nuevo']))
				{
					$nuevo = "si";
				}
				if(isset($_POST['producto-oferta-nuevo']))
				{
					$oferta = "si";
				}
				$fecha = date("Y/m/d")." ".date("H:i:s");
				$dataAC=[
					"Sku"=>$sku,
					"Nombre"=>$nombre,
					"Slug"=>$slug,
					"Descripcion"=>$descripcion,
					"Especificaciones"=>$especificaciones,
					"Precio"=>$precio,
					"Mpn"=>$mpn,
					"Fabricante"=>$fabricante,
					"Tipo"=>$tipo,
					"Stock"=>$stock,
					"Nuevo"=>$nuevo,
					"Oferta"=>$oferta,
					"Fecha"=>$fecha
				];
				$guardarProducto=administradorModelo::agregar_producto_modelo($dataAC);
				if($guardarProducto->rowCount()>=1)
				{
					if(isset($_POST['producto-imagenes-nuevo']))
					{
						$imagenes=$_POST["producto-imagenes-nuevo"];
						foreach($imagenes as $imagen)
						{
							$dataGaleria=[
								"Producto"=>$sku,
								"Medio"=>$imagen
							];
							$guardarGaleria=administradorModelo::agregar_galeria_modelo($dataGaleria);
						}
					}
					if(isset($_POST['producto-categoria-nuevo']) && $_POST['producto-categoria-nuevo']>0)
					{
						$dataTaxonomia=[
							"Sku"=>$sku,
							"Taxonomia"=>$_POST['producto-categoria-nuevo']
						];
						$guardarTaxonomia=administradorModelo::agregar_relaciones_modelo($dataTaxonomia);
					}
					if(isset($_POST['producto-etiqueta-nuevo']))
					{
						$etiquetas=$_POST["producto-etiqueta-nuevo"];
						foreach($etiquetas as $etiqueta)
						{
							$dataEtiqueta=[
								"Sku"=>$sku,
								"Taxonomia"=>$etiqueta
							];
							$guardarEtiqueta=administradorModelo::agregar_relaciones_modelo($dataEtiqueta);
						}
					}
					if(isset($_POST['producto-atributo-nuevo']))
					{
						$atributos=$_POST["producto-atributo-nuevo"];
						foreach($atributos as $atributo)
						{
							$dataAtributo=[
								"Sku"=>$sku,
								"Taxonomia"=>$atributo
							];
							$guardarAtributo=administradorModelo::agregar_relaciones_modelo($dataAtributo);
						}
					}
					if(isset($_POST['producto-marca-nuevo']) && $_POST['producto-marca-nuevo']>0)
					{
						$dataTaxonomia=[
							"Sku"=>$sku,
							"Taxonomia"=>$_POST['producto-marca-nuevo']
						];
						$guardarTaxonomia=administradorModelo::agregar_relaciones_modelo($dataTaxonomia);
					}
					$alerta=[
						"Alerta"=>"recargar",
						"Titulo"=>"Producto añadido",
						"Texto"=>"El producto se ha añadido con éxito en el sistema",
						"Tipo"=>"success"
					];
				}
				else
				{
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrió un error inesperado",
						"Texto"=>"No hemos podido añadir el producto",
						"Tipo"=>"error"
					];
				}
			}

			return mainModel::sweet_alert($alerta);
		}

		public function paginador_productos_controlador($pagina,$registros,$busqueda){

			$pagina=mainModel::limpiar_cadena($pagina);
			$registros=mainModel::limpiar_cadena($registros);
			$busqueda=mainModel::limpiar_cadena($busqueda);
			$tabla="";
		
			$pagina= (isset($pagina) && $pagina>0) ? (int) $pagina : 1;
			$inicio= ($pagina>0) ? (($pagina*$registros)-$registros) : 0;
		
			if(isset($busqueda) && $busqueda!=""){
				$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM productos WHERE 
				nombre LIKE '%$busqueda%' OR 
				slug LIKE '%$busqueda%' OR 
				descripcion LIKE '%$busqueda%' OR 
				sku LIKE '%$busqueda%' OR 
				mpn LIKE '%$busqueda%' OR 
				fabricante LIKE '%$busqueda%' OR 
				tipo LIKE '%$busqueda%' OR 
				nuevo LIKE '%$busqueda%' OR 
				precio LIKE '%$busqueda%' OR 
				precio_visitantes LIKE '%$busqueda%' OR 
				precio_usuarios LIKE '%$busqueda%' OR 
				precio_empresas LIKE '%$busqueda%' OR 
				stock LIKE '%$busqueda%' OR 
				oferta LIKE '%$busqueda%' OR 
				fecha LIKE '%$busqueda%' 
				ORDER BY fecha DESC LIMIT $inicio,$registros";
				$paginaurl="buscar-productos";
			}else{
				$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM productos ORDER BY fecha DESC LIMIT $inicio,$registros";
				$paginaurl="productos";
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
								<th>SKU</th>
								<th>Nombre</th>
								<th>Slug</th>
								<th>Fecha</th>
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
							<td>'.$rows['sku'].'</td>
							<td>'.$rows['nombre'].'</td>
							<td>'.$rows['slug'].'</td>
							<td>'.$rows['fecha'].'</td>
							<td>
								<form action="'.SERVERURL.'editar-producto/" method="POST"  entype="multipart/form-data" autocomplete="off" style="display: inherit;">
									<input type="hidden" name="producto-sku-editar" value="'.$rows['sku'].'">
									<button type="submit" class="btn btn-info">
										<i class="fas fa-pencil-alt"></i>
									</button>
								</form>
							</td>
							<td>
								<form action="'.SERVERURL.'ajax/administradorAjax.php" method="POST" class="FormularioAjax" data-form="delete" entype="multipart/form-data" autocomplete="off" style="float: right;">
									<input type="hidden" name="producto-sku-eliminar" value="'.$rows['sku'].'">
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

		public function eliminar_producto_controlador(){
			$codigo=mainModel::limpiar_cadena($_POST['producto-sku-eliminar']);
			$DelCat=administradorModelo::eliminar_producto_modelo($codigo);
			if($DelCat->rowCount()>=1)
			{
				$limpieza=administradorModelo::limpiar_galeria_modelo($codigo);
				$limpiar=administradorModelo::limpiar_relaciones_modelo($codigo);
				$limpiar_descuentos=administradorModelo::limpiar_descuentos_relaciones_modelo($codigo, "producto");
				$alerta=[
					"Alerta"=>"recargar",
					"Titulo"=>"Producto eliminado",
					"Texto"=>"El producto fue eliminado del sistema con éxito",
					"Tipo"=>"success"
				];
			}
			else
			{
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"No se ha podido eliminar este producto en este momento",
					"Tipo"=>"error"
				];
			}
			return mainModel::sweet_alert($alerta);
		}

		public function obtener_info_productos_controlador($codigo)
		{
			$sql=mainModel::conectar()->prepare("SELECT * FROM productos WHERE sku=:Codigo");
			$sql->bindParam(":Codigo",$codigo);
			$sql->execute();
			return $sql;
		}

		public function cargar_galeria_relaciones_productos_controlador($sku)
		{
			$consulta="SELECT medio FROM galerias WHERE producto = '$sku';";
			$conexion = mainModel::conectar();
			$datos = $conexion->query($consulta);
			$datos = $datos->fetchAll();
			return $datos;
		}

		public function cargar_galeria_relaciones_editar_productos_controlador($sku)
		{
			$consulta="SELECT producto, medio FROM galerias WHERE producto = '$sku';";
			$conexion = mainModel::conectar();
			$datos = $conexion->query($consulta);
			$datos = $datos->fetchAll();
			return $datos;
		}
		
		public function cargar_medios_productos_controlador($imagenes)
		{
			$lista="";
			$consulta="SELECT id, titulo, url FROM medios;";
			$conexion = mainModel::conectar();
			$datos = $conexion->query($consulta);
			$datos = $datos->fetchAll();
			$seleccionar = $imagenes;
			foreach($datos as $rows)
			{
				if (empty($seleccionar))
				{
					$lista.='<option value="'.$rows['id'].'" data-url-image="'.$rows['url'].'">'.$rows['titulo'].'</option>';
				}
				else
				{
					$adicion = false;
					foreach($seleccionar as $imagen)
					{
						if ($imagen[0] == $rows['id'])
						{
							$lista.='<option value="'.$rows['id'].'" data-url-image="'.$rows['url'].'" selected="">'.$rows['titulo'].'</option>';
							$adicion = true;
						}
					}
					if($adicion == false)
					{
						$lista.='<option value="'.$rows['id'].'" data-url-image="'.$rows['url'].'">'.$rows['titulo'].'</option>';
					}
				}
			}
			return $lista;
		}

		public function cargar_relaciones_productos_controlador($sku)
		{
			$consulta="SELECT id_taxonomia FROM relaciones WHERE sku = '$sku';";
			$conexion = mainModel::conectar();
			$datos = $conexion->query($consulta);
			$datos = $datos->fetchAll();
			return $datos;
		}

		public function cargar_relaciones_editar_productos_controlador($sku)
		{
			$consulta="SELECT sku, id_taxonomia FROM relaciones WHERE sku = '$sku';";
			$conexion = mainModel::conectar();
			$datos = $conexion->query($consulta);
			$datos = $datos->fetchAll();
			return $datos;
		}

		public function cargar_taxonomias_productos_controlador($taxonomias, $taxonomia)
		{
			$lista="";
			$consulta="SELECT id, nombre FROM taxonomias WHERE taxonomia = '$taxonomia';";
			$conexion = mainModel::conectar();
			$datos = $conexion->query($consulta);
			$datos = $datos->fetchAll();
			$seleccionar = $taxonomias;
			$activo = false;
			foreach($datos as $rows)
			{
				if (!empty($seleccionar))
				{
					foreach($seleccionar as $tax)
					{
						if ($tax[0] == $rows['id'])
						{
							$lista.='<option value="'.$rows['id'].'" selected="">'.$rows['nombre'].'</option>';
							$activo = true;
						}
					}
				}
				if($activo == false){
					$lista.='<option value="'.$rows['id'].'">'.$rows['nombre'].'</option>';
				}
				else{
					$activo = false;
				}
			}
			return $lista;
		}

		public function cargar_taxonomias_categorias_productos_controlador($taxonomias, $taxonomia)
		{
			$lista="";
			$consulta="SELECT id, nombre FROM taxonomias WHERE taxonomia = '$taxonomia';";
			$conexion = mainModel::conectar();
			$datos = $conexion->query($consulta);
			$datos = $datos->fetchAll();
			$seleccionar = $taxonomias;
			$activo = false;
			foreach($datos as $rows)
			{
				$consultaRegla="SELECT * FROM reglas WHERE id_categoria = '".$rows['id']."'";
				$conexionRegla = mainModel::conectar();
				$datosRegla = $conexionRegla->query($consultaRegla);
				$datosRegla = $datosRegla->fetchAll();
				$reglaV;
				$reglaU;
				$reglaE;
				foreach($datosRegla as $rowsRegla)
				{
					$reglaV = $rowsRegla[1];
					$reglaU = $rowsRegla[2];
					$reglaE = $rowsRegla[3];
				}
				if (!empty($seleccionar))
				{
					foreach($seleccionar as $tax)
					{
						if ($tax[0] == $rows['id'])
						{
							$lista.='<option value="'.$rows['id'].'" data-rv="'.$reglaV.'" data-ru="'.$reglaU.'" data-re="'.$reglaE.'" selected="">'.$rows['nombre'].'</option>';
							$activo = true;
						}
					}
				}
				if($activo == false){
					$lista.='<option value="'.$rows['id'].'" data-rv="'.$reglaV.'" data-ru="'.$reglaU.'" data-re="'.$reglaE.'">'.$rows['nombre'].'</option>';
				}
				else{
					$activo = false;
				}
			}
			return $lista;
		}

		public function cargar_taxonomias_marcas_productos_controlador($taxonomias, $taxonomia)
		{
			$lista="";
			$consulta="SELECT id, nombre FROM taxonomias WHERE taxonomia = '$taxonomia';";
			$conexion = mainModel::conectar();
			$datos = $conexion->query($consulta);
			$datos = $datos->fetchAll();
			$seleccionar = $taxonomias;
			$activo = false;
			foreach($datos as $rows)
			{
				if (!empty($seleccionar))
				{
					foreach($seleccionar as $tax)
					{
						if ($tax[0] == $rows['id'])
						{
							$lista.='<option value="'.$rows['id'].'" selected="">'.$rows['nombre'].'</option>';
							$activo = true;
						}
					}
				}
				if($activo == false){
					$lista.='<option value="'.$rows['id'].'">'.$rows['nombre'].'</option>';
				}
				else{
					$activo = false;
				}
			}
			return $lista;
		}

		public function cargar_atributos_productos_controlador($activos)
		{
			$lista="";
			$consulta="SELECT * FROM taxonomias WHERE taxonomia = 'atributo' ORDER BY nombre;";
			$conexion = mainModel::conectar();
			$atributos = $conexion->query($consulta);
			$atributos = $atributos->fetchAll();
			$atributo = "";
			$seleccionar = $activos;
			$activo = false;
			foreach($atributos as $rows)
			{
				$atributo = $rows['id'];
				$lista.='<optgroup label="'.$rows['nombre'].'">';
				$consulta_termino="SELECT * FROM taxonomias WHERE taxonomia = 'termino' AND padre = $atributo ORDER BY nombre;";
				$conexion_termino = mainModel::conectar();
				$terminos = $conexion_termino->query($consulta_termino);
				$terminos = $terminos->fetchAll();
				foreach($terminos as $term)
				{
					if (!empty($seleccionar))
					{
						foreach($seleccionar as $tax)
						{
							if ($tax[0] == $term['id'])
							{
								$lista.='<option value="'.$term['id'].'" selected="">'.$term['nombre'].'</option>';
								$activo = true;
							}
						}
					}
					if($activo == false){
						$lista.='<option value="'.$term['id'].'">'.$term['nombre'].'</option>';
					}
					else{
						$activo = false;
					}
				}
				$lista.='</optgroup>';
			}
			return $lista;
		}

		public function editar_producto_controlador()
		{
			$sku_original=mainModel::limpiar_cadena($_POST['producto-sku-original-editar']);
			$sku=mainModel::limpiar_cadena($_POST['producto-sku-editar']);
			$nombre=mainModel::limpiar_cadena($_POST['producto-nombre-editar']);
			$slug=mainModel::limpiar_cadena($_POST['producto-slug-editar']);
			$descripcion=mainModel::limpiar_cadena($_POST['producto-descripcion-editar']);
			$especificaciones=mainModel::limpiar_cadena($_POST['producto-especificaciones-editar']);
			$precio=mainModel::limpiar_cadena($_POST['producto-precio-editar']);
			$mpn=mainModel::limpiar_cadena($_POST['producto-mpn-editar']);
			$fabricante=mainModel::limpiar_cadena($_POST['producto-fabricante-editar']);
			$tipo=mainModel::limpiar_cadena($_POST['producto-tipo-editar']);
			$stock=mainModel::limpiar_cadena($_POST['producto-stock-editar']);
			$nuevo = "no";
			$oferta = "no";
			$verificar=administradorModelo::verificar_producto_editar_slug_disponible($slug, $sku_original);
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
				if(isset($_POST['producto-nuevo-editar']))
				{
					$nuevo = "si";
				}
				if(isset($_POST['producto-oferta-editar']))
				{
					$oferta = "si";
				}
				$dataAC=[
					"Original"=>$sku_original,
					"Sku"=>$sku,
					"Nombre"=>$nombre,
					"Slug"=>$slug,
					"Descripcion"=>$descripcion,
					"Especificaciones"=>$especificaciones,
					"Precio"=>$precio,
					"Mpn"=>$mpn,
					"Fabricante"=>$fabricante,
					"Tipo"=>$tipo,
					"Stock"=>$stock,
					"Nuevo"=>$nuevo,
					"Oferta"=>$oferta
				];
				$actualizarProducto=administradorModelo::editar_producto_modelo($dataAC);
				if($actualizarProducto->rowCount()>=1 || isset($_POST['producto-imagenes-editar']) || isset($_POST['producto-categoria-editar']) || isset($_POST['producto-etiqueta-editar']) || isset($_POST['producto-atributo-editar']))
				{	
					if($sku != $sku_original)
					{
						$actualizarGalerias=administradorModelo::producto_cambio_slug_galeria_modelo($sku, $sku_original);
						$actualizarRelaciones=administradorModelo::producto_cambio_slug_relacion_modelo($sku, $sku_original);
						$actualizarRelacionesDescuentos=administradorModelo::producto_cambio_slug_relacion_descuento_modelo($sku, $sku_original);
					}
					if(isset($_POST['producto-imagenes-editar']))
					{
						$relaciones_galerias = array();
						foreach($_POST['producto-imagenes-editar'] as $img)
						{
							array_push($relaciones_galerias, array("producto"=>$sku,"medio"=>$img));
						}
				
						$relaciones_galerias_existentes = administradorControlador::cargar_galeria_relaciones_editar_productos_controlador($sku);
				
						$nuevasImagenes = array();
						foreach($relaciones_galerias as $medio)
						{
							$agregar = true;
							foreach($relaciones_galerias_existentes as $medio2)
							{
								if ($medio['medio'] == $medio2['medio'])
								{
									$agregar = false;
								}
							}
							if ($agregar == true) {
								array_push($nuevasImagenes, array("producto"=>$sku,"medio"=>$medio['medio']));
							}
						}
				
						$viejasImagenes = array();
						foreach($relaciones_galerias_existentes as $medio)
						{
							$agregar = true;
							foreach($relaciones_galerias as $medio2)
							{
								if ($medio['medio'] == $medio2['medio'])
								{
									$agregar = false;
								}
							}
							if ($agregar == true) {
								array_push($viejasImagenes, array("producto"=>$sku,"medio"=>$medio['medio']));
							}
						}
				
						if(count($nuevasImagenes)>0)
						{
							foreach($nuevasImagenes as $imagen)
							{
								$dataGaleria=[
									"Producto"=>$sku,
									"Medio"=>$imagen["medio"]
								];
								$guardarGaleria=administradorModelo::agregar_galeria_modelo($dataGaleria);
							}
						}
				
						if(count($viejasImagenes)>0)
						{
							foreach($viejasImagenes as $imagen)
							{
								$dataGaleria=[
									"Producto"=>$sku,
									"Medio"=>$imagen["medio"]
								];
								$eliminarGaleria=administradorModelo::eliminar_galeria_modelo($dataGaleria);
							}
						}
					}
					else
					{
						$eliminarGalerias=administradorModelo::eliminar_galerias_modelo($sku);
					}			
					
					$relaciones_taxonomias = array();
					if(isset($_POST['producto-categoria-editar']) && $_POST['producto-categoria-editar']>0)
					{
						array_push($relaciones_taxonomias, array("sku"=>$sku,"id_taxonomia"=>$_POST['producto-categoria-editar']));
					}
					if(isset($_POST['producto-etiqueta-editar']))
					{
						foreach($_POST['producto-etiqueta-editar'] as $tax)
						{
							array_push($relaciones_taxonomias, array("sku"=>$sku,"id_taxonomia"=>$tax));
						}
					}
					if(isset($_POST['producto-atributo-editar']))
					{
						foreach($_POST['producto-atributo-editar'] as $tax)
						{
							array_push($relaciones_taxonomias, array("sku"=>$sku,"id_taxonomia"=>$tax));
						}
					}
					if(isset($_POST['producto-marca-editar']) && $_POST['producto-marca-editar']>0)
					{
						array_push($relaciones_taxonomias, array("sku"=>$sku,"id_taxonomia"=>$_POST['producto-marca-editar']));
					}
				
					$relaciones_taxonomias_existentes = administradorControlador::cargar_relaciones_editar_productos_controlador($sku);
								
					$nuevasTaxonomias = array();
					foreach($relaciones_taxonomias as $tax)
					{
						$agregar = true;
						foreach($relaciones_taxonomias_existentes as $tax2)
						{
							if ($tax['id_taxonomia'] == $tax2['id_taxonomia'])
							{
								$agregar = false;
							}
						}
						if ($agregar == true) {
							array_push($nuevasTaxonomias, array("sku"=>$sku,"id_taxonomia"=>$tax['id_taxonomia']));
						}
					}
				
					$viejasRelaciones = array();
					foreach($relaciones_taxonomias_existentes as $tax)
					{
						$agregar = true;
						foreach($relaciones_taxonomias as $tax2)
						{
							if ($tax['id_taxonomia'] == $tax2['id_taxonomia'])
							{
								$agregar = false;
							}
						}
						if ($agregar == true) {
							array_push($viejasRelaciones, array("sku"=>$sku,"id_taxonomia"=>$tax['id_taxonomia']));
						}
					}
				
					if(count($nuevasTaxonomias)>0)
					{
						foreach($nuevasTaxonomias as $taxonomia)
						{
							$dataTaxonomias=[
								"Sku"=>$sku,
								"Taxonomia"=>$taxonomia["id_taxonomia"]
							];
							$guardarRelacion=administradorModelo::agregar_relaciones_modelo($dataTaxonomias);
						}
					}
				
					if(count($viejasRelaciones)>0)
					{
						foreach($viejasRelaciones as $taxonomia)
						{
							$dataTaxonomias=[
								"Sku"=>$sku,
								"Taxonomia"=>$taxonomia["id_taxonomia"]
							];
							$eliminarRelacion=administradorModelo::eliminar_relaciones_modelo($dataTaxonomias);
						}
					}

					$alerta=[
						"Alerta"=>"recargar",
						"Titulo"=>"Producto actualizado",
						"Texto"=>"El producto se ha actualizado con éxito en el sistema",
						"Tipo"=>"success"
					];
				}
				else
				{
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrió un error inesperado",
						"Texto"=>"No hemos podido actualizar el producto",
						"Tipo"=>"error"
					];
				}
			}

			return mainModel::sweet_alert($alerta);
		}

		//CONTROLADORES PARA DESCUENTOS
		public function agregar_descuento_controlador()
		{
			$nombre=mainModel::limpiar_cadena($_POST['descuento-nombre-nuevo']);
			$descripcion=mainModel::limpiar_cadena($_POST['descuento-descripcion-nuevo']);
			$tipo=mainModel::limpiar_cadena($_POST['descuento-tipo-nuevo']);
			$visitantes=mainModel::limpiar_cadena($_POST['descuento-visitantes-nuevo']);
			$usuarios=mainModel::limpiar_cadena($_POST['descuento-usuarios-nuevo']);
			$empresas=mainModel::limpiar_cadena($_POST['descuento-empresas-nuevo']);
			$inicio=mainModel::limpiar_cadena($_POST['descuento-inicio-nuevo']);
			$vencimiento=mainModel::limpiar_cadena($_POST['descuento-vencimiento-nuevo']);
			$dataAC=[
				"Nombre"=>$nombre,
				"Descripcion"=>$descripcion,
				"Tipo"=>$tipo,
				"Visitantes"=>$visitantes,
				"Usuarios"=>$usuarios,
				"Empresas"=>$empresas,
				"Inicio"=>$inicio,
				"Vencimiento"=>$vencimiento
			];
			$guardarDescuento=administradorModelo::agregar_descuento_modelo($dataAC);
			if($guardarDescuento->rowCount()>=1)
			{
				$descuentoDatos=administradorModelo::descuento_max_modelo($dataAC);
				$id_descuento=$descuentoDatos->fetch();
				if(isset($_POST['descuento-productos-nuevo']))
				{
					$relaciones=$_POST["descuento-productos-nuevo"];
					foreach($relaciones as $relacion)
					{
						$dataRelaciones=[
							"Id"=>$id_descuento[0],
							"Item"=>$relacion,
							"Tipo"=>"producto"
						];
						$guardarEtiqueta=administradorModelo::agregar_relaciones_descuento_modelo($dataRelaciones);
					}
				}
				if(isset($_POST['descuento-categorias-nuevo']))
				{
					$relaciones=$_POST["descuento-categorias-nuevo"];
					foreach($relaciones as $relacion)
					{
						$dataRelaciones=[
							"Id"=>$id_descuento[0],
							"Item"=>$relacion,
							"Tipo"=>"categoria"
						];
						$guardarAtributo=administradorModelo::agregar_relaciones_descuento_modelo($dataRelaciones);
					}
				}
				if(isset($_POST['descuento-etiquetas-nuevo']))
				{
					$relaciones=$_POST["descuento-etiquetas-nuevo"];
					foreach($relaciones as $relacion)
					{
						$dataRelaciones=[
							"Id"=>$id_descuento[0],
							"Item"=>$relacion,
							"Tipo"=>"etiqueta"
						];
						$guardarEtiqueta=administradorModelo::agregar_relaciones_descuento_modelo($dataRelaciones);
					}
				}
				if(isset($_POST['descuento-atributos-nuevo']))
				{
					$relaciones=$_POST["descuento-atributos-nuevo"];
					foreach($relaciones as $relacion)
					{
						$dataRelaciones=[
							"Id"=>$id_descuento[0],
							"Item"=>$relacion,
							"Tipo"=>"atributo"
						];
						$guardarAtributo=administradorModelo::agregar_relaciones_descuento_modelo($dataRelaciones);
					}
				}
				if(isset($_POST['descuento-marca-nuevo']))
				{
					$relaciones=$_POST["descuento-marca-nuevo"];
					foreach($relaciones as $relacion)
					{
						$dataRelaciones=[
							"Id"=>$id_descuento[0],
							"Item"=>$relacion,
							"Tipo"=>"marca"
						];
						$guardarMarca=administradorModelo::agregar_relaciones_descuento_modelo($dataRelaciones);
					}
				}
				$alerta=[
					"Alerta"=>"recargar",
					"Titulo"=>"Descuento añadido",
					"Texto"=>"El descuento se ha añadido con éxito en el sistema",
					"Tipo"=>"success"
				];
			}
			else
			{
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"No hemos podido añadir el descuento",
					"Tipo"=>"error"
				];
			}
		
			return mainModel::sweet_alert($alerta);
		}

		public function paginador_descuentos_controlador($pagina,$registros,$busqueda)
		{
			$pagina=mainModel::limpiar_cadena($pagina);
			$registros=mainModel::limpiar_cadena($registros);
			$busqueda=mainModel::limpiar_cadena($busqueda);
			$tabla="";
		
			$pagina= (isset($pagina) && $pagina>0) ? (int) $pagina : 1;
			$inicio= ($pagina>0) ? (($pagina*$registros)-$registros) : 0;
		
			if(isset($busqueda) && $busqueda!=""){
				$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM descuentos WHERE 
				nombre LIKE '%$busqueda%' OR
				descripcion LIKE '%$busqueda%' OR
				tipo_descuento LIKE '%$busqueda%' OR
				inicio LIKE '%$busqueda%' OR
				vencimiento LIKE '%$busqueda%'
				ORDER BY id DESC LIMIT $inicio,$registros";
				$paginaurl="buscar-descuentos";
			}else{
				$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM descuentos ORDER BY id DESC LIMIT $inicio,$registros";
				$paginaurl="descuentos";
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
								<th>Tipo</th>
								<th>Inicio</th>
								<th>Vencimiento</th>
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
							<td>'.$rows['tipo_descuento'].'</td>
							<td>'.$rows['inicio'].'</td>
							<td>'.$rows['vencimiento'].'</td>
							<td>
								<form action="'.SERVERURL.'editar-descuento/" method="POST"  entype="multipart/form-data" autocomplete="off" style="display: inherit;">
									<input type="hidden" name="descuento-id-editar" value="'.$rows['id'].'">
									<button type="submit" class="btn btn-info">
										<i class="fas fa-pencil-alt"></i>
									</button>
								</form>
							</td>
							<td>
								<form action="'.SERVERURL.'ajax/administradorAjax.php" method="POST" class="FormularioAjax" data-form="delete" entype="multipart/form-data" autocomplete="off" style="float: right;">
									<input type="hidden" name="descuento-id-eliminar" value="'.$rows['id'].'">
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

		public function eliminar_descuento_controlador()
		{
			$codigo=mainModel::limpiar_cadena($_POST['descuento-id-eliminar']);
			$DelCat=administradorModelo::eliminar_descuento_modelo($codigo);
			if($DelCat->rowCount()>=1)
			{
				$limpieza=administradorModelo::limpiar_descuento_modelo($codigo);
				$alerta=[
					"Alerta"=>"recargar",
					"Titulo"=>"Descuento eliminado",
					"Texto"=>"El descuento fue eliminado del sistema con éxito",
					"Tipo"=>"success"
				];
			}
			else
			{
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"No se ha podido eliminar este descuento en este momento",
					"Tipo"=>"error"
				];
			}
			return mainModel::sweet_alert($alerta);
		}
		
		public function obtener_info_descuentos_controlador($codigo)
		{
			$sql=mainModel::conectar()->prepare("SELECT * FROM descuentos WHERE id=:Codigo");
			$sql->bindParam(":Codigo",$codigo);
			$sql->execute();
			return $sql;
		}

		public function cargar_relaciones_descuentos_controlador($id)
		{
			$consulta="SELECT item, tipo FROM descuentos_relaciones WHERE id_descuento = '$id';";
			$conexion = mainModel::conectar();
			$datos = $conexion->query($consulta);
			$datos = $datos->fetchAll();
			return $datos;
		}

		public function relaciones_categorias_descuentos_controlador($items)
		{
			$lista="";
			$consulta="SELECT id, nombre FROM taxonomias WHERE taxonomia = 'categoria';";
			$conexion = mainModel::conectar();
			$datos = $conexion->query($consulta);
			$datos = $datos->fetchAll();
			$seleccionar = $items;
			$activo = false;
			foreach($datos as $rows)
			{
				if (!empty($seleccionar))
				{
					foreach($seleccionar as $tax)
					{
						if ($tax[0] == $rows['id'] && $tax[1] == "categoria")
						{
							$lista.='<option value="'.$rows['id'].'" selected="">'.$rows['nombre'].'</option>';
							$activo = true;
						}
					}
				}
				if($activo == false){
					$lista.='<option value="'.$rows['id'].'">'.$rows['nombre'].'</option>';
				}
				else{
					$activo = false;
				}
			}
			return $lista;
		}

		public function relaciones_etiquetas_descuentos_controlador($items)
		{
			$lista="";
			$consulta="SELECT id, nombre FROM taxonomias WHERE taxonomia = 'etiqueta';";
			$conexion = mainModel::conectar();
			$datos = $conexion->query($consulta);
			$datos = $datos->fetchAll();
			$seleccionar = $items;
			$activo = false;
			foreach($datos as $rows)
			{
				if (!empty($seleccionar))
				{
					foreach($seleccionar as $tax)
					{
						if ($tax[0] == $rows['id'] && $tax[1] == "etiqueta")
						{
							$lista.='<option value="'.$rows['id'].'" selected="">'.$rows['nombre'].'</option>';
							$activo = true;
						}
					}
				}
				if($activo == false){
					$lista.='<option value="'.$rows['id'].'">'.$rows['nombre'].'</option>';
				}
				else{
					$activo = false;
				}
			}
			return $lista;
		}

		public function relaciones_marcas_descuentos_controlador($items)
		{
			$lista="";
			$consulta="SELECT id, nombre FROM taxonomias WHERE taxonomia = 'marca';";
			$conexion = mainModel::conectar();
			$datos = $conexion->query($consulta);
			$datos = $datos->fetchAll();
			$seleccionar = $items;
			$activo = false;
			foreach($datos as $rows)
			{
				if (!empty($seleccionar))
				{
					foreach($seleccionar as $tax)
					{
						if ($tax[0] == $rows['id'] && $tax[1] == "marca")
						{
							$lista.='<option value="'.$rows['id'].'" selected="">'.$rows['nombre'].'</option>';
							$activo = true;
						}
					}
				}
				if($activo == false){
					$lista.='<option value="'.$rows['id'].'">'.$rows['nombre'].'</option>';
				}
				else{
					$activo = false;
				}
			}
			return $lista;
		}

		public function relaciones_atributos_descuentos_controlador($activos)
		{
			$lista="";
			$consulta="SELECT * FROM taxonomias WHERE taxonomia = 'atributo' ORDER BY nombre;";
			$conexion = mainModel::conectar();
			$atributos = $conexion->query($consulta);
			$atributos = $atributos->fetchAll();
			$atributo = "";
			$seleccionar = $activos;
			$activo = false;
			foreach($atributos as $rows)
			{
				$atributo = $rows['id'];
				$lista.='<optgroup label="'.$rows['nombre'].'">';
				$consulta_termino="SELECT * FROM taxonomias WHERE taxonomia = 'termino' AND padre = $atributo ORDER BY nombre;";
				$conexion_termino = mainModel::conectar();
				$terminos = $conexion_termino->query($consulta_termino);
				$terminos = $terminos->fetchAll();
				foreach($terminos as $term)
				{
					if (!empty($seleccionar))
					{
						foreach($seleccionar as $tax)
						{
							if ($tax[0] == $term['id'] && $tax[1] == "atributo")
							{
								$lista.='<option value="'.$term['id'].'" selected="">'.$term['nombre'].'</option>';
								$activo = true;
							}
						}
					}
					if($activo == false){
						$lista.='<option value="'.$term['id'].'">'.$term['nombre'].'</option>';
					}
					else{
						$activo = false;
					}
				}
				$lista.='</optgroup>';
			}
			return $lista;
		}

		public function relaciones_productos_descuentos_controlador($items)
		{
			$lista="";
			$consulta="SELECT sku, nombre FROM productos;";
			$conexion = mainModel::conectar();
			$datos = $conexion->query($consulta);
			$datos = $datos->fetchAll();
			$seleccionar = $items;
			$activo = false;
			foreach($datos as $rows)
			{
				if (!empty($seleccionar))
				{
					foreach($seleccionar as $tax)
					{
						if ($tax[0] == $rows['sku'] && $tax[1] == "producto")
						{
							$lista.='<option value="'.$rows['sku'].'" selected="">'.$rows['nombre'].'</option>';
							$activo = true;
						}
					}
				}
				if($activo == false){
					$lista.='<option value="'.$rows['sku'].'">'.$rows['nombre'].'</option>';
				}
				else{
					$activo = false;
				}
			}
			return $lista;
		}

		public function cargar_relaciones_descuentos_editar_controlador($id)
		{
			$consulta="SELECT id_descuento, item, tipo FROM descuentos_relaciones WHERE id_descuento = $id;";
			$conexion = mainModel::conectar();
			$datos = $conexion->query($consulta);
			$datos = $datos->fetchAll();
			return $datos;
		}

		public function editar_descuento_controlador()
		{
			$id=mainModel::limpiar_cadena($_POST['descuento-id-editar']);
			$nombre=mainModel::limpiar_cadena($_POST['descuento-nombre-editar']);
			$descripcion=mainModel::limpiar_cadena($_POST['descuento-descripcion-editar']);
			$tipo=mainModel::limpiar_cadena($_POST['descuento-tipo-editar']);
			$visitantes=mainModel::limpiar_cadena($_POST['descuento-visitantes-editar']);
			$usuarios=mainModel::limpiar_cadena($_POST['descuento-usuarios-editar']);
			$empresas=mainModel::limpiar_cadena($_POST['descuento-empresas-editar']);
			$inicio=mainModel::limpiar_cadena($_POST['descuento-inicio-editar']);
			$vencimiento=mainModel::limpiar_cadena($_POST['descuento-vencimiento-editar']);
			$dataAC=[
				"Id"=>$id,
				"Nombre"=>$nombre,
				"Descripcion"=>$descripcion,
				"Tipo"=>$tipo,
				"Visitantes"=>$visitantes,
				"Usuarios"=>$usuarios,
				"Empresas"=>$empresas,
				"Inicio"=>$inicio,
				"Vencimiento"=>$vencimiento
			];
			$actualizarProducto=administradorModelo::editar_descuento_modelo($dataAC);
			if($actualizarProducto->rowCount()>=1 || $_POST['descuento-productos-editar'] || $_POST['descuento-categorias-editar'] || $_POST['descuento-etiquetas-editar'] || $_POST['descuento-atributos-editar'])
			{
				$relaciones_descuentos = array();
				if(isset($_POST['descuento-productos-editar']))
				{
					foreach($_POST['descuento-productos-editar'] as $tax)
					{
						array_push($relaciones_descuentos, array("id_descuento"=>$id,"item"=>$tax,"tipo"=>"producto"));
					}
				}
				if(isset($_POST['descuento-categorias-editar']))
				{
					foreach($_POST['descuento-categorias-editar'] as $tax)
					{
						array_push($relaciones_descuentos, array("id_descuento"=>$id,"item"=>$tax,"tipo"=>"categoria"));
					}
				}
				if(isset($_POST['descuento-etiquetas-editar']))
				{
					foreach($_POST['descuento-etiquetas-editar'] as $tax)
					{
						array_push($relaciones_descuentos, array("id_descuento"=>$id,"item"=>$tax,"tipo"=>"etiqueta"));
					}
				}
				if(isset($_POST['descuento-atributos-editar']))
				{
					foreach($_POST['descuento-atributos-editar'] as $tax)
					{
						array_push($relaciones_descuentos, array("id_descuento"=>$id,"item"=>$tax,"tipo"=>"atributo"));
					}
				}
				if(isset($_POST['descuento-marcas-editar']))
				{
					foreach($_POST['descuento-marcas-editar'] as $tax)
					{
						array_push($relaciones_descuentos, array("id_descuento"=>$id,"item"=>$tax,"tipo"=>"marca"));
					}
				}
				$relaciones_descuentos_existentes = administradorControlador::cargar_relaciones_descuentos_editar_controlador($id);			
				$nuevasRelaciones = array();
				foreach($relaciones_descuentos as $tax)
				{
					$agregar = true;
					foreach($relaciones_descuentos_existentes as $tax2)
					{
						if ($tax['item'] == $tax2['item'] && $tax['tipo'] == $tax2['tipo'])
						{
							$agregar = false;
						}
					}
					if ($agregar == true) {
						array_push($nuevasRelaciones, array("id_descuento"=>$id,"item"=>$tax['item'],"tipo"=>$tax['tipo']));
					}
				}
				$viejasRelaciones = array();
				foreach($relaciones_descuentos_existentes as $tax)
				{
					$agregar = true;
					foreach($relaciones_descuentos as $tax2)
					{
						if ($tax['item'] == $tax2['item'] && $tax['tipo'] == $tax2['tipo'])
						{
							$agregar = false;
						}
					}
					if ($agregar == true) {
						array_push($viejasRelaciones, array("id_descuento"=>$id,"item"=>$tax['item'],"tipo"=>$tax['tipo']));
					}
				}
				if(count($nuevasRelaciones)>0)
				{
					foreach($nuevasRelaciones as $tax)
					{
						$dataTaxonomias=[
							"Id"=>$id,
							"Item"=>$tax['item'],
							"Tipo"=>$tax['tipo']
						];
						$guardarRelacion=administradorModelo::agregar_relaciones_descuento_modelo($dataTaxonomias);
					}
				}
				if(count($viejasRelaciones)>0)
				{
					foreach($viejasRelaciones as $tax)
					{
						$dataTaxonomias=[
							"Id"=>$id,
							"Item"=>$tax['item'],
							"Tipo"=>$tax['tipo']
						];
						$eliminarRelacion=administradorModelo::eliminar_relaciones_descuento_modelo($dataTaxonomias);
					}
				}
				$alerta=[
					"Alerta"=>"recargar",
					"Titulo"=>"Descuento actualizado",
					"Texto"=>"El descuento se ha actualizado con éxito en el sistema",
					"Tipo"=>"success"
				];
			}
			else
			{
				$alerta=[
					"Alerta"=>"recargar",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"No hemos podido actualizar el descuento",
					"Tipo"=>"error"
				];
			}
			return mainModel::sweet_alert($alerta);
		}

		// CONTROLADORES PARA MARCAS
		public function agregar_marca_controlador()
		{
			$nombre=mainModel::limpiar_cadena($_POST['marca-nombre-nueva']);
			$slug=mainModel::limpiar_cadena($_POST['marca-slug-nueva']);
			$descripcion=mainModel::limpiar_cadena($_POST['marca-descripcion-nueva']);
			$icono=mainModel::limpiar_cadena($_POST['marca-icono-nueva']);
			$icono2=mainModel::limpiar_cadena($_POST['marca-icono2-nueva']);
			$color=mainModel::limpiar_cadena($_POST['marca-color-nueva']);

			$verificar=administradorModelo::verificar_marca_slug_disponible($slug);
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
					"Icono"=>$icono,
					"Icono2"=>$icono2,
					"Color"=>$color
				];
				$guardarMarca=administradorModelo::agregar_marca_modelo($dataAC);
				if($guardarMarca->rowCount()>=1)
				{
					if(isset($_POST['marca-vista-nueva']))
					{
						$agregarVistaCabecera = false;
						$vistaCabecera = array();
						if(isset($_POST['marca-cabecera-nueva']) && $_POST['marca-cabecera-nueva']>0)
						{
							array_push($vistaCabecera, array("cabecera"=>"cabecera","img"=>$_POST['marca-cabecera-nueva']));
							$agregarVistaCabecera = true;
						}
						$agregarVistaSlide = false;
						$vistaSlide = array();
						if(isset($_POST['marca-slide-url-1-nueva']) && isset($_POST['marca-slide-img-1-nueva']) && $_POST['marca-slide-img-1-nueva']>0)
						{
							array_push($vistaSlide, array("url"=>$_POST['marca-slide-url-1-nueva'],"img"=>$_POST['marca-slide-img-1-nueva']));
							$agregarVistaSlide = true;
						}
						if(isset($_POST['marca-slide-url-2-nueva']) && isset($_POST['marca-slide-img-2-nueva']) && $_POST['marca-slide-img-2-nueva']>0)
						{
							array_push($vistaSlide, array("url"=>$_POST['marca-slide-url-2-nueva'],"img"=>$_POST['marca-slide-img-2-nueva']));
							$agregarVistaSlide = true;
						}
						if(isset($_POST['marca-slide-url-3-nueva']) && isset($_POST['marca-slide-img-3-nueva']) && $_POST['marca-slide-img-3-nueva']>0)
						{
							array_push($vistaSlide, array("url"=>$_POST['marca-slide-url-3-nueva'],"img"=>$_POST['marca-slide-img-3-nueva']));
							$agregarVistaSlide = true;
						}
						if(isset($_POST['marca-slide-url-4-nueva']) && isset($_POST['marca-slide-img-4-nueva']) && $_POST['marca-slide-img-4-nueva']>0)
						{
							array_push($vistaSlide, array("url"=>$_POST['marca-slide-url-4-nueva'],"img"=>$_POST['marca-slide-img-4-nueva']));
							$agregarVistaSlide = true;
						}
						if(isset($_POST['marca-slide-url-5-nueva']) && isset($_POST['marca-slide-img-5-nueva']) && $_POST['marca-slide-img-5-nueva']>0)
						{
							array_push($vistaSlide, array("url"=>$_POST['marca-slide-url-5-nueva'],"img"=>$_POST['marca-slide-img-5-nueva']));
							$agregarVistaSlide = true;
						}
						$agregarVistaModulos = false;
						$vistaModulos = array();
						if(isset($_POST['marca-modulos-url-1-nueva']) && isset($_POST['marca-modulos-img-1-nueva']) && $_POST['marca-modulos-img-1-nueva']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['marca-modulos-url-1-nueva'],"img"=>$_POST['marca-modulos-img-1-nueva']));
							$agregarVistaModulos = true;
						}
						if(isset($_POST['marca-modulos-url-2-nueva']) && isset($_POST['marca-modulos-img-2-nueva']) && $_POST['marca-modulos-img-2-nueva']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['marca-modulos-url-2-nueva'],"img"=>$_POST['marca-modulos-img-2-nueva']));
							$agregarVistaModulos = true;
						}
						if(isset($_POST['marca-modulos-url-3-nueva']) && isset($_POST['marca-modulos-img-3-nueva']) && $_POST['marca-modulos-img-3-nueva']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['marca-modulos-url-3-nueva'],"img"=>$_POST['marca-modulos-img-3-nueva']));
							$agregarVistaModulos = true;
						}
						if(isset($_POST['marca-modulos-url-4-nueva']) && isset($_POST['marca-modulos-img-4-nueva']) && $_POST['marca-modulos-img-4-nueva']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['marca-modulos-url-4-nueva'],"img"=>$_POST['marca-modulos-img-4-nueva']));
							$agregarVistaModulos = true;
						}
						if(isset($_POST['marca-modulos-url-5-nueva']) && isset($_POST['marca-modulos-img-5-nueva']) && $_POST['marca-modulos-img-5-nueva']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['marca-modulos-url-5-nueva'],"img"=>$_POST['marca-modulos-img-5-nueva']));
							$agregarVistaModulos = true;
						}
						if(isset($_POST['marca-modulos-url-6-nueva']) && isset($_POST['marca-modulos-img-6-nueva']) && $_POST['marca-modulos-img-6-nueva']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['marca-modulos-url-6-nueva'],"img"=>$_POST['marca-modulos-img-6-nueva']));
							$agregarVistaModulos = true;
						}
						if(isset($_POST['marca-modulos-url-7-nueva']) && isset($_POST['marca-modulos-img-7-nueva']) && $_POST['marca-modulos-img-7-nueva']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['marca-modulos-url-7-nueva'],"img"=>$_POST['marca-modulos-img-7-nueva']));
							$agregarVistaModulos = true;
						}
						if(isset($_POST['marca-modulos-url-8-nueva']) && isset($_POST['marca-modulos-img-8-nueva']) && $_POST['marca-modulos-img-8-nueva']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['marca-modulos-url-8-nueva'],"img"=>$_POST['marca-modulos-img-8-nueva']));
							$agregarVistaModulos = true;
						}
						if(isset($_POST['marca-modulos-url-9-nueva']) && isset($_POST['marca-modulos-img-9-nueva']) && $_POST['marca-modulos-img-9-nueva']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['marca-modulos-url-9-nueva'],"img"=>$_POST['marca-modulos-img-9-nueva']));
							$agregarVistaModulos = true;
						}
						if(isset($_POST['marca-modulos-url-10-nueva']) && isset($_POST['marca-modulos-img-10-nueva']) && $_POST['marca-modulos-img-10-nueva']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['marca-modulos-url-10-nueva'],"img"=>$_POST['marca-modulos-img-10-nueva']));
							$agregarVistaModulos = true;
						}
						if(isset($_POST['marca-modulos-url-11-nueva']) && isset($_POST['marca-modulos-img-11-nueva']) && $_POST['marca-modulos-img-11-nueva']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['marca-modulos-url-11-nueva'],"img"=>$_POST['marca-modulos-img-11-nueva']));
							$agregarVistaModulos = true;
						}
						if(isset($_POST['marca-modulos-url-12-nueva']) && isset($_POST['marca-modulos-img-12-nueva']) && $_POST['marca-modulos-img-12-nueva']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['marca-modulos-url-12-nueva'],"img"=>$_POST['marca-modulos-img-12-nueva']));
							$agregarVistaModulos = true;
						}
						if(isset($_POST['marca-modulos-url-13-nueva']) && isset($_POST['marca-modulos-img-13-nueva']) && $_POST['marca-modulos-img-13-nueva']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['marca-modulos-url-13-nueva'],"img"=>$_POST['marca-modulos-img-13-nueva']));
							$agregarVistaModulos = true;
						}
						if(isset($_POST['marca-modulos-url-14-nueva']) && isset($_POST['marca-modulos-img-14-nueva']) && $_POST['marca-modulos-img-14-nueva']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['marca-modulos-url-14-nueva'],"img"=>$_POST['marca-modulos-img-14-nueva']));
							$agregarVistaModulos = true;
						}
						if(isset($_POST['marca-modulos-url-15-nueva']) && isset($_POST['marca-modulos-img-15-nueva']) && $_POST['marca-modulos-img-15-nueva']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['marca-modulos-url-15-nueva'],"img"=>$_POST['marca-modulos-img-15-nueva']));
							$agregarVistaModulos = true;
						}
						$agregarVistaBanner = false;
						$vistaBanner = array();
						if(isset($_POST['marca-banner-publicitario-url-nueva']) && isset($_POST['marca-banner-publicitario-img-nueva']) && $_POST['marca-banner-publicitario-img-nueva']>0)
						{
							array_push($vistaBanner, array("url"=>$_POST['marca-banner-publicitario-url-nueva'],"img"=>$_POST['marca-banner-publicitario-img-nueva']));
							$agregarVistaBanner = true;
						}
						if($agregarVistaSlide == true || $agregarVistaModulos == true || $agregarVistaBanner==true || $agregarVistaCabecera==true)
						{
							$id_marca = administradorModelo::obtener_marca_id_slug_modelo($slug);
							$datos_marca=$id_marca->fetch();
							$dataVistas = [
								"Id"=>$datos_marca['id'],
								"Slides"=>$vistaSlide,
								"Modulos"=>$vistaModulos,
								"Banner"=>$vistaBanner,
								"Cabecera"=>$vistaCabecera
							];
							$guardarReglas = administradorModelo::agregar_vista_marca_modelo($dataVistas);
						}
					}
					$alerta=[
						"Alerta"=>"recargar",
						"Titulo"=>"Marca añadida",
						"Texto"=>"Se ha guardado correctamente la marca en la tienda",
						"Tipo"=>"success"
					];
				}
				else
				{
					$alerta=[
						"Alerta"=>"simple",
						"Titulo"=>"Ocurrió un error inesperado",
						"Texto"=>"No se ha podido guardar la marca",
						"Tipo"=>"error"
					];
				}
			}

			return mainModel::sweet_alert($alerta);
		}

		public function paginador_marcas_controlador($pagina,$registros,$busqueda){

			$pagina=mainModel::limpiar_cadena($pagina);
			$registros=mainModel::limpiar_cadena($registros);
			$busqueda=mainModel::limpiar_cadena($busqueda);
			$tabla="";
		
			$pagina= (isset($pagina) && $pagina>0) ? (int) $pagina : 1;
			$inicio= ($pagina>0) ? (($pagina*$registros)-$registros) : 0;
		
			if(isset($busqueda) && $busqueda!=""){
				$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM taxonomias WHERE (nombre LIKE '%$busqueda%' OR slug LIKE '%$busqueda%' OR descripcion LIKE '%$busqueda%') AND taxonomia = 'marca' ORDER BY id ASC LIMIT $inicio,$registros";
				$paginaurl="buscar-marcas";
			}else{
				$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM taxonomias WHERE taxonomia = 'marca' ORDER BY id DESC LIMIT $inicio,$registros";
				$paginaurl="marcas";
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
								<form action="'.SERVERURL.'editar-marca/" method="POST"  entype="multipart/form-data" autocomplete="off" style="display: inherit;">
									<input type="hidden" name="marca-id-editar" value="'.$rows['id'].'">
									<button type="submit" class="btn btn-info">
										<i class="fas fa-pencil-alt"></i>
									</button>
								</form>
							</td>
							<td>
								<form action="'.SERVERURL.'ajax/administradorAjax.php" method="POST" class="FormularioAjax" data-form="delete" entype="multipart/form-data" autocomplete="off" style="float: right;">
									<input type="hidden" name="marca-id-eliminar" value="'.$rows['id'].'">
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

		public function eliminar_marca_controlador(){
			$codigo=mainModel::limpiar_cadena($_POST['marca-id-eliminar']);
			$DelCat=administradorModelo::eliminar_taxonomia_modelo($codigo);
			if($DelCat->rowCount()>=1)
			{
				$limpiarRelaciones=administradorModelo::limpiar_relaciones_taxonomias_modelo($codigo);
				$limpiar_descuentos=administradorModelo::limpiar_descuentos_relaciones_modelo($codigo, "marca");
				$limpiarVistas=administradorModelo::eliminar_vista_modelo($codigo);
				$alerta=[
					"Alerta"=>"recargar",
					"Titulo"=>"Marca eliminada",
					"Texto"=>"La marca fue eliminada del sistema con éxito",
					"Tipo"=>"success"
				];
			}
			else
			{
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"No se ha podido eliminar esta marca en este momento",
					"Tipo"=>"error"
				];
			}
			return mainModel::sweet_alert($alerta);
		}

		public function editar_marca_controlador()
		{
			$alerta=[
				"Alerta"=>"simple",
				"Titulo"=>"Ocurrió un error",
				"Texto"=>"Ha ocurrido un error inesperado, revisa la información que haz proporcionado por favor.",
				"Tipo"=>"error"
			];
			$codigo=mainModel::limpiar_cadena($_POST['marca-id-editar']);
			$nombre=mainModel::limpiar_cadena($_POST['marca-nombre-editar']);
			$slug=mainModel::limpiar_cadena($_POST['marca-slug-editar']);
			$descripcion=mainModel::limpiar_cadena($_POST['marca-descripcion-editar']);
			$icono=mainModel::limpiar_cadena($_POST['marca-icono-editar']);
			$icono2=mainModel::limpiar_cadena($_POST['marca-icono2-editar']);
			$color=mainModel::limpiar_cadena($_POST['marca-color-editar']);
			$verificar=administradorModelo::verificar_marca_editar_slug_disponible($codigo, $slug);
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
					"Icono"=>$icono,
					"Icono2"=>$icono2,
					"Color"=>$color
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
						"Texto"=>"No se ha podido actualizar la marca, por favor revisa la información que proporcionaste",
						"Tipo"=>"error"
					];
				}
				
				$vistaPersonalizada = administradorControlador::obtener_vista_controlador($codigo);
				if($vistaPersonalizada->rowCount()>=1)
				{
					if(isset($_POST['marca-vista-editar'])) {
						$editarVistaCabecera = false;
						$vistaCabecera = array();
						if(isset($_POST['marca-cabecera-editar']) && $_POST['marca-cabecera-editar']>0)
						{
							array_push($vistaCabecera, array("cabecera"=>"cabecera","img"=>$_POST['marca-cabecera-editar']));
							$editarVistaCabecera = true;
						}
						$editarVistaSlide = false;
						$vistaSlide = array();
						if(isset($_POST['marca-slide-url-1-editar']) && isset($_POST['marca-slide-img-1-editar']) && $_POST['marca-slide-img-1-editar']>0)
						{
							array_push($vistaSlide, array("url"=>$_POST['marca-slide-url-1-editar'],"img"=>$_POST['marca-slide-img-1-editar']));
							$editarVistaSlide = true;
						}
						if(isset($_POST['marca-slide-url-2-editar']) && isset($_POST['marca-slide-img-2-editar']) && $_POST['marca-slide-img-2-editar']>0)
						{
							array_push($vistaSlide, array("url"=>$_POST['marca-slide-url-2-editar'],"img"=>$_POST['marca-slide-img-2-editar']));
							$editarVistaSlide = true;
						}
						if(isset($_POST['marca-slide-url-3-editar']) && isset($_POST['marca-slide-img-3-editar']) && $_POST['marca-slide-img-3-editar']>0)
						{
							array_push($vistaSlide, array("url"=>$_POST['marca-slide-url-3-editar'],"img"=>$_POST['marca-slide-img-3-editar']));
							$editarVistaSlide = true;
						}
						if(isset($_POST['marca-slide-url-4-editar']) && isset($_POST['marca-slide-img-4-editar']) && $_POST['marca-slide-img-4-editar']>0)
						{
							array_push($vistaSlide, array("url"=>$_POST['marca-slide-url-4-editar'],"img"=>$_POST['marca-slide-img-4-editar']));
							$editarVistaSlide = true;
						}
						if(isset($_POST['marca-slide-url-5-editar']) && isset($_POST['marca-slide-img-5-editar']) && $_POST['marca-slide-img-5-editar']>0)
						{
							array_push($vistaSlide, array("url"=>$_POST['marca-slide-url-5-editar'],"img"=>$_POST['marca-slide-img-5-editar']));
							$editarVistaSlide = true;
						}
						$editarVistaModulos = false;
						$vistaModulos = array();
						if(isset($_POST['marca-modulos-url-1-editar']) && isset($_POST['marca-modulos-img-1-editar']) && $_POST['marca-modulos-img-1-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['marca-modulos-url-1-editar'],"img"=>$_POST['marca-modulos-img-1-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['marca-modulos-url-2-editar']) && isset($_POST['marca-modulos-img-2-editar']) && $_POST['marca-modulos-img-2-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['marca-modulos-url-2-editar'],"img"=>$_POST['marca-modulos-img-2-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['marca-modulos-url-3-editar']) && isset($_POST['marca-modulos-img-3-editar']) && $_POST['marca-modulos-img-3-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['marca-modulos-url-3-editar'],"img"=>$_POST['marca-modulos-img-3-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['marca-modulos-url-4-editar']) && isset($_POST['marca-modulos-img-4-editar']) && $_POST['marca-modulos-img-4-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['marca-modulos-url-4-editar'],"img"=>$_POST['marca-modulos-img-4-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['marca-modulos-url-5-editar']) && isset($_POST['marca-modulos-img-5-editar']) && $_POST['marca-modulos-img-5-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['marca-modulos-url-5-editar'],"img"=>$_POST['marca-modulos-img-5-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['marca-modulos-url-6-editar']) && isset($_POST['marca-modulos-img-6-editar']) && $_POST['marca-modulos-img-6-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['marca-modulos-url-6-editar'],"img"=>$_POST['marca-modulos-img-6-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['marca-modulos-url-7-editar']) && isset($_POST['marca-modulos-img-7-editar']) && $_POST['marca-modulos-img-7-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['marca-modulos-url-7-editar'],"img"=>$_POST['marca-modulos-img-7-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['marca-modulos-url-8-editar']) && isset($_POST['marca-modulos-img-8-editar']) && $_POST['marca-modulos-img-8-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['marca-modulos-url-8-editar'],"img"=>$_POST['marca-modulos-img-8-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['marca-modulos-url-9-editar']) && isset($_POST['marca-modulos-img-9-editar']) && $_POST['marca-modulos-img-9-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['marca-modulos-url-9-editar'],"img"=>$_POST['marca-modulos-img-9-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['marca-modulos-url-10-editar']) && isset($_POST['marca-modulos-img-10-editar']) && $_POST['marca-modulos-img-10-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['marca-modulos-url-10-editar'],"img"=>$_POST['marca-modulos-img-10-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['marca-modulos-url-11-editar']) && isset($_POST['marca-modulos-img-11-editar']) && $_POST['marca-modulos-img-11-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['marca-modulos-url-11-editar'],"img"=>$_POST['marca-modulos-img-11-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['marca-modulos-url-12-editar']) && isset($_POST['marca-modulos-img-12-editar']) && $_POST['marca-modulos-img-12-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['marca-modulos-url-12-editar'],"img"=>$_POST['marca-modulos-img-12-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['marca-modulos-url-13-editar']) && isset($_POST['marca-modulos-img-13-editar']) && $_POST['marca-modulos-img-13-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['marca-modulos-url-13-editar'],"img"=>$_POST['marca-modulos-img-13-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['marca-modulos-url-14-editar']) && isset($_POST['marca-modulos-img-14-editar']) && $_POST['marca-modulos-img-14-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['marca-modulos-url-14-editar'],"img"=>$_POST['marca-modulos-img-14-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['marca-modulos-url-15-editar']) && isset($_POST['marca-modulos-img-15-editar']) && $_POST['marca-modulos-img-15-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['marca-modulos-url-15-editar'],"img"=>$_POST['marca-modulos-img-15-editar']));
							$editarVistaModulos = true;
						}
						$editarVistaBanner = false;
						$vistaBanner = array();
						if(isset($_POST['marca-banner-publicitario-url-editar']) && isset($_POST['marca-banner-publicitario-img-editar']) && $_POST['marca-banner-publicitario-img-editar']>0)
						{
							array_push($vistaBanner, array("url"=>$_POST['marca-banner-publicitario-url-editar'],"img"=>$_POST['marca-banner-publicitario-img-editar']));
							$editarVistaBanner = true;
						}
						if($editarVistaSlide == true || $editarVistaModulos == true || $editarVistaBanner == true || $editarVistaCabecera == true)
						{
							$dataVistas = [
								"Id"=>$codigo,
								"Slides"=>$vistaSlide,
								"Modulos"=>$vistaModulos,
								"Banner"=>$vistaBanner,
								"Cabecera"=>$vistaCabecera
							];
							$guardarReglas = administradorModelo::editar_vista_marca_modelo($dataVistas);
							if ($guardarReglas->rowCount()>0){					
								$alerta=[
									"Alerta"=>"recargar",
									"Titulo"=>"Datos Actualizados",
									"Texto"=>"Los datos fueron editados con éxito",
									"Tipo"=>"success"
								];
							}
						}
					}
					else {
						$borrarVista = administradorModelo::eliminar_vista_modelo($codigo);
						if ($borrarVista->rowCount()>0) {
							$alerta=[
								"Alerta"=>"recargar",
								"Titulo"=>"Datos Actualizados",
								"Texto"=>"Los datos fueron editados con éxito",
								"Tipo"=>"success"
							];
						}
					}
				}
				else {
					if(isset($_POST['marca-vista-editar'])) {
						$editarVistaCabecera = false;
						$vistaCabecera = array();
						if(isset($_POST['marca-cabecera-editar']) && $_POST['marca-cabecera-editar']>0)
						{
							array_push($vistaCabecera, array("cabecera"=>"cabecera","img"=>$_POST['marca-cabecera-editar']));
							$editarVistaCabecera = true;
						}
						$editarVistaSlide = false;
						$vistaSlide = array();
						if(isset($_POST['marca-slide-url-1-editar']) && isset($_POST['marca-slide-img-1-editar']) && $_POST['marca-slide-img-1-editar']>0)
						{
							array_push($vistaSlide, array("url"=>$_POST['marca-slide-url-1-editar'],"img"=>$_POST['marca-slide-img-1-editar']));
							$editarVistaSlide = true;
						}
						if(isset($_POST['marca-slide-url-2-editar']) && isset($_POST['marca-slide-img-2-editar']) && $_POST['marca-slide-img-2-editar']>0)
						{
							array_push($vistaSlide, array("url"=>$_POST['marca-slide-url-2-editar'],"img"=>$_POST['marca-slide-img-2-editar']));
							$editarVistaSlide = true;
						}
						if(isset($_POST['marca-slide-url-3-editar']) && isset($_POST['marca-slide-img-3-editar']) && $_POST['marca-slide-img-3-editar']>0)
						{
							array_push($vistaSlide, array("url"=>$_POST['marca-slide-url-3-editar'],"img"=>$_POST['marca-slide-img-3-editar']));
							$editarVistaSlide = true;
						}
						if(isset($_POST['marca-slide-url-4-editar']) && isset($_POST['marca-slide-img-4-editar']) && $_POST['marca-slide-img-4-editar']>0)
						{
							array_push($vistaSlide, array("url"=>$_POST['marca-slide-url-4-editar'],"img"=>$_POST['marca-slide-img-4-editar']));
							$editarVistaSlide = true;
						}
						if(isset($_POST['marca-slide-url-5-editar']) && isset($_POST['marca-slide-img-5-editar']) && $_POST['marca-slide-img-5-editar']>0)
						{
							array_push($vistaSlide, array("url"=>$_POST['marca-slide-url-5-editar'],"img"=>$_POST['marca-slide-img-5-editar']));
							$editarVistaSlide = true;
						}
						$editarVistaModulos = false;
						$vistaModulos = array();
						if(isset($_POST['marca-modulos-url-1-editar']) && isset($_POST['marca-modulos-img-1-editar']) && $_POST['marca-modulos-img-1-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['marca-modulos-url-1-editar'],"img"=>$_POST['marca-modulos-img-1-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['marca-modulos-url-2-editar']) && isset($_POST['marca-modulos-img-2-editar']) && $_POST['marca-modulos-img-2-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['marca-modulos-url-2-editar'],"img"=>$_POST['marca-modulos-img-2-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['marca-modulos-url-3-editar']) && isset($_POST['marca-modulos-img-3-editar']) && $_POST['marca-modulos-img-3-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['marca-modulos-url-3-editar'],"img"=>$_POST['marca-modulos-img-3-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['marca-modulos-url-4-editar']) && isset($_POST['marca-modulos-img-4-editar']) && $_POST['marca-modulos-img-4-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['marca-modulos-url-4-editar'],"img"=>$_POST['marca-modulos-img-4-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['marca-modulos-url-5-editar']) && isset($_POST['marca-modulos-img-5-editar']) && $_POST['marca-modulos-img-5-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['marca-modulos-url-5-editar'],"img"=>$_POST['marca-modulos-img-5-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['marca-modulos-url-6-editar']) && isset($_POST['marca-modulos-img-6-editar']) && $_POST['marca-modulos-img-6-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['marca-modulos-url-6-editar'],"img"=>$_POST['marca-modulos-img-6-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['marca-modulos-url-7-editar']) && isset($_POST['marca-modulos-img-7-editar']) && $_POST['marca-modulos-img-7-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['marca-modulos-url-7-editar'],"img"=>$_POST['marca-modulos-img-7-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['marca-modulos-url-8-editar']) && isset($_POST['marca-modulos-img-8-editar']) && $_POST['marca-modulos-img-8-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['marca-modulos-url-8-editar'],"img"=>$_POST['marca-modulos-img-8-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['marca-modulos-url-9-editar']) && isset($_POST['marca-modulos-img-9-editar']) && $_POST['marca-modulos-img-9-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['marca-modulos-url-9-editar'],"img"=>$_POST['marca-modulos-img-9-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['marca-modulos-url-10-editar']) && isset($_POST['marca-modulos-img-10-editar']) && $_POST['marca-modulos-img-10-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['marca-modulos-url-10-editar'],"img"=>$_POST['marca-modulos-img-10-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['marca-modulos-url-11-editar']) && isset($_POST['marca-modulos-img-11-editar']) && $_POST['marca-modulos-img-11-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['marca-modulos-url-11-editar'],"img"=>$_POST['marca-modulos-img-11-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['marca-modulos-url-12-editar']) && isset($_POST['marca-modulos-img-12-editar']) && $_POST['marca-modulos-img-12-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['marca-modulos-url-12-editar'],"img"=>$_POST['marca-modulos-img-12-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['marca-modulos-url-13-editar']) && isset($_POST['marca-modulos-img-13-editar']) && $_POST['marca-modulos-img-13-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['marca-modulos-url-13-editar'],"img"=>$_POST['marca-modulos-img-13-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['marca-modulos-url-14-editar']) && isset($_POST['marca-modulos-img-14-editar']) && $_POST['marca-modulos-img-14-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['marca-modulos-url-14-editar'],"img"=>$_POST['marca-modulos-img-14-editar']));
							$editarVistaModulos = true;
						}
						if(isset($_POST['marca-modulos-url-15-editar']) && isset($_POST['marca-modulos-img-15-editar']) && $_POST['marca-modulos-img-15-editar']>0)
						{
							array_push($vistaModulos, array("url"=>$_POST['marca-modulos-url-15-editar'],"img"=>$_POST['marca-modulos-img-15-editar']));
							$editarVistaModulos = true;
						}
						$editarVistaBanner = false;
						$vistaBanner = array();
						if(isset($_POST['marca-banner-publicitario-url-editar']) && isset($_POST['marca-banner-publicitario-img-editar']) && $_POST['marca-banner-publicitario-img-editar']>0)
						{
							array_push($vistaBanner, array("url"=>$_POST['marca-banner-publicitario-url-editar'],"img"=>$_POST['marca-banner-publicitario-img-editar']));
							$editarVistaBanner = true;
						}
						if($editarVistaSlide == true || $editarVistaModulos == true || $editarVistaBanner == true || $editarVistaCabecera == true)
						{
							$dataVistas = [
								"Id"=>$codigo,
								"Slides"=>$vistaSlide,
								"Modulos"=>$vistaModulos,
								"Banner"=>$vistaBanner,
								"Cabecera"=>$vistaCabecera
							];
							$guardarReglas = administradorModelo::agregar_vista_marca_modelo($dataVistas);
							if ($guardarReglas->rowCount()>0){					
								$alerta=[
									"Alerta"=>"recargar",
									"Titulo"=>"Datos Actualizados",
									"Texto"=>"Los datos fueron editados con éxito",
									"Tipo"=>"success"
								];
							}
						}
					}
				}
			}
			return mainModel::sweet_alert($alerta);
		}

		//CONTROLADORES PARA VISTAS PERSONALIZADAS

		public function obtener_vista_controlador($codigo)
		{
			$sql=mainModel::conectar()->prepare("SELECT * FROM vistas_personalizadas WHERE id_taxonomia=:Codigo");
			$sql->bindParam(":Codigo",$codigo);
			$sql->execute();
			return $sql;
		}

		public function cargar_vista_marca_controlador($datosVista, $items)
		{
			if ($items == "cabecera") {
				$mostrar = json_decode($datosVista['cabecera'], true);
				$numeroVista = 1;
				if (count($mostrar)>0) {
					foreach($mostrar as $vista)
					{
						$infoMedio = administradorControlador::obtener_info_medios_controlador($vista['img']);
						$infoMedio = $infoMedio->fetch();
						echo '
							<div class="row">
								<div class="col-sm-9">
									<div class="form-group">
										<label for="marca-cabecera-editar" class="form-control-label">Cabecera</label>
										<select id="marca-cabecera-editar" name="marca-cabecera-editar" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
											<option value="" label="default" data-url-image="">Ninguno</option>
											'.administradorControlador::cargar_medios_vista_controlador($vista['img']).'
										</select>
									</div>
								</div>
								<div class="col-sm-3">
									<img id="imagen-cambiar-vista" src="'.$infoMedio['url'].'" class="sombra">
								</div>
							</div>';
						$numeroVista += 1;
					}
				}
				for ($numeroVista; $numeroVista <= 1; $numeroVista++) { 
					echo '
						<div class="row">
							<div class="col-sm-9">
								<div class="form-group">
									<label for="marca-cabecera-editar" class="form-control-label">Cabecera</label>
									<select id="marca-cabecera-editar" name="marca-cabecera-editar" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
										<option value="" label="default" data-url-image="">Ninguno</option>
										'.administradorControlador::cargar_medios_controlador().'
									</select>
								</div>
							</div>
							<div class="col-sm-3">
								<img id="imagen-cambiar-vista" src="" class="sombra">
							</div>
						</div>';
				}
			}
			elseif ($items == "slides") {
				$mostrar = json_decode($datosVista['slides'], true);
				$numeroVista = 1;
				if (count($mostrar)>0) {
					foreach($mostrar as $vista)
					{
						$infoMedio = administradorControlador::obtener_info_medios_controlador($vista['img']);
						$infoMedio = $infoMedio->fetch();
						echo '
							<div class="row">
								<div class="col-12">
									<h3 class="pb-2 display-5">Slide '.$numeroVista.'</h3>
								</div>
								<div class="col-sm-5">
									<div class="form-group">
										<label for="marca-slide-url-'.$numeroVista.'-editar" class=" form-control-label">URL</label>
										<input id="marca-slide-url-'.$numeroVista.'-editar" type="url" name="marca-slide-url-'.$numeroVista.'-editar" placeholder="" class="form-control" value="'.$vista['url'].'">
									</div>
								</div>
								<div class="col-sm-5">
									<div class="form-group">
										<label for="marca-slide-img-'.$numeroVista.'-editar" class="form-control-label">Imagen</label>
										<select id="marca-slide-img-'.$numeroVista.'-editar" name="marca-slide-img-'.$numeroVista.'-editar" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
											<option value="" label="default" data-url-image="">Ninguno</option>
											'.administradorControlador::cargar_medios_vista_controlador($vista['img']).'
										</select>
									</div>
								</div>
								<div class="col-sm-2">
									<img id="imagen-cambiar-vista" src="'.$infoMedio['url'].'" class="sombra">
								</div>
							</div>';
						$numeroVista += 1;
					}
				}
				for ($numeroVista; $numeroVista <= 5; $numeroVista++) { 
					echo '
						<div class="row">
							<div class="col-12">
								<h3 class="pb-2 display-5">Slide '.$numeroVista.'</h3>
							</div>
							<div class="col-sm-5">
								<div class="form-group">
									<label for="marca-slide-url-'.$numeroVista.'-editar" class=" form-control-label">URL</label>
									<input id="marca-slide-url-'.$numeroVista.'-editar" type="url" name="marca-slide-url-'.$numeroVista.'-editar" placeholder="" class="form-control">
								</div>
							</div>
							<div class="col-sm-5">
								<div class="form-group">
									<label for="marca-slide-img-'.$numeroVista.'-editar" class="form-control-label">Imagen</label>
									<select id="marca-slide-img-'.$numeroVista.'-editar" name="marca-slide-img-'.$numeroVista.'-editar" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
										<option value="" label="default" data-url-image="">Ninguno</option>
										'.administradorControlador::cargar_medios_controlador().'
									</select>
								</div>
							</div>
							<div class="col-sm-2">
								<img id="imagen-cambiar-vista" src="" class="sombra">
							</div>
						</div>';
				}
			}
			elseif ($items == "modulos") {
				$mostrar = json_decode($datosVista['columnas'], true);
				$numeroVista = 1;
				if (count($mostrar)>0) {
					foreach($mostrar as $vista)
					{
						$infoMedio = administradorControlador::obtener_info_medios_controlador($vista['img']);
						$infoMedio = $infoMedio->fetch();
						echo '
							<div class="row">
								<div class="col-12">
									<h3 class="pb-2 display-5">Módulo '.$numeroVista.'</h3>
								</div>
								<div class="col-sm-5">
									<div class="form-group">
										<label for="marca-modulos-url-'.$numeroVista.'-editar" class=" form-control-label">URL</label>
										<input id="marca-modulos-url-'.$numeroVista.'-editar" type="url" name="marca-modulos-url-'.$numeroVista.'-editar" placeholder="" class="form-control" value="'.$vista['url'].'">
									</div>
								</div>
								<div class="col-sm-5">
									<div class="form-group">
										<label for="marca-modulos-img-'.$numeroVista.'-editar" class="form-control-label">Imagen</label>
										<select id="marca-modulos-img-'.$numeroVista.'-editar" name="marca-modulos-img-'.$numeroVista.'-editar" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
											<option value="" label="default" data-url-image="">Ninguno</option>
											'.administradorControlador::cargar_medios_vista_controlador($vista['img']).'
										</select>
									</div>
								</div>
								<div class="col-sm-2">
									<img id="imagen-cambiar-vista" src="'.$infoMedio['url'].'" class="sombra">
								</div>
							</div>';
						$numeroVista += 1;
					}
				}
				for ($numeroVista; $numeroVista <= 15; $numeroVista++) { 
					echo '
						<div class="row">
							<div class="col-12">
								<h3 class="pb-2 display-5">Módulo '.$numeroVista.'</h3>
							</div>
							<div class="col-sm-5">
								<div class="form-group">
									<label for="marca-modulos-url-'.$numeroVista.'-editar" class=" form-control-label">URL</label>
									<input id="marca-modulos-url-'.$numeroVista.'-editar" type="url" name="marca-modulos-url-'.$numeroVista.'-editar" placeholder="" class="form-control">
								</div>
							</div>
							<div class="col-sm-5">
								<div class="form-group">
									<label for="marca-modulos-img-'.$numeroVista.'-editar" class="form-control-label">Imagen</label>
									<select id="marca-modulos-img-'.$numeroVista.'-editar" name="marca-modulos-img-'.$numeroVista.'-editar" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
										<option value="" label="default" data-url-image="">Ninguno</option>
										'.administradorControlador::cargar_medios_controlador().'
									</select>
								</div>
							</div>
							<div class="col-sm-2">
								<img id="imagen-cambiar-vista" src="" class="sombra">
							</div>
						</div>';
				}
			}
			elseif ($items == "banner") {
				$mostrar = json_decode($datosVista['banner'], true);
				$numeroVista = 1;
				if (count($mostrar)>0) {
					foreach($mostrar as $vista)
					{
						$infoMedio = administradorControlador::obtener_info_medios_controlador($vista['img']);
						$infoMedio = $infoMedio->fetch();
						echo '
							<div class="row">
								<div class="col-12">
									<h3 class="pb-2 display-5">Banner</h3>
								</div>
								<div class="col-sm-5">
									<div class="form-group">
										<label for="marca-banner-publicitario-url-editar" class=" form-control-label">URL</label>
										<input id="marca-banner-publicitario-url-editar" type="url" name="marca-banner-publicitario-url-editar" placeholder="" class="form-control" value="'.$vista['url'].'">
									</div>
								</div>
								<div class="col-sm-5">
									<div class="form-group">
										<label for="marca-banner-publicitario-img-editar" class="form-control-label">Imagen</label>
										<select id="marca-banner-publicitario-img-editar" name="marca-banner-publicitario-img-editar" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
											<option value="" label="default" data-url-image="">Ninguno</option>
											'.administradorControlador::cargar_medios_vista_controlador($vista['img']).'
										</select>
									</div>
								</div>
								<div class="col-sm-2">
									<img id="imagen-cambiar-vista" src="'.$infoMedio['url'].'" class="sombra">
								</div>
							</div>';
						$numeroVista += 1;
					}
				}
				for ($numeroVista; $numeroVista <= 1; $numeroVista++) { 
					echo '
						<div class="row">
							<div class="col-12">
								<h3 class="pb-2 display-5">Banner</h3>
							</div>
							<div class="col-sm-5">
								<div class="form-group">
									<label for="marca-banner-publicitario-url-editar" class=" form-control-label">URL</label>
									<input id="marca-banner-publicitario-url-editar" type="url" name="marca-banner-publicitario-url-editar" placeholder="" class="form-control">
								</div>
							</div>
							<div class="col-sm-5">
								<div class="form-group">
									<label for="marca-banner-publicitario-img-editar" class="form-control-label">Imagen</label>
									<select id="marca-banner-publicitario-img-editar" name="marca-banner-publicitario-img-editar" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
										<option value="" label="default" data-url-image="">Ninguno</option>
										'.administradorControlador::cargar_medios_controlador().'
									</select>
								</div>
							</div>
							<div class="col-sm-2">
								<img id="imagen-cambiar-vista" src="" class="sombra">
							</div>
						</div>';
				}
			}
		}
		
		public function cargar_medios_vista_controlador($imagen)
		{
			$lista="";
			$consulta="SELECT id, titulo, url FROM medios;";
			$conexion = mainModel::conectar();
			$datos = $conexion->query($consulta);
			$datos = $datos->fetchAll();
			foreach($datos as $rows)
			{
				if ($imagen == $rows['id'])
				{
					$lista.='<option value="'.$rows['id'].'" data-url-image="'.$rows['url'].'" selected="">'.$rows['titulo'].'</option>';
				}
				else
				{
					$lista.='<option value="'.$rows['id'].'" data-url-image="'.$rows['url'].'">'.$rows['titulo'].'</option>';
				}
			}
			return $lista;
		}

		public function cargar_categorias_vista_controlador($id)
		{
			$lista="";
			$consulta="SELECT * FROM taxonomias WHERE taxonomia = 'marca' ORDER BY nombre;";
			$conexion = mainModel::conectar();
			$datos = $conexion->query($consulta);
			$datos = $datos->fetchAll();
			foreach($datos as $rows)
			{
				if ($id == $rows['id'])
				{
					$lista.='<option value="'.$rows['id'].'" selected="">'.$rows['nombre'].'</option>';
				}
				else
				{
					$lista.='<option value="'.$rows['id'].'">'.$rows['nombre'].'</option>';
				}
			}
			return $lista;
		}

		public function cargar_vista_categoria_controlador($datosVista, $items)
		{
			if ($items == "cabecera") {
				$mostrar = json_decode($datosVista['cabecera'], true);
				$numeroVista = 1;
				if (count($mostrar)>0) {
					foreach($mostrar as $vista)
					{
						$infoMedio = administradorControlador::obtener_info_medios_controlador($vista['img']);
						$infoMedio = $infoMedio->fetch();
						echo '
							<div class="row">
								<div class="col-sm-9">
									<div class="form-group">
										<label for="categoria-cabecera-editar" class="form-control-label">Cabecera</label>
										<select id="categoria-cabecera-editar" name="categoria-cabecera-editar" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
											<option value="" label="default" data-url-image="">Ninguno</option>
											'.administradorControlador::cargar_medios_vista_controlador($vista['img']).'
										</select>
									</div>
								</div>
								<div class="col-sm-3">
									<img id="imagen-cambiar-vista" src="'.$infoMedio['url'].'" class="sombra">
								</div>
							</div>';
						$numeroVista += 1;
					}
				}
				for ($numeroVista; $numeroVista <= 1; $numeroVista++) { 
					echo '
						<div class="row">
							<div class="col-sm-9">
								<div class="form-group">
									<label for="categoria-cabecera-editar" class="form-control-label">Cabecera</label>
									<select id="categoria-cabecera-editar" name="categoria-cabecera-editar" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
										<option value="" label="default" data-url-image="">Ninguno</option>
										'.administradorControlador::cargar_medios_controlador().'
									</select>
								</div>
							</div>
							<div class="col-sm-3">
								<img id="imagen-cambiar-vista" src="" class="sombra">
							</div>
						</div>';
				}
			}
			elseif ($items == "slides") {
				$mostrar = json_decode($datosVista['slides'], true);
				$numeroVista = 1;
				if (count($mostrar)>0) {
					foreach($mostrar as $vista)
					{
						$infoMedio = administradorControlador::obtener_info_medios_controlador($vista['img']);
						$infoMedio = $infoMedio->fetch();
						echo '
							<div class="row">
								<div class="col-12">
									<h3 class="pb-2 display-5">Slide '.$numeroVista.'</h3>
								</div>
								<div class="col-sm-5">
									<div class="form-group">
										<label for="categoria-slide-url-'.$numeroVista.'-editar" class=" form-control-label">URL</label>
										<input id="categoria-slide-url-'.$numeroVista.'-editar" type="url" name="categoria-slide-url-'.$numeroVista.'-editar" placeholder="" class="form-control" value="'.$vista['url'].'">
									</div>
								</div>
								<div class="col-sm-5">
									<div class="form-group">
										<label for="categoria-slide-img-'.$numeroVista.'-editar" class="form-control-label">Imagen</label>
										<select id="categoria-slide-img-'.$numeroVista.'-editar" name="categoria-slide-img-'.$numeroVista.'-editar" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
											<option value="" label="default" data-url-image="">Ninguno</option>
											'.administradorControlador::cargar_medios_vista_controlador($vista['img']).'
										</select>
									</div>
								</div>
								<div class="col-sm-2">
									<img id="imagen-cambiar-vista" src="'.$infoMedio['url'].'" class="sombra">
								</div>
							</div>';
						$numeroVista += 1;
					}
				}
				for ($numeroVista; $numeroVista <= 5; $numeroVista++) { 
					echo '
						<div class="row">
							<div class="col-12">
								<h3 class="pb-2 display-5">Slide '.$numeroVista.'</h3>
							</div>
							<div class="col-sm-5">
								<div class="form-group">
									<label for="categoria-slide-url-'.$numeroVista.'-editar" class=" form-control-label">URL</label>
									<input id="categoria-slide-url-'.$numeroVista.'-editar" type="url" name="categoria-slide-url-'.$numeroVista.'-editar" placeholder="" class="form-control">
								</div>
							</div>
							<div class="col-sm-5">
								<div class="form-group">
									<label for="categoria-slide-img-'.$numeroVista.'-editar" class="form-control-label">Imagen</label>
									<select id="categoria-slide-img-'.$numeroVista.'-editar" name="categoria-slide-img-'.$numeroVista.'-editar" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
										<option value="" label="default" data-url-image="">Ninguno</option>
										'.administradorControlador::cargar_medios_controlador().'
									</select>
								</div>
							</div>
							<div class="col-sm-2">
								<img id="imagen-cambiar-vista" src="" class="sombra">
							</div>
						</div>';
				}
			}
			elseif ($items == "modulos") {
				$mostrar = json_decode($datosVista['columnas'], true);
				$numeroVista = 1;
				if (count($mostrar)>0) {
					foreach($mostrar as $vista)
					{
						$infoMedio = administradorControlador::obtener_info_medios_controlador($vista['img']);
						$infoMedio = $infoMedio->fetch();
						echo '
							<div class="row">
								<div class="col-12">
									<h3 class="pb-2 display-5">Módulo '.$numeroVista.'</h3>
								</div>
								<div class="col-sm-5">
									<div class="form-group">
										<label for="categoria-modulos-url-'.$numeroVista.'-editar" class=" form-control-label">URL</label>
										<input id="categoria-modulos-url-'.$numeroVista.'-editar" type="url" name="categoria-modulos-url-'.$numeroVista.'-editar" placeholder="" class="form-control" value="'.$vista['url'].'">
									</div>
								</div>
								<div class="col-sm-5">
									<div class="form-group">
										<label for="categoria-modulos-img-'.$numeroVista.'-editar" class="form-control-label">Imagen</label>
										<select id="categoria-modulos-img-'.$numeroVista.'-editar" name="categoria-modulos-img-'.$numeroVista.'-editar" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
											<option value="" label="default" data-url-image="">Ninguno</option>
											'.administradorControlador::cargar_medios_vista_controlador($vista['img']).'
										</select>
									</div>
								</div>
								<div class="col-sm-2">
									<img id="imagen-cambiar-vista" src="'.$infoMedio['url'].'" class="sombra">
								</div>
							</div>';
						$numeroVista += 1;
					}
				}
				for ($numeroVista; $numeroVista <= 15; $numeroVista++) { 
					echo '
						<div class="row">
							<div class="col-12">
								<h3 class="pb-2 display-5">Módulo '.$numeroVista.'</h3>
							</div>
							<div class="col-sm-5">
								<div class="form-group">
									<label for="categoria-modulos-url-'.$numeroVista.'-editar" class=" form-control-label">URL</label>
									<input id="categoria-modulos-url-'.$numeroVista.'-editar" type="url" name="categoria-modulos-url-'.$numeroVista.'-editar" placeholder="" class="form-control">
								</div>
							</div>
							<div class="col-sm-5">
								<div class="form-group">
									<label for="categoria-modulos-img-'.$numeroVista.'-editar" class="form-control-label">Imagen</label>
									<select id="categoria-modulos-img-'.$numeroVista.'-editar" name="categoria-modulos-img-'.$numeroVista.'-editar" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
										<option value="" label="default" data-url-image="">Ninguno</option>
										'.administradorControlador::cargar_medios_controlador().'
									</select>
								</div>
							</div>
							<div class="col-sm-2">
								<img id="imagen-cambiar-vista" src="" class="sombra">
							</div>
						</div>';
				}
			}
			elseif ($items == "marcas") {
				$mostrar = json_decode($datosVista['marcas'], true);
				$numeroVista = 1;
				if (count($mostrar)>0) {
					foreach($mostrar as $vista)
					{
						echo '
							<div class="row">
								<div class="col-12">
									<div class="form-group">
										<label for="categoria-marca-'.$numeroVista.'-editar" class=" form-control-label">Marca '.$numeroVista.'</label>
										<select id="categoria-marca-'.$numeroVista.'-editar" name="categoria-marca-'.$numeroVista.'-editar" data-placeholder="Elije un icono..." class="standardSelect" tabindex="1">
											<option value="" label="default">Ninguna</option>'.administradorControlador::cargar_categorias_vista_controlador($vista).'
										</select>
									</div>
								</div>
							</div>';
						$numeroVista += 1;
					}
				}
				for ($numeroVista; $numeroVista <= 20; $numeroVista++) { 
					echo '
					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<label for="categoria-marca-'.$numeroVista.'-editar" class=" form-control-label">Marca '.$numeroVista.'</label>
								<select id="categoria-marca-'.$numeroVista.'-editar" name="categoria-marca-'.$numeroVista.'-editar" data-placeholder="Elije un icono..." class="standardSelect" tabindex="1">
									<option value="" label="default">Ninguna</option>'.administradorControlador::cargar_taxonomias_controlador("marca").'
								</select>
							</div>
						</div>
					</div>';
				}
			}
			elseif ($items == "banner") {
				$mostrar = json_decode($datosVista['banner'], true);
				$numeroVista = 1;
				if (count($mostrar)>0) {
					foreach($mostrar as $vista)
					{
						$infoMedio = administradorControlador::obtener_info_medios_controlador($vista['img']);
						$infoMedio = $infoMedio->fetch();
						echo '
							<div class="row">
								<div class="col-12">
									<h3 class="pb-2 display-5">Banner</h3>
								</div>
								<div class="col-sm-5">
									<div class="form-group">
										<label for="categoria-banner-publicitario-url-editar" class=" form-control-label">URL</label>
										<input id="categoria-banner-publicitario-url-editar" type="url" name="categoria-banner-publicitario-url-editar" placeholder="" class="form-control" value="'.$vista['url'].'">
									</div>
								</div>
								<div class="col-sm-5">
									<div class="form-group">
										<label for="categoria-banner-publicitario-img-editar" class="form-control-label">Imagen</label>
										<select id="categoria-banner-publicitario-img-editar" name="categoria-banner-publicitario-img-editar" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
											<option value="" label="default" data-url-image="">Ninguno</option>
											'.administradorControlador::cargar_medios_vista_controlador($vista['img']).'
										</select>
									</div>
								</div>
								<div class="col-sm-2">
									<img id="imagen-cambiar-vista" src="'.$infoMedio['url'].'" class="sombra">
								</div>
							</div>';
						$numeroVista += 1;
					}
				}
				for ($numeroVista; $numeroVista <= 1; $numeroVista++) { 
					echo '
						<div class="row">
							<div class="col-12">
								<h3 class="pb-2 display-5">Banner</h3>
							</div>
							<div class="col-sm-5">
								<div class="form-group">
									<label for="categoria-banner-publicitario-url-editar" class=" form-control-label">URL</label>
									<input id="categoria-banner-publicitario-url-editar" type="url" name="categoria-banner-publicitario-url-editar" placeholder="" class="form-control">
								</div>
							</div>
							<div class="col-sm-5">
								<div class="form-group">
									<label for="categoria-banner-publicitario-img-editar" class="form-control-label">Imagen</label>
									<select id="categoria-banner-publicitario-img-editar" name="categoria-banner-publicitario-img-editar" data-placeholder="Elije una imagen..." class="standardSelect select-cambio-imagen" tabindex="1">
										<option value="" label="default" data-url-image="">Ninguno</option>
										'.administradorControlador::cargar_medios_controlador().'
									</select>
								</div>
							</div>
							<div class="col-sm-2">
								<img id="imagen-cambiar-vista" src="" class="sombra">
							</div>
						</div>';
				}
			}
		}

		//CONTROLADORES PARA VISTAS PREDETERMINADAS

		public function obtener_datos_vistas($vista)
		{
			$sql=mainModel::conectar()->prepare("SELECT * FROM vistas WHERE vista=:Vista");
			$sql->bindParam(":Vista",$vista);
			$sql->execute();
			return $sql;
		}

		public function relaciones_marcas_vista_controlador($items)
		{
			$lista="";
			$consulta="SELECT id, nombre FROM taxonomias WHERE taxonomia = 'marca';";
			$conexion = mainModel::conectar();
			$datos = $conexion->query($consulta);
			$datos = $datos->fetchAll();
			$seleccionar = $items;
			$activo = false;
			foreach($datos as $rows)
			{
				if (!empty($seleccionar))
				{
					foreach($seleccionar as $tax)
					{
						if ($tax == $rows['id'])
						{
							$lista.='<option value="'.$rows['id'].'" selected="">'.$rows['nombre'].'</option>';
							$activo = true;
						}
					}
				}
				if($activo == false){
					$lista.='<option value="'.$rows['id'].'">'.$rows['nombre'].'</option>';
				}
				else{
					$activo = false;
				}
			}
			return $lista;
		}

		public function relaciones_categorias_vista_controlador($items)
		{
			$lista="";
			$consulta="SELECT id, nombre FROM taxonomias WHERE taxonomia = 'categoria';";
			$conexion = mainModel::conectar();
			$datos = $conexion->query($consulta);
			$datos = $datos->fetchAll();
			$seleccionar = $items;
			$activo = false;
			foreach($datos as $rows)
			{
				if (!empty($seleccionar))
				{
					foreach($seleccionar as $tax)
					{
						if ($tax == $rows['id'])
						{
							$lista.='<option value="'.$rows['id'].'" selected="">'.$rows['nombre'].'</option>';
							$activo = true;
						}
					}
				}
				if($activo == false){
					$lista.='<option value="'.$rows['id'].'">'.$rows['nombre'].'</option>';
				}
				else{
					$activo = false;
				}
			}
			return $lista;
		}

		public function editar_vista_header_controlador()
		{
			
			$relacionesMarcas = array();
			$relacionesCategorias = array();

			if(isset($_POST['vista-header-categorias-editar']))
			{
				$relacionesCategorias = $_POST['vista-header-categorias-editar'];
			}

			if(isset($_POST['vista-header-marcas-editar']))
			{
				$relacionesMarcas = $_POST['vista-header-marcas-editar'];
			}

			$dataRelaciones = [
				"marcas"=>$relacionesMarcas,
				"categorias"=>$relacionesCategorias
			];

			$datosHeader = json_encode($dataRelaciones);

			$actualizarVista=administradorModelo::actualizar_vista_header_modelo($datosHeader);

			if($actualizarVista->rowCount()>=1)
			{
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Información actulizada",
					"Texto"=>"Se ha actualizado la información de la vista cabecera.",
					"Tipo"=>"success"
				];
			}
			else
			{
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"No hemos podido actualizar la vista, por favor revisa la información que proporcionaste.",
					"Tipo"=>"error"
				];
			}

			return mainModel::sweet_alert($alerta);
		}

		public function editar_vista_home_controlador()
		{
			$relaciones = array();

			if(isset($_POST['home-slide-url-1-editar']) && isset($_POST['home-slide-img-1-editar']))
			{
				$url = mainModel::limpiar_cadena($_POST['home-slide-url-1-editar']);
				$img = mainModel::limpiar_cadena($_POST['home-slide-img-1-editar']);
				$insertar = [$url, $img];
				array_push($relaciones, array("slide1"=>$insertar));
			}
			else
			{
				$insertar = ["", ""];
				array_push($relaciones, array("slide1"=>$insertar));
			}

			if(isset($_POST['home-slide-url-2-editar']) && isset($_POST['home-slide-img-2-editar']))
			{
				$url = mainModel::limpiar_cadena($_POST['home-slide-url-2-editar']);
				$img = mainModel::limpiar_cadena($_POST['home-slide-img-2-editar']);
				$insertar = [$url, $img];
				array_push($relaciones, array("slide2"=>$insertar));
			}
			else
			{
				$insertar = ["", ""];
				array_push($relaciones, array("slide2"=>$insertar));
			}

			if(isset($_POST['home-slide-url-3-editar']) && isset($_POST['home-slide-img-3-editar']))
			{
				$url = mainModel::limpiar_cadena($_POST['home-slide-url-3-editar']);
				$img = mainModel::limpiar_cadena($_POST['home-slide-img-3-editar']);
				$insertar = [$url, $img];
				array_push($relaciones, array("slide3"=>$insertar));
			}
			else
			{
				$insertar = ["", ""];
				array_push($relaciones, array("slide3"=>$insertar));
			}

			if(isset($_POST['home-slide-url-4-editar']) && isset($_POST['home-slide-img-4-editar']))
			{
				$url = mainModel::limpiar_cadena($_POST['home-slide-url-4-editar']);
				$img = mainModel::limpiar_cadena($_POST['home-slide-img-4-editar']);
				$insertar = [$url, $img];
				array_push($relaciones, array("slide4"=>$insertar));
			}
			else
			{
				$insertar = ["", ""];
				array_push($relaciones, array("slide4"=>$insertar));
			}

			if(isset($_POST['home-slide-url-5-editar']) && isset($_POST['home-slide-img-5-editar']))
			{
				$url = mainModel::limpiar_cadena($_POST['home-slide-url-5-editar']);
				$img = mainModel::limpiar_cadena($_POST['home-slide-img-5-editar']);
				$insertar = [$url, $img];
				array_push($relaciones, array("slide5"=>$insertar));
			}
			else
			{
				$insertar = ["", ""];
				array_push($relaciones, array("slide5"=>$insertar));
			}

			if(isset($_POST['home-slide-url-6-editar']) && isset($_POST['home-slide-img-6-editar']))
			{
				$url = mainModel::limpiar_cadena($_POST['home-slide-url-6-editar']);
				$img = mainModel::limpiar_cadena($_POST['home-slide-img-6-editar']);
				$insertar = [$url, $img];
				array_push($relaciones, array("slide6"=>$insertar));
			}
			else
			{
				$insertar = ["", ""];
				array_push($relaciones, array("slide6"=>$insertar));
			}

			if(isset($_POST['home-slide-url-7-editar']) && isset($_POST['home-slide-img-7-editar']))
			{
				$url = mainModel::limpiar_cadena($_POST['home-slide-url-7-editar']);
				$img = mainModel::limpiar_cadena($_POST['home-slide-img-7-editar']);
				$insertar = [$url, $img];
				array_push($relaciones, array("slide7"=>$insertar));
			}
			else
			{
				$insertar = ["", ""];
				array_push($relaciones, array("slide7"=>$insertar));
			}

			if(isset($_POST['home-slide-url-8-editar']) && isset($_POST['home-slide-img-8-editar']))
			{
				$url = mainModel::limpiar_cadena($_POST['home-slide-url-8-editar']);
				$img = mainModel::limpiar_cadena($_POST['home-slide-img-8-editar']);
				$insertar = [$url, $img];
				array_push($relaciones, array("slide8"=>$insertar));
			}
			else
			{
				$insertar = ["", ""];
				array_push($relaciones, array("slide8"=>$insertar));
			}

			if(isset($_POST['home-slide-url-9-editar']) && isset($_POST['home-slide-img-9-editar']))
			{
				$url = mainModel::limpiar_cadena($_POST['home-slide-url-9-editar']);
				$img = mainModel::limpiar_cadena($_POST['home-slide-img-9-editar']);
				$insertar = [$url, $img];
				array_push($relaciones, array("slide9"=>$insertar));
			}
			else
			{
				$insertar = ["", ""];
				array_push($relaciones, array("slide9"=>$insertar));
			}

			if(isset($_POST['home-slide-url-10-editar']) && isset($_POST['home-slide-img-10-editar']))
			{
				$url = mainModel::limpiar_cadena($_POST['home-slide-url-10-editar']);
				$img = mainModel::limpiar_cadena($_POST['home-slide-img-10-editar']);
				$insertar = [$url, $img];
				array_push($relaciones, array("slide10"=>$insertar));
			}
			else
			{
				$insertar = ["", ""];
				array_push($relaciones, array("slide10"=>$insertar));
			}

			if(isset($_POST['home-banner-publicitario-url-1-editar']) && isset($_POST['home-banner-publicitario-img-1-editar']))
			{
				$url = mainModel::limpiar_cadena($_POST['home-banner-publicitario-url-1-editar']);
				$img = mainModel::limpiar_cadena($_POST['home-banner-publicitario-img-1-editar']);
				$insertar = [$url, $img];
				array_push($relaciones, array("banner1"=>$insertar));
			}
			else
			{
				$insertar = ["", ""];
				array_push($relaciones, array("banner1"=>$insertar));
			}

			if(isset($_POST['home-banner-publicitario-url-2-editar']) && isset($_POST['home-banner-publicitario-img-2-editar']))
			{
				$url = mainModel::limpiar_cadena($_POST['home-banner-publicitario-url-2-editar']);
				$img = mainModel::limpiar_cadena($_POST['home-banner-publicitario-img-2-editar']);
				$insertar = [$url, $img];
				array_push($relaciones, array("banner2"=>$insertar));
			}
			else
			{
				$insertar = ["", ""];
				array_push($relaciones, array("banner2"=>$insertar));
			}

			$datosHome = json_encode($relaciones);

			$actualizarVista=administradorModelo::actualizar_vista_home_modelo($datosHome);

			if($actualizarVista->rowCount()>=1)
			{
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Información actulizada",
					"Texto"=>"Se ha actualizado la información de la vista cabecera.",
					"Tipo"=>"success"
				];
			}
			else
			{
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"No hemos podido actualizar la vista, por favor revisa la información que proporcionaste.",
					"Tipo"=>"error"
				];
			}

			return mainModel::sweet_alert($alerta);

		}

		//VERIFICAR MEDIOS DE VISTAS
		public function verificar_medios_controlador($img)
		{
			$lista="";
			$consulta="SELECT id, titulo, url FROM medios;";
			$conexion = mainModel::conectar();
			$datos = $conexion->query($consulta);
			$datos = $datos->fetchAll();
			foreach($datos as $rows)
			{
				if ($img == $rows['id'])
				{
					$lista.='<option value="'.$rows['id'].'" data-url-image="'.$rows['url'].'" selected="">'.$rows['titulo'].'</option>';
				}
				else
				{
					$lista.='<option value="'.$rows['id'].'" data-url-image="'.$rows['url'].'">'.$rows['titulo'].'</option>';
				}
			}
			return $lista;
		}
	}