<?php	
	ob_start();
	session_start();
	
	if($_SESSION['Logado'] != 'Sim') {
		header('location:login.php');
	}
?>