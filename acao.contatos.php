<?php

	//print_r($_POST);
	//die;
	//( cond ) ? v : f
	
	(isset($_POST['nome'])) and !empty($_POST['nome']) ? $nome= $_POST['nome'] : $erro = TRUE; 
	(isset($_POST['telefone'])) and !empty($_POST['telefone']) ? $telefone= $_POST['telefone'] : $erro = TRUE;  
	(isset($_POST['endereco'])) and !empty($_POST['endereco']) ? $endereco= $_POST['endereco'] : $erro = TRUE;  
	(isset($_POST['email'])) and !empty($_POST['email']) ? $email= $_POST['email'] : $erro = TRUE;
	(isset($_POST['acao'])) and !empty($_POST['acao']) ? $acao= $_POST['acao'] : $erro = TRUE;
	
	switch ($acao) {
		case 'insert':
			echo 'Inserir registro';
			$query = 'INSERT INTO contato(nome,email) VALUES("'.$nome.'","'.$email.'")';
			
			mysql_query($query,$link) or die(mysql_error());

			$msg=TRUE;
			break;

		case 'update':
			break;

		case 'delete':
			break;

		default:
			break;
	}
		mysql_close();
	header("Location:index.php?pg=contato&msg=".$msg."");

	exit;

?>