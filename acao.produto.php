<?php
	require_once('inc.conect.php');
	(isset($_POST['nome_produto'])) and !empty($_POST['nome_produto']) 	? $nome= $_POST['nome_produto'] 	: $erro = TRUE; 
	(isset($_POST['qtd_produto'])) 	and !empty($_POST['qtd_produto']) 	? $qtd= $_POST['qtd_produto'] 		: $erro = TRUE;  
	(isset($_POST['valor_produto']))and !empty($_POST['valor_produto']) ? $valor= $_POST['valor_produto'] 	: $erro = TRUE;
	(isset($_POST['categoria'])) 	and !empty($_POST['categoria']) 	? $categoria= $_POST['categoria'] 	: $erro = TRUE;
	//(isset($_REQUEST['acao'])) 		and !empty($_REQUEST['acao']) 		? $acao= $_REQUEST['acao'] 			: $erro = TRUE;
	//(isset($_FILES['imagem_produto']['name']) and !empty($_FILES['imagem_produto']['name'])) ? $imagem_produto = $_FILES['imagem_produto']['name'] : $img=FALSE;
	if (isset($_FILES['imagem_produto']['name']) and !empty($_FILES['imagem_produto']['name'])) {
		$imagem_produto = $_FILES['imagem_produto']['name'];
		$img = true;
	} else {
		$img = false;
	}
	(isset($_REQUEST['acao'])) 		and !empty($_REQUEST['acao']) 		? $acao= $_REQUEST['acao'] 			: $erro = TRUE;
	if ($erro && $acao != 'delete') {
		header("Location:index.php?pg=cadastrarproduto");
		exit;
	}

	$dir = 'img/'; 

	if ($img) {
		$tmp_imagem_produto = $_FILES['imagem_produto']['tmp_name'];
		$data_atual = date("YmdHis");
		$imagem_produto= $data_atual.$imagem_produto;
		move_uploaded_file($tmp_imagem_produto,$dir.$imagem_produto);
	} else {
		$imagem_produto ='produto.png';
	}
		

	switch ($acao) {
		case 'insert':
			echo 'Inserir registro';
			$query = 'INSERT INTO produto(nome_produto,qtd_produto,valor_produto,id_categoria,imagem_produto) VALUES("'.$nome.'","'.$qtd.'","'.$valor.'","'.$categoria.'","'.$imagem_produto.'")';

			mysql_query($query,$link) or die(mysql_error());
			$msg=1;
			break;

		case 'update':
			(isset($_POST['id_produto']) and !empty($_POST['id_produto'])) ? $id_produto = $_POST['id_produto'] : $erro = TRUE;
			
			$query = 'SELECT imagem_produto from produto WHERE id_produto= '.$id_produto;
			$res= mysql_query($query,$link);
			$qtd=mysql_num_rows($res);


			if(($qtd > 0) and ($img)){
				$linha = mysql_fetch_assoc($res);
				$imagem = $linha['imagem_produto'];
				if ($imagem != 'produto.png') {
					unlink($dir.$imagem);
				}
			}else if($qtd>0){
				$linha = mysql_fetch_assoc($res);
				$imagem_produto=$linha['imagem_produto'];

			}

			$query = 'UPDATE produto SET nome_produto = "'.$nome.'",qtd_produto="'.$qtd.'",valor_produto="'.$valor.'",id_categoria="'.$categoria.'", imagem_produto = "'.$imagem_produto.'" WHERE id_produto = '.$id_produto;

			mysql_query($query, $link) or die(mysql_error());

			$msg=3;



			break;

		case 'delete':
			(isset($_GET['id_produto'])) and !empty($_GET['id_produto']) ? $id_produto= $_GET['id_produto'] 	: $erro = TRUE;

			$query = 'SELECT imagem_produto from produto WHERE id_produto= '.$id_produto;
			$res= mysql_query($query,$link);
			$qtd=mysql_num_rows($res);

			if($qtd>0){
				$linha = mysql_fetch_assoc($res);
				$imagem = $linha['imagem_produto'];
				if($imagem != 'produto.png'){
					unlink($dir.$imagem);
				}  
			}

			$query= 'DELETE FROM produto WHERE id_produto = '.$id_produto;

			mysql_query($query,$link) or die(mysql_error());
			$msg=2;
			break;
		default:
			break;
	}
	mysql_close();
	header("Location:index.php?pg=produto&msg=".$msg."");

	exit;

?>