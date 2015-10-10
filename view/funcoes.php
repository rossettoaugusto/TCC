<?php
	include("configuracao.php");	
	
	function AbreConexao(){	
		@mysql_connect(SERVIDOR, USUARIO, SENHA) or die(mysql_error());		
		@mysql_select_db(BANCO) or die(mysql_error());
	}	
	
	function FechaConexao(){
		@mysql_close;
	}
?>
