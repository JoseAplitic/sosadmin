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
				$alerta=[
					"Alerta"=>"recargar",
					"Titulo"=>"Atributo eliminado",
					"Texto"=>"La atributo fue eliminado del sistema con éxito",
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
				$alerta=[
					"Alerta"=>"recargar",
					"Titulo"=>"Término eliminado",
					"Texto"=>"La término fue eliminado del sistema con éxito",
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
                    $ruta = "../productos/".$imagen['name'];
                    if (!file_exists($ruta))
                    {
                        $resultado = @move_uploaded_file($imagen["tmp_name"], $ruta);
                        if ($resultado)
                        {
							$ruta = SERVERURL."productos/".$imagen['name'];
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

	}