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

		protected function agregar_noticia_modelo($datos){
			$sql=mainModel::conectar()->prepare("INSERT INTO noticias(titulo,contenido,imagen,autor,fecha) VALUES(:Titulo,:Contenido,:Imagen,:Autor,:Fecha)");
			$sql->bindParam(":Titulo",$datos['Titulo']);
			$sql->bindParam(":Contenido",$datos['Contenido']);
			$sql->bindParam(":Imagen",$datos['Imagen']);
			$sql->bindParam(":Autor",$datos['Autor']);
			$sql->bindParam(":Fecha",$datos['Fecha']);
			$sql->execute();
			return $sql;
		}
		
		
		protected function eliminar_foto_noticia_modelo($codigo)
		{
			$sql=mainModel::conectar()->prepare("SELECT * FROM noticias WHERE id=:Codigo");
			$sql->bindParam(":Codigo",$codigo);
			$sql->execute();
			if($sql->rowCount()>=1)
			{
				$datos=$sql->fetch();
				$foto=$datos['imagen'];
				$carpeta='../noticias/';
				$resultado = @unlink($carpeta.$foto);
				return $resultado;
			}
			else
			{
				$resultado = false;
				return $resultado;
			}

		}

		protected function eliminar_noticia_modelo($codigo)
		{
			$query=mainModel::conectar()->prepare("DELETE FROM noticias WHERE id=:Codigo");
			$query->bindParam(":Codigo",$codigo);
			$query->execute();
			return $query;
		}


		protected function editar_noticia_modelo($datos)
		{
			$sql=mainModel::conectar()->prepare("UPDATE noticias SET titulo = :Titulo, contenido = :Contenido WHERE id = :Codigo");
			$sql->bindParam(":Titulo",$datos['Titulo']);
			$sql->bindParam(":Contenido",$datos['Contenido']);
			$sql->bindParam(":Codigo",$datos['Clave']);
			$sql->execute();
			return $sql;
		}

		
		protected function editar_imagen_modelo($codigo, $foto)
		{
			$sql=mainModel::conectar()->prepare("UPDATE noticias SET imagen = :Foto WHERE id=:Codigo");
			$sql->bindParam(":Foto",$foto);
			$sql->bindParam(":Codigo",$codigo);
			$sql->execute();
			return $sql;
		}
	}