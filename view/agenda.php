<?php
	require("verificalogin.php"); 	
	include("menu.php");
	include("funcoes.php");      
	AbreConexao();				

	$vMensagem  = "";
	$vSaida     = "";

	if ($_SERVER['REQUEST_METHOD'] == "POST"){	
		$vPaciente = $_POST['edPaciente'];		
		$vData     = $_POST['edData'];		
		$vHora     = $_POST['edHora'];

		if (mysql_query("INSERT INTO AGENDAMENTOS VALUES (NULL , '$vData', '$vHora', '$vPaciente', 'Confirmado'); ")){
			$vMensagem  = "Novo Agendamento gravado com sucesso.<br>";	
		}else{
			$vMensagem  = "Falha ao gravar novo Agendamento.<br>";	
		}
	}else{
		if (isset($_GET['canc'])){
			if (mysql_query("UPDATE AGENDAMENTOS 
				             SET AG_SITUACAO = 'Cancelado'
			                 WHERE AG_CODIGO = " . $_GET['canc'] . " ")){
				$vMensagem = $vMensagem . "Agendamento " . $i . " cancelado com sucesso.<br>";	
			}else{
				$vMensagem = $vMensagem . "Falha ao cancelar o Agendamento " . $i . ".<br>";	
			}
		}		
	}

	$vPacientes = "";

	// Carrega dados de consulta
	$vConsulta = mysql_query("SELECT PAC_CODIGO,
			                 	     PAC_NOME
			                 FROM PACIENTE
			                 ORDER BY 2");  	
	$i = 0;	
	while($vLinha = mysql_fetch_array($vConsulta)){			
		$vCodigo    = $vLinha["PAC_CODIGO"];
		$vNome      = $vLinha["PAC_NOME"];

		$vPacientes = $vPacientes . 
		              "<option value='" . $vCodigo . "'>" . $vNome . "</option>";	
	}

	// Carrega dados de consulta
	$vConsulta = mysql_query("SELECT A.AG_CODIGO,
			                 	     A.AG_DATA,
			                 	     A.AG_HORA,
			                 	     P.PAC_NOME
			                 FROM AGENDAMENTOS A
			                   INNER JOIN PACIENTE P  
			                     ON P.PAC_CODIGO = A.PAC_CODIGO
			                 WHERE A.AG_SITUACAO = 'Confirmado'    
			                 ORDER BY 2");  	
	$i = 0;	
	while($vLinha = mysql_fetch_array($vConsulta)){			
		$vCodigo    = $vLinha["AG_CODIGO"];
		$vData      = $vLinha["AG_DATA"];
		$vHora      = $vLinha["AG_HORA"];
		$vPaciente  = $vLinha["PAC_NOME"];

		$vSaida = $vSaida .
			"<tr>
				<td>
					". $vData . "	
				</td>
				<td>
					". $vHora . "
				</td>
				<td>
					". $vPaciente . "
				</td>
				<td>
					<a href='agenda.php?canc=" . $vCodigo . "'>Cancelar</a>
				</td>
			</tr>";	
	}

?>
<!DOCTYPE HTML>
<html>
<head>
<body>	
<div class='span10'>
		<?php echo $vMensagem; ?>
		<h1>Novos Agendamento</h1>				
		<form action="agenda.php" method="post">				
			<input name="edQuantidadeLinhas" id="edQuantidadeLinhas" type="hidden" value="<?php echo $i; ?>" />				
			<input type='hidden'name='cadastrar'>
			<fieldset>
				<label>Codigo</label>
				<input type='text' class="span10" name="edNovoCodigo" value="<?= $i+1 ?>" readonly>
			<fieldset>
			<fieldset><label>Data</label>
				<input name="edData"id='edData' type='text' class="span10"  value="" >
			</fieldset>
			<fieldset>
				<label>Hora</label>
				<input name='edHora' id='edHora' type='text' class="span10" value=''/>		
			</fieldset>
			<fieldset>
				<label>Paciente</label>
                <select name='edPaciente' id='edPaciente' value='' class="span10">
					<?= $vPacientes ?>
				</select>	
			</fieldset>
				<button type="submit" class="btn-danger">Salvar</button>
		</form>
	</div>
		

		<div class="span12">
		<h3 class="danger">Agendamentos</h3>
		<table class='table table-striped'>
			<tr><td>Data</td><td>Hora</td><td>Paciente</td></tr>
			<?= $vSaida ?>
		</table>
	</div>

</body>
</html>