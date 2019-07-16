<html>
	<head>
		<title>Login</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/bootstrap-theme.min.css">
		<link rel="shortcut icon" href="img/favicon.png" sizes="32x32" type="image/png">

	</head>
	<body>
		<div class = "container">
		<center>
		<h4> Login Fruteira da gil</h4>
		<?php
		if (isset($_GET['error']) and !empty($_GET['error'])) {	
			$error = $_GET['error'];
			switch ($error) {
				case 1:
					echo 'INFORME SEU USUÁRIO E SENHA';
					break;	
				case 2:
					echo 'USUÁRIO OU SENHA INVÁLIDOS';
					break;
				default:
					break;
            }	
        }
        ?>
		<table class="table-bordered">
		<form method="POST" action='validalogin.php'>
			<tr>
			<td class="form-control" align="center"><h6>User: <input type="text" name="user" size="30"></td>
			</tr>
			<tr>
			<td class="form-control" align="center"><h6>Pass: <input type="password" name="password"></td>
			</tr>
			<tr>
			<td class="form-control " align="center"><input class="btn btn-outline-success" type="submit" name="botao" value="login"></td>
			</tr>
		</form>
		</table>
	</center>
	</body>
</html>