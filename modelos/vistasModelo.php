<?php 
	class vistasModelo{
		protected function obtener_vistas_modelo($vistas){
			$listaBlanca=["inicio","usuarios","nuevo-usuario","buscar-usuarios","perfil-usuario","editar-usuario","noticias","buscar-noticia","nueva-noticia","editar-noticia"];
			if(in_array($vistas, $listaBlanca)){
				if(is_file("./vistas/contenidos/".$vistas."-vista.php")){
					$contenido="./vistas/contenidos/".$vistas."-vista.php";
				}else{
					$contenido="login";
				}
			}elseif($vistas=="login"){
				$contenido="login";
			}elseif($vistas=="index"){
				$contenido="login";
			}else{
				$contenido="404";
			}
			return $contenido;
		}
	}