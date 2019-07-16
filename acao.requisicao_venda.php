<?php

	include_once('inc.conect.php');

	print_r($_POST);

	(isset($_POST['id_produto']) 	and !empty($_POST['id_produto'])) 	? $id_produto = $_POST['id_produto'] 	: $erro = TRUE;
	(isset($_POST['qtd']) 			and !empty($_POST['qtd'])) 			? $qtd = $_POST['qtd'] 					: $erro = TRUE;
	(isset($_POST['valor'])			and !empty($_POST['valor'])) 		? $valor = $_POST['valor'] 				: $erro = TRUE;
	(isset($_POST['id_venda']) 		and !empty($_POST['id_venda'])) 	? $id_venda = $_POST['id_venda'] 		: $erro = TRUE;
	(isset($_REQUEST['acao'])  		and !empty($_REQUEST['acao']))  	? $acao = $_REQUEST['acao'] 			: $erro = TRUE;

	switch ($acao) {
		case 'insert':

			$query = 'INSERT INTO requisicao_venda (id_produto, qtd, valor, id_venda) VALUES("'.$id_produto.'","'.$qtd.'","'.$valor.'","'.$id_venda.'")';

			mysql_query($query, $link) or die(mysql_error());
			$msg=1;

			break;
		
		case 'update':
			(isset($_POST['id_requisicao']) and !empty($_POST['id_requisicao'])) ? $id_requisicao = $_POST['id_requisicao'] : $erro = TRUE;

			$query = 'UPDATE requisicao_venda SET id_produto = "'.$id_produto.'",qtd="'.$qtd.'",valor="'.$valor.'",id_venda="'.$id_venda.'" WHERE id_requisicao = '.$id_requisicao;

			mysql_query($query, $link) or die(mysql_error());

			$msg=3;

			break;

		case 'delete':
			(isset($_GET['id_requisicao'])) and !empty($_GET['id_requisicao']) ? $id_requisicao= $_GET['id_requisicao'] : $erro = TRUE; 

			$query= 'DELETE FROM requisicao_venda WHERE id_requisicao = '.$id_requisicao;

			mysql_query($query,$link) or die(mysql_error());
			$msg=2;

			break;

		default:
			break;
	}

	mysql_close();
	header("Location:index.php?pg=requisicao_venda&msg=".$msg."");

	exit;

?>