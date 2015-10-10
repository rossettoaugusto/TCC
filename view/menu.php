<!DOCTYPE HTML>

<head>
	<link rel="stylesheet" type="text/css" href="../assets/bootstrap/css/bootstrap.css">
	<link href="../js/css/ui-lightness/jquery-ui-1.10.3.custom.css" rel="stylesheet">
	<script src="../js/js/jquery-1.9.1.js"></script>
	<script src="../js/js/jquery-ui-1.10.3.custom.js"></script>
</head>


<?php
	if(!isset($_SESSION))
		session_start();
	$vSaida = '';
	if($_SESSION['Logado'] == 'Sim') {
		$vSaida = '
		<div class="navbar navbar-inverse">
			<div class="navbar-inner">
				<ul class="nav">
					<li><img id="logo" src="logo.jpg" alt="CAFW" width="45px" height="45px"></li>
					<li><a href="usuario.php">Usuarios</a></li>
					<li><a href="paciente.php">Pacientes</a></li>
					<li><a href="agenda.php">Agendamentos</a></li>
					<li><a href="download.php">Download</a></li>
					<li><a href="login.php">Sair</a></li>
				</ul>
			</div>
		</div>';
	}else{
		$vSaida = '
		<nav>
			<ul>
				<li><a href="login.php">Login</a></li>
			</ul>
		</nav>';			
	}	
?>
<table>
	<tr>
		<!-- <td><img id="logo" src="logo.jpg" alt="CAFW"></td> -->
	</tr>	
</table>
<?= $vSaida ?>
