<?php
	require_once('inc.conect.php');


	(isset($_POST['nome_cliente'])) and !empty($_POST['nome_cliente']) 	? $nome= $_POST['nome_cliente'] 	: $erro = TRUE; 
	(isset($_POST['telefone'])) 	and !empty($_POST['telefone']) 		? $telefone= $_POST['telefone'] 	: $erro = TRUE;  
	(isset($_POST['endereco'])) 	and !empty($_POST['endereco']) 		? $endereco= $_POST['endereco'] 	: $erro = TRUE;  
	(isset($_POST['email'])) 		and !empty($_POST['email']) 		? $email= $_POST['email'] 			: $erro = TRUE;
	(isset($_POST['cpf'])) 			and !empty($_POST['cpf']) 			? $cpf= $_POST['cpf'] 				: $erro = TRUE;
	if (isset($_FILES['imagem_cliente']['name']) and !empty($_FILES['imagem_cliente']['name'])) {
		$imagem_cliente = $_FILES['imagem_cliente']['name'];
		$img = true;
	} else {
		$img = false;
	}
	(isset($_REQUEST['acao'])) 		and !empty($_REQUEST['acao']) 		? $acao= $_REQUEST['acao'] 			: $erro = TRUE;
	if ($erro && $acao != 'delete') {
		header("Location:index.php?pg=cadastro_cliente");
		exit;
	}

	$dir = 'img/';

	if ($img) {
		$tmp_imagem_cliente = $_FILES['imagem_cliente']['tmp_name'];
		$data_atual = date("YmdHis");
		$imagem_cliente = $data_atual.$imagem_cliente;
		move_uploaded_file($tmp_imagem_cliente,$dir.$imagem_cliente);
	} else {
		$imagem_cliente ='cliente.png';
	}
		
	

	switch ($acao) {
		case 'insert':
			echo 'Inserir registro';
			$query = 'INSERT INTO cliente(nome_cliente,email,telefone,endereco,cpf,imagem_cliente) VALUES("'.$nome.'","'.$email.'","'.$telefone.'","'.$endereco.'","'.$cpf.'","'.$imagem_cliente.'")';
		
			mysql_query($query,$link) or die(mysql_error());

			$msg=1;
			break;

		case 'update':
			(isset($_POST['id_cliente']) and !empty($_POST['id_cliente'])) ? $id_cliente = $_POST['id_cliente'] : $erro = TRUE;

			$query = 'SELECT imagem_cliente from cliente WHERE id_cliente= '.$id_cliente;
			$res= mysql_query($query,$link);
			$qtd=mysql_num_rows($res);

			if(($qtd > 0) and ($img)){
				$linha = mysql_fetch_assoc($res);
				$imagem = $linha['imagem_cliente'];
				if ($imagem != 'cliente.png') {
					unlink($dir.$imagem);
				}
			}else if($qtd>0){
				$linha = mysql_fetch_assoc($res);
				$imagem_cliente=$linha['imagem_cliente'];

			}

			$query = 'UPDATE cliente SET nome_cliente= "'.$nome.'", telefone="'.$telefone.'", endereco="'.$endereco.'", email="'.$email.'", cpf="'.$cpf.'", imagem_cliente="'.$imagem_cliente.'" WHERE id_cliente = '.$id_cliente;

			mysql_query($query, $link) or die(mysql_error());

			$msg=3;

			break;

		case 'delete':
			(isset($_GET['id_cliente'])) and !empty($_GET['id_cliente']) ? $id_cliente= $_GET['id_cliente'] 	: $erro = TRUE;

			$query = 'SELECT imagem_cliente from cliente WHERE id_cliente= '.$id_cliente;
			$res= mysql_query($query,$link);
			$qtd=mysql_num_rows($res);

			if($qtd>0){
				$linha = mysql_fetch_assoc($res);
				$imagem_c = $linha['imagem_cliente'];
				if($imagem_c != 'cliente.png'){
					unlink($dir.$imagem_c);
				}  
			}

			$query= 'DELETE FROM cliente WHERE id_cliente = '.$id_cliente;

			mysql_query($query,$link) or die (mysql_error());
			$msg=2;
	
			break;

		default:
			break;
	}
	mysql_close();
	header("Location:index.php?pg=cadastro_cliente&msg=".$msg."");

	exit;

?>