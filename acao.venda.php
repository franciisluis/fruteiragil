<?php

	include_once('inc.conect.php');

	print_r($_POST);

	(isset($_POST['id_cliente']) and !empty($_POST['id_cliente'])) ? $id_cliente = $_POST['id_cliente'] : $erro = TRUE;
	(isset($_POST['data_venda']) and !empty($_POST['data_venda'])) ? $data_venda = $_POST['data_venda'] : $erro = TRUE;
	(isset($_REQUEST['acao']) and !empty($_REQUEST['acao'])) ? $acao = $_REQUEST['acao'] : $erro = TRUE;

	switch ($acao) {
		case 'insert':

			$query = 'INSERT INTO venda (id_cliente,data) VALUES("'.$id_cliente.'","'.$data_venda.'")';


			mysql_query($query, $link) or die(mysql_error());
			$msg=TRUE;

			break;
		
		case 'update':

			(isset($_POST['id_venda']) and !empty($_POST['id_venda'])) ? $id_venda = $_POST['id_venda'] : $erro = TRUE;

			$query = 'UPDATE venda SET id_cliente = "'.$id_cliente.'",data="'.$data_venda.'" WHERE id_venda = '.$id_venda;

			mysql_query($query, $link) or die(mysql_error());

			$msg=3;

			break;


		case 'delete':
			(isset($_GET['id_venda'])) and !empty($_GET['id_venda']) ? $id_venda= $_GET['id_venda'] : $erro = TRUE; 
			$query= 'DELETE FROM venda WHERE id_venda = '.$id_venda;

			mysql_query($query,$link) or die (mysql_error());
			$msg=2;
			break;

		default:
			break;
	}

	mysql_close();
	header("Location:index.php?pg=venda&msg=".$msg."");

	exit;


?>