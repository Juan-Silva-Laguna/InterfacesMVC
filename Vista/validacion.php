<?php
	error_reporting(0);
	session_start();
	if ($_SESSION['nombre'] != null) {
		include('headLogeado.php');
	}else{
		include('head.php');
	}
?>