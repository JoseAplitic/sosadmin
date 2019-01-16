<!DOCTYPE html>
<html lang="es">
<head>
	<title><?php echo COMPANY; ?></title>
	<meta charset="UTF-8">
	<meta lang="es">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/style.css">
	<?php include "./vistas/modulos/script.php"; ?>
</head>
<body>
	<?php
		$peticionAjax=false;  
		
		require_once "./controladores/vistasControlador.php";

		$vt = new vistasControlador();
		$vistasR=$vt->obtener_vistas_controlador();

		if($vistasR=="login"):
			require_once "./vistas/contenidos/login-vista.php";
		elseif ($vistasR=="404"):
			require_once "./vistas/contenidos/404-vista.php";
		else:
			session_start(['name'=>'adminsoswebstore']);
	?>

	<!-- Left Panel -->
	<?php include "./vistas/modulos/navlateral.php"; ?>
	<!-- /#left-panel -->

    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">

		<!-- Header-->
		<?php include "./vistas/modulos/navbar.php"; ?>
		<!-- /#header -->
		
		<!-- Content page -->
		<?php require_once $vistasR; ?>

	</div>
	<?php
		include "./vistas/modulos/logoutScript.php";
	endif; 
	?>
</body>
</html>