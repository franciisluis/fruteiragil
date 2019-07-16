<?php
	require_once('inc.funcao.php');
	require_once('inc.conect.php');

	(isset($_POST['nome_categoria'])) 	and !empty($_POST['nome_categoria']) 		? $nome = $_POST['nome_categoria'] 		: $erro = TRUE;
	(isset($_REQUEST['acao'])) 	and !empty($_REQUEST['acao']) 		? $acao= $_REQUEST['acao'] 		: $erro = TRUE;


	switch ($acao) {
		case 'insert':
			insere($link,$nome);
			$msg=1;
			break;

		case 'update':
			atualiza($link,$nome);

			$msg=3;

			break;

		case 'delete':
			delete($link,$nome);
			$msg=2;
			break;

		default:
			break;
	}
	mysql_close();
	header("Location:index.php?pg=cadastro_categoria&msg=".$msg."");

	exit;

?>