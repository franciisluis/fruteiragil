<?php
	
	//session_start();

	$user=$_POST['user'];

	$pass=$_POST['pass'];

	$pass_md5=md5('123');
	
	if($user='admin' and $pass='123'){
		$_SESSION['login']['user']=$user;
		$_SESSION['login']['pass']=$pass;
		$_SESSION['login']['dtho']=date("y-m-d H:i:s");

		header('Location:index.php?pg=home');
	}else{
		header('Location:inc.login.php');
		exit;
	}


?>