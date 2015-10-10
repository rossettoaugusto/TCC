<?php
	require("verificalogin.php"); 	
	include("menu.php");
	include("funcoes.php");      
	AbreConexao();				

	$vMensagem  = "";
	$vSaida     = "";

	if (isset($_POST['cadastrar'])){	
		$vLogin      = $_POST['edNovoLogin'];		
		$vNome       = $_POST['edNovoNome'];		
		$vSenha      = $_POST['edNovoSenha'];
		
		if ($vNome != ""){// Cadastrando novo
			if (mysql_query("INSERT INTO USUARIO VALUES (NULL , '$vNome', '$vLogin', '$vSenha'); ")){
				$vMensagem  = "Novo usuário gravado com sucesso.<br>";	
			}else{
				$vMensagem  = "Falha ao gravar novo usuário.<br>";	
			}
		}
	}
	if(isset($_POST['alterar'])):		
		$vCodigo = $_POST['edCodigo']; 	
		$vNome   = $_POST['edNome'];	
		$vLogin  = $_POST['edLogin'];		
		$vSenha  = $_POST['edSenha'];

		if (mysql_query("UPDATE USUARIO 
			             SET USU_NOME = '$vNome', 
		                 	 USU_LOGIN = '$vLogin',
		                 	 USU_SENHA = '$vSenha'
		                 WHERE USU_CODIGO = '$vCodigo'; ")){
			$vMensagem = $vMensagem . "Usuário " . $vCodigo . " atualizado com sucesso.<br>";	
		}else{
			$vMensagem = $vMensagem . "Falha ao atualizar o Usuário " . $i . ".<br>";	
		}
	endif;		


	// Carrega dados de consulta
	$vConsulta = mysql_query("SELECT USU_CODIGO,
			                 	     USU_NOME,
			                 	     USU_LOGIN,
			                 	     USU_SENHA
			                 FROM USUARIO
			                 ORDER BY 2");  	
	$i = 0;	
	while($vLinha = mysql_fetch_array($vConsulta)){			
		$i           = $i + 1;
		$vCodigo     = $vLinha["USU_CODIGO"];
		$vNome       = $vLinha["USU_NOME"];
		$vLogin      = $vLinha["USU_LOGIN"];
		$vSenha      = $vLinha["USU_SENHA"];

		$vSaida = $vSaida .
			"<tr>
				<form method='POST' action='usuario.php'>
					<input type='hidden' name='alterar'>
					<td><input type='text' name='edCodigo' value='" . $vCodigo . "'></td>
					<td><input type='text' name='edNome' value='" . $vNome . "'></td>
					<td><input type='text' name='edLogin' value='" . $vLogin . "'></td>
					<td><input type='text' name='edSenha' value='" . $vSenha . "'></td>
					<td><button type='submit'><i class='icon icon-ok'></button><td>
				</form>
			</tr>";	
	}

?>

<body>	
	<section>		
	<div class='span10'>
		<?php echo $vMensagem; ?>
		<h1>Usuários</h1>				
		<form action="usuario.php" method="post">				
			<input name="edQuantidadeLinhas" id="edQuantidadeLinhas" type="hidden" value="<?php echo $i; ?>" />				
			<input type='hidden'name='cadastrar'>
			<fieldset>
				<label>Código</label>
				<input type='text' class="span10" name="edNovoCodigo" value="<?= $i+1 ?>" readonly>
			<fieldset>
			<fieldset>
				<label>Nome</label>
				<input name='edNovoNome' id='edNovoNome' type='text' class="span10" value=''/>		
			</fieldset>
			<fieldset>
				<label>Login</label>
				<input name='edNovoLogin' id='edNovoLogin' type='text' class="span10" value=''/>		
			</fieldset>
			<fieldset>
				<label>Senha</label>
				<input name='edNovoSenha' id='edNovoSenha' type='password' class="span10" value=''/>		
			</fieldset>
			<button type="submit" class="btn-danger">Salvar</button>
		</form>
	</div>
	<div class="span10">
		<h3 class="danger">Cadastrados</h3>
		<table class='table table-striped'>
			<tr><td>Cod.</td><td>Nome</td><td>Login</td><td>Password</td><td>Alterar</td></tr>
			<?= $vSaida ?>
		</table>
	</div>
	</section>
	
	<script src="../bootstrap/js/bootstrap.min.js"></script>

</body>