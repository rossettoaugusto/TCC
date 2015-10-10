<?php
	if ($_SERVER['REQUEST_METHOD'] == "POST"){
		$vCodigo = $_POST["ws_paciente"];

		$vRetorno = array();
		$vRetorno["RetAgendamentos"] = array();
		$vRetorno["RetQuantidade"] = 0;
 		
		include('funcoes.php');
		AbreConexao();
			
		$vConsulta = mysql_query("SELECT AG_CODIGO, 
										 AG_DATA, 
										 AG_HORA, 
										 AG_SITUACAO
								  FROM AGENDAMENTOS 
								  WHERE PAC_CODIGO = '$vCodigo'");
		while($vLinha = mysql_fetch_array($vConsulta)){			
			$vAgendamento = array();
			$vAgendamento["Codigo"]   = $vLinha["AG_CODIGO"];
			$vAgendamento["Data"]     = $vLinha["AG_DATA"];
			$vAgendamento["Hora"]     = $vLinha["AG_HORA"];
			$vAgendamento["Situacao"] = $vLinha["AG_SITUACAO"];
			array_push($vRetorno["RetAgendamentos"], $vAgendamento);	

			$vRetorno["RetQuantidade"] = $vRetorno["RetQuantidade"] + 1;	
		}
		
		echo json_encode($vRetorno);
	}	
?>