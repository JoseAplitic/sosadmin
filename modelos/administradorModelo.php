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
			$sql=mainModel::conectar()->prepare("INSERT INTO taxonomias(nombre,slug,taxonomia,descripcion,padre,icono,icono2) VALUES(:Nombre,:Slug,'categoria',:Descripcion,:Padre,:Icono,:Icono2)");
			$sql->bindParam(":Nombre",$datos['Nombre']);
			$sql->bindParam(":Slug",$datos['Slug']);
			$sql->bindParam(":Descripcion",$datos['Descripcion']);
			$sql->bindParam(":Padre",$datos['Padre']);
			$sql->bindParam(":Icono",$datos['Icono']);
			$sql->bindParam(":Icono2",$datos['Icono2']);
			$sql->execute();
			return $sql;
		}
		
		protected function agregar_regla_modelo($datos){
			$sql=mainModel::conectar()->prepare("INSERT INTO reglas(id_categoria,regla_visitantes,regla_usuarios,regla_empresas) VALUES(:Id,:Visitantes,:Usuarios,:Empresas)");
			$sql->bindParam(":Id",$datos['Id']);
			$sql->bindParam(":Visitantes",$datos['Visitantes']);
			$sql->bindParam(":Usuarios",$datos['Usuarios']);
			$sql->bindParam(":Empresas",$datos['Empresas']);
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
		protected function obtener_categoria_id_slug_modelo($slug)
		{
			$sql=mainModel::conectar()->prepare("SELECT * FROM taxonomias WHERE taxonomia = 'categoria' AND slug = :Slug;");
			$sql->bindParam(":Slug",$slug);
			$sql->execute();
			return $sql;
		}
		protected function editar_regla_modelo($datos)
		{
			$sql=mainModel::conectar()->prepare("UPDATE reglas SET regla_visitantes = :Visitantes, regla_usuarios = :Usuarios, regla_empresas = :Empresas WHERE id_categoria = :Codigo");
			$sql->bindParam(":Visitantes",$datos['Visitantes']);
			$sql->bindParam(":Usuarios",$datos['Usuarios']);
			$sql->bindParam(":Empresas",$datos['Empresas']);
			$sql->bindParam(":Codigo",$datos['Id']);
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
			$sql=mainModel::conectar()->prepare("UPDATE taxonomias SET nombre = :Nombre, slug = :Slug, descripcion = :Descripcion, padre = :Padre, icono = :Icono, icono2 = :Icono2, color = :Color WHERE id = :Codigo");
			$sql->bindParam(":Nombre",$datos['Nombre']);
			$sql->bindParam(":Slug",$datos['Slug']);
			$sql->bindParam(":Descripcion",$datos['Descripcion']);
			$sql->bindParam(":Padre",$datos['Padre']);
			$sql->bindParam(":Icono",$datos['Icono']);
			$sql->bindParam(":Icono2",$datos['Icono2']);
			$sql->bindParam(":Color",$datos['Color']);
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
			$sql=mainModel::conectar()->prepare("INSERT INTO productos(sku,nombre,slug,descripcion,especificaciones,mpn,fabricante,tipo,nuevo,precio,stock,oferta,calificacion,justificacion,fecha) VALUES (:Sku,:Nombre,:Slug,:Descripcion,:Especificaciones,:Mpn,:Fabricante,:Tipo,:Nuevo,:Precio,:Stock,:Oferta,:Calificacion,:Justificacion,:Fecha);");
			$sql->bindParam(":Sku",$datos['Sku']);
			$sql->bindParam(":Nombre",$datos['Nombre']);
			$sql->bindParam(":Slug",$datos['Slug']);
			$sql->bindParam(":Descripcion",$datos['Descripcion']);
			$sql->bindParam(":Especificaciones",$datos['Especificaciones']);
			$sql->bindParam(":Mpn",$datos['Mpn']);
			$sql->bindParam(":Fabricante",$datos['Fabricante']);
			$sql->bindParam(":Tipo",$datos['Tipo']);
			$sql->bindParam(":Nuevo",$datos['Nuevo']);
			$sql->bindParam(":Precio",$datos['Precio']);
			$sql->bindParam(":Stock",$datos['Stock']);
			$sql->bindParam(":Oferta",$datos['Oferta']);
			$sql->bindParam(":Calificacion",$datos['Calificacion']);
			$sql->bindParam(":Justificacion",$datos['Justificacion']);
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

		protected function eliminar_galeria_modelo($datos){
			$sql=mainModel::conectar()->prepare("DELETE FROM galerias WHERE producto = :Producto AND medio = :Medio;");
			$sql->bindParam(":Producto",$datos['Producto']);
			$sql->bindParam(":Medio",$datos['Medio']);
			$sql->execute();
			return $sql;
		}

		protected function eliminar_galerias_modelo($sku){
			$sql=mainModel::conectar()->prepare("DELETE FROM galerias WHERE producto = :Producto;");
			$sql->bindParam(":Producto",$sku);
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

		protected function eliminar_relaciones_modelo($datos){
			$sql=mainModel::conectar()->prepare("DELETE FROM relaciones WHERE sku = :Sku AND id_taxonomia = :Taxonomia;");
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

		protected function verificar_producto_slug_disponible($slug){
			$sql=mainModel::conectar()->prepare("SELECT * FROM productos WHERE slug = :Slug");
			$sql->bindParam(":Slug",$slug);
			$sql->execute();
			return $sql;
		}

		protected function verificar_producto_editar_slug_disponible($slug, $sku){
			$sql=mainModel::conectar()->prepare("SELECT * FROM productos WHERE slug = :Slug AND sku != :Sku");
			$sql->bindParam(":Slug",$slug);
			$sql->bindParam(":Sku",$sku);
			$sql->execute();
			return $sql;
		}

		protected function editar_producto_modelo($datos){
			$sql=mainModel::conectar()->prepare("UPDATE productos SET sku = :Sku, nombre = :Nombre, slug = :Slug, descripcion = :Descripcion, especificaciones = :Especificaciones, mpn = :Mpn, fabricante = :Fabricante, tipo = :Tipo, nuevo = :Nuevo ,precio = :Precio, stock = :Stock, oferta = :Oferta, calificacion = :Calificacion, justificacion = :Justificacion WHERE sku = :Original;");
			$sql->bindParam(":Sku",$datos['Sku']);
			$sql->bindParam(":Nombre",$datos['Nombre']);
			$sql->bindParam(":Slug",$datos['Slug']);
			$sql->bindParam(":Descripcion",$datos['Descripcion']);
			$sql->bindParam(":Especificaciones",$datos['Especificaciones']);
			$sql->bindParam(":Mpn",$datos['Mpn']);
			$sql->bindParam(":Fabricante",$datos['Fabricante']);
			$sql->bindParam(":Tipo",$datos['Tipo']);
			$sql->bindParam(":Nuevo",$datos['Nuevo']);
			$sql->bindParam(":Precio",$datos['Precio']);
			$sql->bindParam(":Stock",$datos['Stock']);
			$sql->bindParam(":Oferta",$datos['Oferta']);
			$sql->bindParam(":Calificacion",$datos['Calificacion']);
			$sql->bindParam(":Justificacion",$datos['Justificacion']);
			$sql->bindParam(":Original",$datos['Original']);
			$sql->execute();
			return $sql;
		}

		protected function producto_cambio_slug_galeria_modelo($sku, $sku_original)
		{
			$sql=mainModel::conectar()->prepare("UPDATE galerias SET producto = :Sku WHERE producto = :Original");
			$sql->bindParam(":Sku",$sku);
			$sql->bindParam(":Original",$sku_original);
			$sql->execute();
			return $sql;
		}

		protected function producto_cambio_slug_relacion_modelo($sku, $sku_original)
		{
			$sql=mainModel::conectar()->prepare("UPDATE relaciones SET sku = :Sku WHERE sku = :Original");
			$sql->bindParam(":Sku",$sku);
			$sql->bindParam(":Original",$sku_original);
			$sql->execute();
			return $sql;
		}

		protected function producto_cambio_slug_relacion_descuento_modelo($sku, $sku_original)
		{
			$sql=mainModel::conectar()->prepare("UPDATE descuentos_relaciones SET item = :Sku WHERE item = :Original AND tipo = 'producto'");
			$sql->bindParam(":Sku",$sku);
			$sql->bindParam(":Original",$sku_original);
			$sql->execute();
			return $sql;
		}

		//MODELOS LIMPIAR REGISTROS DE BASE DE DATOS
		protected function limpiar_galeria_modelo($identificador)
		{
			$query=mainModel::conectar()->prepare("DELETE FROM galerias WHERE producto=:Codigo");
			$query->bindParam(":Codigo",$identificador);
			$query->execute();
			return $query;
		}

		protected function limpiar_galeria_elimnar_imagen_modelo($medio)
		{
			$query=mainModel::conectar()->prepare("DELETE FROM galerias WHERE medio=:Medio");
			$query->bindParam(":Medio",$medio);
			$query->execute();
			return $query;
		}

		protected function limpiar_icono_categoria_modelo($icono)
		{
			$query=mainModel::conectar()->prepare("UPDATE taxonomias SET icono = 0 WHERE icono=:Icono");
			$query->bindParam(":Icono",$icono);
			$query->execute();
			return $query;
		}
		
		protected function limpiar_atributos_modelo($identificador)
		{
			$query=mainModel::conectar()->prepare("DELETE FROM taxonomias WHERE padre=:Codigo");
			$query->bindParam(":Codigo",$identificador);
			$query->execute();
			return $query;
		}
		
		protected function limpiar_categorias_modelo($identificador)
		{
			$query=mainModel::conectar()->prepare("DELETE FROM taxonomias WHERE padre=:Codigo");
			$query->bindParam(":Codigo",$identificador);
			$query->execute();
			return $query;
		}

		protected function limpiar_relaciones_modelo($identificador)
		{
			$query=mainModel::conectar()->prepare("DELETE FROM relaciones WHERE sku=:Codigo");
			$query->bindParam(":Codigo",$identificador);
			$query->execute();
			return $query;
		}

		protected function limpiar_relaciones_taxonomias_modelo($identificador)
		{
			$query=mainModel::conectar()->prepare("DELETE FROM relaciones WHERE id_taxonomia=:Codigo");
			$query->bindParam(":Codigo",$identificador);
			$query->execute();
			return $query;
		}

		protected function limpiar_reglas_modelo($identificador)
		{
			$query=mainModel::conectar()->prepare("DELETE FROM reglas WHERE id_categoria=:Codigo");
			$query->bindParam(":Codigo",$identificador);
			$query->execute();
			return $query;
		}

		//MODELOS PARA DESCUENTOS
		protected function agregar_descuento_modelo($datos){
			$sql=mainModel::conectar()->prepare("INSERT INTO descuentos(nombre,descripcion,tipo_descuento,regla_visitantes,regla_usuarios,regla_empresas,inicio,vencimiento) VALUES (:Nombre,:Descripcion,:Tipo,:Visitantes,:Usuarios,:Empresas,:Inicio,:Vencimiento);");
			$sql->bindParam(":Nombre",$datos['Nombre']);
			$sql->bindParam(":Descripcion",$datos['Descripcion']);
			$sql->bindParam(":Tipo",$datos['Tipo']);
			$sql->bindParam(":Visitantes",$datos['Visitantes']);
			$sql->bindParam(":Usuarios",$datos['Usuarios']);
			$sql->bindParam(":Empresas",$datos['Empresas']);
			$sql->bindParam(":Inicio",$datos['Inicio']);
			$sql->bindParam(":Vencimiento",$datos['Vencimiento']);
			$sql->execute();
			return $sql;
		}

		protected function descuento_max_modelo()
		{
			$sql=mainModel::conectar()->prepare("SELECT MAX(id) AS id FROM descuentos");
			$sql->execute();
			return $sql;
		}

		protected function agregar_relaciones_descuento_modelo($datos){
			$sql=mainModel::conectar()->prepare("INSERT INTO descuentos_relaciones(id_descuento,item,tipo) VALUES (:Id,:Item,:Tipo);");
			$sql->bindParam(":Id",$datos['Id']);
			$sql->bindParam(":Item",$datos['Item']);
			$sql->bindParam(":Tipo",$datos['Tipo']);
			$sql->execute();
			return $sql;
		}

		protected function eliminar_descuento_modelo($codigo)
		{
			$query=mainModel::conectar()->prepare("DELETE FROM descuentos WHERE id=:Codigo");
			$query->bindParam(":Codigo",$codigo);
			$query->execute();
			return $query;
		}
		
		protected function limpiar_descuento_modelo($identificador)
		{
			$query=mainModel::conectar()->prepare("DELETE FROM descuentos_relaciones WHERE id_descuento=:Codigo");
			$query->bindParam(":Codigo",$identificador);
			$query->execute();
			return $query;
		}
		
		protected function limpiar_descuentos_relaciones_modelo($identificador, $tipo)
		{
			$query=mainModel::conectar()->prepare("DELETE FROM descuentos_relaciones WHERE item=:Codigo AND tipo = :Tipo");
			$query->bindParam(":Codigo",$identificador);
			$query->bindParam(":Tipo",$tipo);
			$query->execute();
			return $query;
		}

		protected function editar_descuento_modelo($datos){
			$sql=mainModel::conectar()->prepare("UPDATE descuentos SET nombre = :Nombre, descripcion = :Descripcion, tipo_descuento = :Tipo, regla_visitantes = :Visitantes, regla_usuarios = :Usuarios, regla_empresas = :Empresas, inicio = :Inicio, vencimiento = :Vencimiento WHERE id = :Id;");
			$sql->bindParam(":Nombre",$datos['Nombre']);
			$sql->bindParam(":Descripcion",$datos['Descripcion']);
			$sql->bindParam(":Tipo",$datos['Tipo']);
			$sql->bindParam(":Visitantes",$datos['Visitantes']);
			$sql->bindParam(":Usuarios",$datos['Usuarios']);
			$sql->bindParam(":Empresas",$datos['Empresas']);
			$sql->bindParam(":Inicio",$datos['Inicio']);
			$sql->bindParam(":Vencimiento",$datos['Vencimiento']);
			$sql->bindParam(":Id",$datos['Id']);
			$sql->execute();
			return $sql;
		}

		protected function eliminar_relaciones_descuento_modelo($datos){
			$sql=mainModel::conectar()->prepare("DELETE FROM descuentos_relaciones WHERE id_descuento = :Id AND item = :Item AND tipo = :Tipo;");
			$sql->bindParam(":Id",$datos['Id']);
			$sql->bindParam(":Item",$datos['Item']);
			$sql->bindParam(":Tipo",$datos['Tipo']);
			$sql->execute();
			return $sql;
		}

		//MODELOS PARA MARCAS
		protected function agregar_marca_modelo($datos){
			$sql=mainModel::conectar()->prepare("INSERT INTO taxonomias(nombre,slug,taxonomia,descripcion,icono,icono2,color) VALUES(:Nombre,:Slug,'marca',:Descripcion,:Icono,:Icono2,:Color)");
			$sql->bindParam(":Nombre",$datos['Nombre']);
			$sql->bindParam(":Slug",$datos['Slug']);
			$sql->bindParam(":Descripcion",$datos['Descripcion']);
			$sql->bindParam(":Icono",$datos['Icono']);
			$sql->bindParam(":Icono2",$datos['Icono2']);
			$sql->bindParam(":Color",$datos['Color']);
			$sql->execute();
			return $sql;
		}

		protected function verificar_marca_slug_disponible($slug){
			$sql=mainModel::conectar()->prepare("SELECT * FROM taxonomias WHERE taxonomia = 'marca' AND slug = :Slug");
			$sql->bindParam(":Slug",$slug);
			$sql->execute();
			return $sql;
		}
		
		protected function verificar_marca_editar_slug_disponible($codigo, $slug){
			$sql=mainModel::conectar()->prepare("SELECT * FROM taxonomias WHERE taxonomia = 'marca' AND slug = :Slug AND id != :Codigo");
			$sql->bindParam(":Slug",$slug);
			$sql->bindParam(":Codigo",$codigo);
			$sql->execute();
			return $sql;
		}
		
		protected function obtener_marca_id_slug_modelo($slug)
		{
			$sql=mainModel::conectar()->prepare("SELECT * FROM taxonomias WHERE taxonomia = 'marca' AND slug = :Slug;");
			$sql->bindParam(":Slug",$slug);
			$sql->execute();
			return $sql;
		}

		//MODELOS PARA VISTAS PERSONALIZADAS
		protected function agregar_vista_modelo($datos){
			$sql=mainModel::conectar()->prepare("INSERT INTO vistas_personalizadas(id_taxonomia,slides,columnas,banner,marcas,cabecera) VALUES(:Id,:Slides,:Modulos,:Banner,:Marcas,:Cabecera)");
			$sql->bindParam(":Id",$datos['Id']);
			$slides = json_encode($datos['Slides']);
			$sql->bindParam(":Slides",$slides);
			$modulos = json_encode($datos['Modulos']);
			$sql->bindParam(":Modulos",$modulos);
			$banner = json_encode($datos['Banner']);
			$sql->bindParam(":Banner",$banner);
			$marcas = json_encode( $datos['Marcas']);
			$sql->bindParam(":Marcas",$marcas);
			$cabecera = json_encode( $datos['Cabecera']);
			$sql->bindParam(":Cabecera",$cabecera);
			$sql->execute();
			return $sql;
		}

		protected function editar_vista_modelo($datos)
		{
			$sql=mainModel::conectar()->prepare("UPDATE vistas_personalizadas SET slides = :Slides, columnas = :Modulos, banner = :Banner, marcas = :Marcas, cabecera = :Cabecera WHERE id_taxonomia = :Id");
			$sql->bindParam(":Id",$datos['Id']);
			$slides = json_encode($datos['Slides']);
			$sql->bindParam(":Slides",$slides);
			$modulos = json_encode($datos['Modulos']);
			$sql->bindParam(":Modulos",$modulos);
			$banner = json_encode($datos['Banner']);
			$sql->bindParam(":Banner",$banner);
			$marcas = json_encode( $datos['Marcas']);
			$sql->bindParam(":Marcas",$marcas);
			$cabecera = json_encode( $datos['Cabecera']);
			$sql->bindParam(":Cabecera",$cabecera);
			$sql->execute();
			return $sql;
		}

		protected function editar_vista_marca_modelo($datos)
		{
			$sql=mainModel::conectar()->prepare("UPDATE vistas_personalizadas SET slides = :Slides, columnas = :Modulos, banner = :Banner, cabecera = :Cabecera WHERE id_taxonomia = :Id");
			$sql->bindParam(":Id",$datos['Id']);
			$slides = json_encode($datos['Slides']);
			$sql->bindParam(":Slides",$slides);
			$modulos = json_encode($datos['Modulos']);
			$sql->bindParam(":Modulos",$modulos);
			$banner = json_encode($datos['Banner']);
			$sql->bindParam(":Banner",$banner);
			$cabecera = json_encode( $datos['Cabecera']);
			$sql->bindParam(":Cabecera",$cabecera);
			$sql->execute();
			return $sql;
		}

		protected function agregar_vista_marca_modelo($datos){
			$sql=mainModel::conectar()->prepare("INSERT INTO vistas_personalizadas(id_taxonomia,slides,columnas,banner,cabecera) VALUES(:Id,:Slides,:Modulos,:Banner,:Cabecera)");
			$sql->bindParam(":Id",$datos['Id']);
			$slides = json_encode($datos['Slides']);
			$sql->bindParam(":Slides",$slides);
			$modulos = json_encode($datos['Modulos']);
			$sql->bindParam(":Modulos",$modulos);
			$banner = json_encode($datos['Banner']);
			$sql->bindParam(":Banner",$banner);
			$cabecera = json_encode( $datos['Cabecera']);
			$sql->bindParam(":Cabecera",$cabecera);
			$sql->execute();
			return $sql;
		}

		protected function eliminar_vista_modelo($codigo)
		{
			$query=mainModel::conectar()->prepare("DELETE FROM vistas_personalizadas WHERE id_taxonomia=:Codigo");
			$query->bindParam(":Codigo",$codigo);
			$query->execute();
			return $query;
		}

		//MODELOS PARA VISTAS

		protected function actualizar_vista_header_modelo($datosHeader)
		{
			$sql=mainModel::conectar()->prepare("UPDATE vistas SET contenido = :DatosHeader WHERE vista = 'header';");
			$sql->bindParam(":DatosHeader",$datosHeader);
			$sql->execute();
			return $sql;
		}

		protected function actualizar_vista_home_modelo($datosHome)
		{
			$sql=mainModel::conectar()->prepare("UPDATE vistas SET contenido = :DatosHome WHERE vista = 'home';");
			$sql->bindParam(":DatosHome",$datosHome);
			$sql->execute();
			return $sql;
		}
		
	}