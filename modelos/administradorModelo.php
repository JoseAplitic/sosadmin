<?php
	if($peticionAjax){
		require_once "../core/mainModel.php";
	}else{
		require_once "./core/mainModel.php";
	}

	class administradorModelo extends mainModel{

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

		protected function verificar_categoria_slug_disponible($slug){
			$sql=mainModel::conectar()->prepare("SELECT * FROM taxonomias WHERE taxonomia = 'categoria' AND slug = :Slug");
			$sql->bindParam(":Slug",$slug);
			$sql->execute();
			return $sql;
		}

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
		
		protected function eliminar_taxonomia_modelo($codigo)
		{
			$query=mainModel::conectar()->prepare("DELETE FROM taxonomias WHERE id=:Codigo");
			$query->bindParam(":Codigo",$codigo);
			$query->execute();
			return $query;
		}
	}