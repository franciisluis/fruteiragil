<?php
	
	require_once('checklogin.php');
	require_once('inc.conect.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Fruteira da Gil</title>
		<meta charset="utf-8">
		<!--<meta name="viweport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/bootstrap-theme.min.css">
		<link rel="shortcut icon" href="img/favicon.png" sizes="32x32" type="image/png">
	</head>
	<body>
		<div class = "container">
		<h4> Fruteira da Gil </h4>
		<?php
			echo '<div align="right">
			<b class="btn btn-outline-primary">'.$_SESSION['login']['user'].'</b>
		 	<a class="btn btn-outline-danger" href="inc.logout.php">logout</a>
		</div>';
		?>
		<hr>	<center>
				<nav class="navbar navbar-expand-sm bg-light sticky-top">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="btn btn-outline-info" href="index.php?pg=home"> HOME </a>&nbsp; 
					</li>
					<li class="nav-item">
						<a class="btn btn-outline-info" href="index.php?pg=produto"> CADASTRO PRODUTO </a>&nbsp;
					</li>
					<li class="nav-item">
						<a class="btn btn-outline-info" href="index.php?pg=cadastro_cliente"> CADASTRO CLIENTE </a>&nbsp; 
					</li>
					<li class="nav-item">
						<a class="btn btn-outline-info" href="index.php?pg=cadastro_categoria"> CADASTRO CATEGORIA </a>&nbsp; 
					</li>
					<li class="nav-item">
						<a class="btn btn-outline-info" href="index.php?pg=requisicao_venda">REQUISICAO VENDA </a>&nbsp;
					</li>
					<li class="nav-item">
						<a class="btn btn-outline-info" href="index.php?pg=venda">VENDAS </a>&nbsp;
					</li>
					<li class="nav-item">
						<a class="btn btn-outline-info" href="index.php?pg=sobre"> SOBRE </a>&nbsp;
					</li>
					<li class="nav-item">
						<a class="btn btn-outline-info" href="index.php?pg=contato"> CONTATO </a>
					</li>
				</ul>
			</nav>
				</center>

		<hr>
		
		<?php

			//isset = se variavel está setada com algum conteúdo, se não é nula, ela conta espaço em branco
			//empty testa se ta vazia
			if(isset($_GET['pg']) and !empty($_GET['pg'])){

				$pag = $_GET['pg'];

			}else{
				$pag = 'home';
			}

			if(isset($_GET['msg']) and !empty($_GET['msg'])){

				$msg = $_GET['msg'];

				switch ($msg) {
					case '1':
						echo "CADASTRADO COM SUCESSO!";
						break;
					case '2':
						echo "EXCLUIDO COM SUCESSO!";
						break;
					case '3':
						echo "EDITADO COM SUCESSO!";
						break;
					default:
						echo "Ocorreu algum erro!";
						break;
					}
			}
			//echo $link;

			//echo 'inc.'.$pag.'.php';
			//require - > se houver erro, encerra a execução do programa
			//include -> se houve erro ele, continua executando
			//require_once
			//include_once
			//include('inc.contato.php');
			include_once('inc.'.$pag.'.php');
		?>
		</div>
		<center>
			<footer>
				Endereço: Vânius Abílio dos Santos, 1109
			</footer>
		</center>
	</body>
</html>

<?php
	mysql_close();
?>