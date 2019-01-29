<?php
	if($peticionAjax){
		require_once "../core/mainModel.php";
	}else{
		require_once "./core/mainModel.php";
	}

	class administradorModelo extends mainModel
	{
		//MODELOS PARA USUARIOS
		protected function verificar_usuario_disponible($usuario){
			$sql=mainModel::conectar()->prepare("SELECT * FROM usuarios WHERE usuario = :Usuario");
			$sql->bindParam(":Usuario",$usuario);
			$sql->execute();
			return $sql;
		}

		protected function verificar_usuario_disponible_actualizar($codigo, $usuario){
			$sql=mainModel::conectar()->prepare("SELECT * FROM usuarios WHERE usuario = :Usuario AND id != :Codigo");
			$sql->bindParam(":Usuario",$usuario);
			$sql->bindParam(":Codigo",$codigo);
			$sql->execute();
			return $sql;
		}

		protected function agregar_administrador_modelo($datos){
			$sql=mainModel::conectar()->prepare("INSERT INTO usuarios(nombre,apellido,usuario,clave,correo) VALUES(:Nombre,:Apellido,:Usuario,:Clave,:Correo)");
			$sql->bindParam(":Nombre",$datos['Nombre']);
			$sql->bindParam(":Apellido",$datos['Apellido']);
			$sql->bindParam(":Usuario",$datos['Usuario']);
			$sql->bindParam(":Clave",$datos['Clave']);
			$sql->bindParam(":Correo",$datos['Correo']);
			$sql->execute();
			return $sql;
		}

		protected function eliminar_administrador_modelo($codigo)
		{
			$query=mainModel::conectar()->prepare("DELETE FROM usuarios WHERE id=:Codigo");
			$query->bindParam(":Codigo",$codigo);
			$query->execute();
			return $query;
		}

		protected function editar_administrador_modelo($datos)
		{
			$sql=mainModel::conectar()->prepare("UPDATE usuarios SET nombre = :Nombre, apellido = :Apellido, usuario = :Usuario, clave = :Clave, correo = :Correo WHERE id = :Codigo");
			$sql->bindParam(":Nombre",$datos['Nombre']);
			$sql->bindParam(":Apellido",$datos['Apellido']);
			$sql->bindParam(":Usuario",$datos['Usuario']);
			$sql->bindParam(":Clave",$datos['Clave']);
			$sql->bindParam(":Correo",$datos['Correo']);
			$sql->bindParam(":Codigo",$datos['Codigo']);
			$sql->execute();
			return $sql;
		}

		//MODELOS PARA CATEGORIAS
		protected function agregar_categoria_modelo($datos){
			$sql=mainModel::conectar()->prepare("INSERT INTO taxonomias(nombre,slug,taxonomia,descripcion,padre,icono) VALUES(:Nombre,:Slug,'categoria',:Descripcion,:Padre,:Icono)");
			$sql->bindParam(":Nombre",$datos['Nombre']);
			$sql->bindParam(":Slug",$datos['Slug']);
			$sql->bindParam(":Descripcion",$datos['Descripcion']);
			$sql->bindParam(":Padre",$datos['Padre']);
			$sql->bindParam(":Icono",$datos['Icono']);
			$sql->execute();
			return $sql;
		}

		protected function verificar_categoria_slug_disponible($slug){
			$sql=mainModel::conectar()->prepare("SELECT * FROM taxonomias WHERE taxonomia = 'categoria' AND slug = :Slug");
			$sql->bindParam(":Slug",$slug);
			$sql->execute();
			return $sql;
		}

		protected function verificar_categoria_editar_slug_disponible($codigo, $slug){
			$sql=mainModel::conectar()->prepare("SELECT * FROM taxonomias WHERE taxonomia = 'categoria' AND slug = :Slug AND id != :Codigo");
			$sql->bindParam(":Slug",$slug);
			$sql->bindParam(":Codigo",$codigo);
			$sql->execute();
			return $sql;
		}

		protected function verificar_categoria_nuevo_padre_modelo($id){
			$sql=mainModel::conectar()->prepare("SELECT * FROM taxonomias WHERE taxonomia = 'categoria' AND id = :Id");
			$sql->bindParam(":Id",$id);
			$sql->execute();
			return $sql;
		}

		protected function verificar_categoria_editar_padre_modelo($idPadre, $id){
			$sql=mainModel::conectar()->prepare("SELECT * FROM taxonomias WHERE taxonomia = 'categoria' AND id = :IdPadre AND id != :Id");
			$sql->bindParam(":IdPadre",$idPadre);
			$sql->bindParam(":Id",$id);
			$sql->execute();
			return $sql;
		}
		
		//MODELOS PARA ETIQUETAS
		protected function agregar_etiqueta_modelo($datos){
			$sql=mainModel::conectar()->prepare("INSERT INTO taxonomias(nombre,slug,taxonomia,descripcion) VALUES(:Nombre,:Slug,'etiqueta',:Descripcion)");
			$sql->bindParam(":Nombre",$datos['Nombre']);
			$sql->bindParam(":Slug",$datos['Slug']);
			$sql->bindParam(":Descripcion",$datos['Descripcion']);
			$sql->execute();
			return $sql;
		}

		protected function verificar_etiqueta_slug_disponible($slug){
			$sql=mainModel::conectar()->prepare("SELECT * FROM taxonomias WHERE taxonomia = 'etiqueta' AND slug = :Slug");
			$sql->bindParam(":Slug",$slug);
			$sql->execute();
			return $sql;
		}
		
		protected function verificar_etiqueta_editar_slug_disponible($codigo, $slug){
			$sql=mainModel::conectar()->prepare("SELECT * FROM taxonomias WHERE taxonomia = 'etiqueta' AND slug = :Slug AND id != :Codigo");
			$sql->bindParam(":Slug",$slug);
			$sql->bindParam(":Codigo",$codigo);
			$sql->execute();
			return $sql;
		}
		
		protected function editar_etiqueta_modelo($datos)
		{
			$sql=mainModel::conectar()->prepare("UPDATE taxonomias SET nombre = :Nombre, slug = :Slug, descripcion = :Descripcion WHERE id = :Codigo");
			$sql->bindParam(":Nombre",$datos['Nombre']);
			$sql->bindParam(":Slug",$datos['Slug']);
			$sql->bindParam(":Descripcion",$datos['Descripcion']);
			$sql->bindParam(":Codigo",$datos['Codigo']);
			$sql->execute();
			return $sql;
		}
		
		//MODELOS PARA ATRIBUTOS
		protected function agregar_atributo_modelo($datos){
			$sql=mainModel::conectar()->prepare("INSERT INTO taxonomias(nombre,slug,taxonomia,descripcion) VALUES(:Nombre,:Slug,'atributo',:Descripcion)");
			$sql->bindParam(":Nombre",$datos['Nombre']);
			$sql->bindParam(":Slug",$datos['Slug']);
			$sql->bindParam(":Descripcion",$datos['Descripcion']);
			$sql->execute();
			return $sql;
		}

		protected function verificar_atributo_slug_disponible($slug){
			$sql=mainModel::conectar()->prepare("SELECT * FROM taxonomias WHERE taxonomia = 'atributo' AND slug = :Slug");
			$sql->bindParam(":Slug",$slug);
			$sql->execute();
			return $sql;
		}
		
		protected function verificar_atributo_editar_slug_disponible($codigo, $slug){
			$sql=mainModel::conectar()->prepare("SELECT * FROM taxonomias WHERE taxonomia = 'atributo' AND slug = :Slug AND id != :Codigo");
			$sql->bindParam(":Slug",$slug);
			$sql->bindParam(":Codigo",$codigo);
			$sql->execute();
			return $sql;
		}

		protected function editar_atributo_modelo($datos)
		{
			$sql=mainModel::conectar()->prepare("UPDATE taxonomias SET nombre = :Nombre, slug = :Slug, descripcion = :Descripcion WHERE id = :Codigo");
			$sql->bindParam(":Nombre",$datos['Nombre']);
			$sql->bindParam(":Slug",$datos['Slug']);
			$sql->bindParam(":Descripcion",$datos['Descripcion']);
			$sql->bindParam(":Codigo",$datos['Codigo']);
			$sql->execute();
			return $sql;
		}

        //MODELOS PARA TÉRMINOS
		protected function agregar_termino_modelo($datos){
			$sql=mainModel::conectar()->prepare("INSERT INTO taxonomias(nombre,slug,taxonomia,descripcion,padre) VALUES(:Nombre,:Slug,'termino',:Descripcion,:Padre)");
			$sql->bindParam(":Nombre",$datos['Nombre']);
			$sql->bindParam(":Slug",$datos['Slug']);
			$sql->bindParam(":Descripcion",$datos['Descripcion']);
			$sql->bindParam(":Padre",$datos['Padre']);
			$sql->execute();
			return $sql;
		}

		protected function verificar_termino_slug_disponible($slug){
			$sql=mainModel::conectar()->prepare("SELECT * FROM taxonomias WHERE taxonomia = 'termino' AND slug = :Slug");
			$sql->bindParam(":Slug",$slug);
			$sql->execute();
			return $sql;
		}
		
		protected function verificar_termino_padre_modelo($id){
			$sql=mainModel::conectar()->prepare("SELECT * FROM taxonomias WHERE taxonomia = 'atributo' AND id = :Id");
			$sql->bindParam(":Id",$id);
			$sql->execute();
			return $sql;
		}

		protected function verificar_termino_editar_slug_disponible($codigo, $slug){
			$sql=mainModel::conectar()->prepare("SELECT * FROM taxonomias WHERE taxonomia = 'termino' AND slug = :Slug AND id != :Codigo");
			$sql->bindParam(":Slug",$slug);
			$sql->bindParam(":Codigo",$codigo);
			$sql->execute();
			return $sql;
		}

		protected function editar_termino_modelo($datos)
		{
			$sql=mainModel::conectar()->prepare("UPDATE taxonomias SET nombre = :Nombre, slug = :Slug, descripcion = :Descripcion, padre = :Padre WHERE id = :Codigo");
			$sql->bindParam(":Nombre",$datos['Nombre']);
			$sql->bindParam(":Slug",$datos['Slug']);
			$sql->bindParam(":Descripcion",$datos['Descripcion']);
			$sql->bindParam(":Padre",$datos['Padre']);
			$sql->bindParam(":Codigo",$datos['Codigo']);
			$sql->execute();
			return $sql;
		}

		//MODELOS PARA TAXONOMIAS
		protected function editar_taxonomia_modelo($datos)
		{
			$sql=mainModel::conectar()->prepare("UPDATE taxonomias SET nombre = :Nombre, slug = :Slug, descripcion = :Descripcion, padre = :Padre, icono = :Icono WHERE id = :Codigo");
			$sql->bindParam(":Nombre",$datos['Nombre']);
			$sql->bindParam(":Slug",$datos['Slug']);
			$sql->bindParam(":Descripcion",$datos['Descripcion']);
			$sql->bindParam(":Padre",$datos['Padre']);
			$sql->bindParam(":Icono",$datos['Icono']);
			$sql->bindParam(":Codigo",$datos['Codigo']);
			$sql->execute();
			return $sql;
		}

		protected function eliminar_taxonomia_modelo($codigo)
		{
			$query=mainModel::conectar()->prepare("DELETE FROM taxonomias WHERE id=:Codigo");
			$query->bindParam(":Codigo",$codigo);
			$query->execute();
			return $query;
		}

		//MODELOS PARA MEDIOS
		protected function agregar_medio_modelo($datos){
			$sql=mainModel::conectar()->prepare("INSERT INTO medios(titulo,url,fecha) VALUES(:Titulo,:Url,:Fecha)");
			$sql->bindParam(":Titulo",$datos['Titulo']);
			$sql->bindParam(":Url",$datos['Url']);
			$sql->bindParam(":Fecha",$datos['Fecha']);
			$sql->execute();
			return $sql;
		}

		protected function eliminar_imagen_modelo($codigo)
		{
			$sql=mainModel::conectar()->prepare("SELECT * FROM medios WHERE id=:Codigo");
			$sql->bindParam(":Codigo",$codigo);
			$sql->execute();
			if($sql->rowCount()>=1)
			{
				$datos=$sql->fetch();
				$foto=$datos['url'];
				$foto = str_replace(SERVERURL, "", $foto);
				$foto = "../".$foto;
				$resultado = @unlink($foto);
				return $resultado;
			}
			else
			{
				$resultado = false;
				return $resultado;
			}

		}

		protected function eliminar_medio_modelo($codigo)
		{
			$query=mainModel::conectar()->prepare("DELETE FROM medios WHERE id=:Codigo");
			$query->bindParam(":Codigo",$codigo);
			$query->execute();
			return $query;
		}

		protected function editar_medio_modelo($datos)
		{
			$sql=mainModel::conectar()->prepare("UPDATE medios SET titulo = :Titulo WHERE id = :Codigo");
			$sql->bindParam(":Titulo",$datos['Titulo']);
			$sql->bindParam(":Codigo",$datos['Codigo']);
			$sql->execute();
			return $sql;
		}
		
		//MODELOS PARA PRODUCTOS
		protected function agregar_producto_modelo($datos){
			$sql=mainModel::conectar()->prepare("INSERT INTO productos(sku,nombre,slug,descripcion,mpn,fabricante,tipo,nuevo,precio,precio_visitantes,precio_usuarios,precio_empresas,stock,oferta,fecha) VALUES (:Sku,:Nombre,:Slug,:Descripcion,:Mpn,:Fabricante,:Tipo,:Nuevo,:Precio,:Visitantes,:Usuarios,:Empresas,:Stock,:Oferta,:Fecha);");
			$sql->bindParam(":Sku",$datos['Sku']);
			$sql->bindParam(":Nombre",$datos['Nombre']);
			$sql->bindParam(":Slug",$datos['Slug']);
			$sql->bindParam(":Descripcion",$datos['Descripcion']);
			$sql->bindParam(":Mpn",$datos['Mpn']);
			$sql->bindParam(":Fabricante",$datos['Fabricante']);
			$sql->bindParam(":Tipo",$datos['Tipo']);
			$sql->bindParam(":Nuevo",$datos['Nuevo']);
			$sql->bindParam(":Precio",$datos['Precio']);
			$sql->bindParam(":Visitantes",$datos['Visitantes']);
			$sql->bindParam(":Usuarios",$datos['Usuarios']);
			$sql->bindParam(":Empresas",$datos['Empresas']);
			$sql->bindParam(":Stock",$datos['Stock']);
			$sql->bindParam(":Oferta",$datos['Oferta']);
			$sql->bindParam(":Fecha",$datos['Fecha']);
			$sql->execute();
			return $sql;
		}

		protected function agregar_galeria_modelo($datos){
			$sql=mainModel::conectar()->prepare("INSERT INTO galerias(producto,medio) VALUES (:Producto,:Medio);");
			$sql->bindParam(":Producto",$datos['Producto']);
			$sql->bindParam(":Medio",$datos['Medio']);
			$sql->execute();
			return $sql;
		}

		protected function agregar_relaciones_modelo($datos){
			$sql=mainModel::conectar()->prepare("INSERT INTO relaciones(sku,id_taxonomia) VALUES (:Sku,:Taxonomia);");
			$sql->bindParam(":Sku",$datos['Sku']);
			$sql->bindParam(":Taxonomia",$datos['Taxonomia']);
			$sql->execute();
			return $sql;
		}
		
		protected function eliminar_producto_modelo($codigo)
		{
			$query=mainModel::conectar()->prepare("DELETE FROM productos WHERE sku=:Codigo");
			$query->bindParam(":Codigo",$codigo);
			$query->execute();
			return $query;
		}
	}