<?php
	if ($_SERVER['REQUEST_METHOD'] == "POST"){
		$vLogin = $_POST["ws_login"];
		$vSenha = $_POST["ws_senha"];

		$vRetorno = array();
		$vRetorno["RetCodigo"] = 0;
 		
		include('funcoes.php');
		AbreConexao();
			
		$vConsulta = mysql_query("SELECT PAC_CODIGO FROM PACIENTE WHERE
		        PAC_LOGIN = '$vLogin' AND PAC_SENHA = '$vSenha'");
		while($vLinha = mysql_fetch_array($vConsulta)){			
			$vRetorno["RetCodigo"] = $vLinha["PAC_CODIGO"];
		}
		
		echo json_encode($vRetorno);
	}	
?>
