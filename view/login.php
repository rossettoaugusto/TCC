<?php
	ob_start();
	session_start();

	include("funcoes.php");      
	
	$_SESSION['Logado'] = 'Não';		
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$vLogin = $_POST["edlogin"];
		$vSenha = $_POST["edsenha"];

		AbreConexao();				
		$vConsulta = mysql_query("SELECT U.USU_CODIGO FROM USUARIO U WHERE U.USU_LOGIN = '$vLogin' AND U.USU_SENHA = '$vSenha'");
		while($vLinha = mysql_fetch_array($vConsulta)){			
			$_SESSION['Logado'] = 'Sim';			
			header('location:index.php');
		}
	}
		
	include("menu.php");
?>
<!DOCTYPE HTML>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../assets/bootstrap/css/bootstrap.css">
	<link href="../js/css/ui-lightness/jquery-ui-1.10.3.custom.css" rel="stylesheet">
	<script src="../js/js/jquery-1.9.1.js"></script>
	<script src="../js/js/jquery-ui-1.10.3.custom.js"></script>



</head>
<body>
     <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="login.php">CadMed 2.0</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
                            
            </ul>
            <form method="POST" action="login.php" class="navbar-form pull-right">
              <input class="span2" type="text"  name="edlogin" placeholder="Login" required/>
              <input class="span2" type="password" name="edsenha" placeholder="Senha" required/>
               <input type="submit" name="logar" value="Usuario" class="btn" />

            </form>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

     <div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			
			<div class="hero-unit">
				<h1>
					CadMed 2.0
				</h1>
				<p>
					Este e um Prototipo de um Sistema de Cadastramento de Consultas de uma Clinica Médica.
				</p>
				
			</div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span4">
			<h2>
				Pacientes
			</h2>
			<p>
				Possui um Banco de Dados com Muitos Pacientes Cadastrados, com historico de consultas e lesoes.
			</p>
			
				
			
		</div>
		<div class="span4">
		    <h2>
				Medicos
			</h2>
			
			<p>
				Grande numero de Medicos Cadastrados com Registro no CRM e Cadastrados no RM 2.0	
			</p>
			
		</div>
		<div class="span4">
			<h2>
				Medicamentos
			</h2>
			<p>
				Possui uma Ampla Lista de Medicamentos Cadastrados em um Banco de Dados, com o intuito de ajudar o Médico com o receituario
			</p>
			
		</div>
	</div>
</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>

</html>